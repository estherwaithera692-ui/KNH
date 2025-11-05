<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Nationality;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = Resident::with('nationality')->paginate(10);
        return view('admin.residents.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nationalities = Nationality::all();
        return view('admin.residents.create', compact('nationalities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255|unique:residents',
            'phone_number' => 'required|string|max:255|unique:residents',
            'email' => 'nullable|email|unique:residents',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'nationality_id' => 'required|exists:nationalities,id',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed',
            'occupation' => 'nullable|string|max:255',
            'registration_date' => 'required|date',
            'status' => 'required|in:Active,Inactive,Suspended',
            'resident_number' => 'required|string|max:255|unique:residents',
            'resident_area' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'medical_credentials' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        Resident::create($request->all());

        return redirect()->route('admin.residents.index')->with('success', 'Resident created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resident = Resident::with('nationality')->findOrFail($id);
        return view('admin.residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resident = Resident::findOrFail($id);
        $nationalities = Nationality::all();
        return view('admin.residents.edit', compact('resident', 'nationalities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resident = Resident::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255|unique:residents,identification_number,' . $id,
            'phone_number' => 'required|string|max:255|unique:residents,phone_number,' . $id,
            'email' => 'nullable|email|unique:residents,email,' . $id,
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'nationality_id' => 'required|exists:nationalities,id',
            'marital_status' => 'required|in:Single,Married,Divorced,Widowed',
            'occupation' => 'nullable|string|max:255',
            'registration_date' => 'required|date',
            'status' => 'required|in:Active,Inactive,Suspended',
            'resident_number' => 'required|string|max:255|unique:residents,resident_number,' . $id,
            'resident_area' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'medical_credentials' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $resident->update($request->all());

        return redirect()->route('admin.residents.index')->with('success', 'Resident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('admin.residents.index')->with('success', 'Resident deleted successfully.');
    }
}
