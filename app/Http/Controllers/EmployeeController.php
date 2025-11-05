<?php

namespace App\Http\Controllers;

use App\Models\bioData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = bioData::with('user');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstName', 'like', "%{$search}%")
                  ->orWhere('lastName', 'like', "%{$search}%")
                  ->orWhere('identification', 'like', "%{$search}%")
                  ->orWhere('phoneNumber', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        $employees = $query->paginate(10);

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|unique:employees',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date|before:today',
            'national_id' => 'required|string|unique:employees',
            'contact_number' => 'required|string|unique:employees',
            'email' => 'required|email|unique:employees',
            'address' => 'required|string',
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'years_of_experience' => 'required|integer|min:0',
            'date_joined' => 'required|date|before_or_equal:today',
            'license_number' => 'required|string|unique:employees',
            'license_expiry_date' => 'required|date|after:today',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_relationship' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string',
            'role' => 'required|in:Doctor,Nurse,Pharmacist,Lab Tech,Admin,Other',
        ]);

        // Handle file upload
        if ($request->hasFile('certificate')) {
            $validated['certificate_path'] = $request->file('certificate')->store('certificates', 'public');
        }

        Employee::create($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date|before:today',
            'national_id' => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'contact_number' => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'email' => ['required', 'email', Rule::unique('employees')->ignore($employee->id)],
            'address' => 'required|string',
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'years_of_experience' => 'required|integer|min:0',
            'date_joined' => 'required|date|before_or_equal:today',
            'license_number' => ['required', 'string', Rule::unique('employees')->ignore($employee->id)],
            'license_expiry_date' => 'required|date|after:today',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_relationship' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string',
            'role' => 'required|in:Doctor,Nurse,Pharmacist,Lab Tech,Admin,Other',
        ]);

        // Handle file upload
        if ($request->hasFile('certificate')) {
            // Delete old certificate if exists
            if ($employee->certificate_path) {
                Storage::disk('public')->delete($employee->certificate_path);
            }
            $validated['certificate_path'] = $request->file('certificate')->store('certificates', 'public');
        }

        $employee->update($validated);

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Delete certificate file if exists
        if ($employee->certificate_path) {
            Storage::disk('public')->delete($employee->certificate_path);
        }

        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
    }

    /**
     * Export employees to Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new \App\Exports\EmployeesExport, 'employees.xlsx');
    }

    /**
     * Export employees to PDF.
     */
    public function exportPdf()
    {
        $employees = Employee::all();
        $pdf = Pdf::loadView('admin.employees.pdf', compact('employees'));
        return $pdf->download('employees.pdf');
    }
}
