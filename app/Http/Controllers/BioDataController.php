<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bioData;
use App\Models\nationalities;

class BioDataController extends Controller
{
    public function bioData_C()
    {
        $nationalities = nationalities::all();
        return view('visitors.BiodataCollect', compact('nationalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identification' => 'required|string|max:255|unique:bio_data,identification',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Transgender,Intersex',
            'nationality_id' => 'required|exists:nationalities,id',
            'phoneNumber' => 'required|string|max:255|unique:bio_data,phoneNumber',
            'highest_academic_certificate' => 'required|string|max:255',
            'professional_certificate' => 'required|string|max:255',
            'C_name' => 'required|string|max:255',
            'C_no' => 'required|string|max:255',
            'p_No_cert' => 'required|string|max:255|unique:bio_data,p_No_cert',
            'p_name' => 'required|string|max:255',
            'resident_type' => 'required|in:NON-RESIDENT,RESIDENT',
            'highest_academic_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'professional_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // Conditional validation
            'residence_address' => 'required_if:resident_type,RESIDENT|string|max:255',
            'residence_duration' => 'required_if:resident_type,RESIDENT|integer|min:0',
            'visa_type' => 'required_if:resident_type,NON-RESIDENT|string|max:255',
            'visa_expiry' => 'required_if:resident_type,NON-RESIDENT|date|after:today',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('highest_academic_certificate_file')) {
            $data['highest_academic_certificate_file'] = $request->file('highest_academic_certificate_file')->store('certificates', 'public');
        }

        if ($request->hasFile('professional_certificate_file')) {
            $data['professional_certificate_file'] = $request->file('professional_certificate_file')->store('certificates', 'public');
        }

        $data['user_id'] = auth()->id();
        bioData::create($data);

        return redirect()->route('biodataCollect')->with('success', 'Bio data submitted successfully!');
    }

    public function index()
    {
        $bioData = bioData::with('user')->get();
        return view('admin.bioDataIndex', compact('bioData'));
    }

    public function show($id)
    {
        $bioData = bioData::with('user')->findOrFail($id);
        return view('admin.bioDataShow', compact('bioData'));
    }

    public function edit($id)
    {
        $bioData = bioData::findOrFail($id);
        $nationalities = nationalities::all();
        return view('admin.bioDataEdit', compact('bioData', 'nationalities'));
    }

    public function update(Request $request, $id)
    {
        $bioData = bioData::findOrFail($id);

        $request->validate([
            'identification' => 'required|string|max:255|unique:bio_data,identification,' . $id,
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Transgender,Intersex',
            'nationality_id' => 'required|exists:nationalities,id',
            'phoneNumber' => 'required|string|max:255|unique:bio_data,phoneNumber,' . $id,
            'highest_academic_certificate' => 'required|string|max:255',
            'professional_certificate' => 'required|string|max:255',
            'C_name' => 'required|string|max:255',
            'C_no' => 'required|string|max:255',
            'p_No_cert' => 'required|string|max:255|unique:bio_data,p_No_cert,' . $id,
            'p_name' => 'required|string|max:255',
            'highest_academic_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'professional_certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('highest_academic_certificate_file')) {
            // Delete old file if exists
            if ($bioData->highest_academic_certificate_file) {
                \Storage::disk('public')->delete($bioData->highest_academic_certificate_file);
            }
            $data['highest_academic_certificate_file'] = $request->file('highest_academic_certificate_file')->store('certificates', 'public');
        }

        if ($request->hasFile('professional_certificate_file')) {
            // Delete old file if exists
            if ($bioData->professional_certificate_file) {
                \Storage::disk('public')->delete($bioData->professional_certificate_file);
            }
            $data['professional_certificate_file'] = $request->file('professional_certificate_file')->store('certificates', 'public');
        }

        $bioData->update($data);

        return redirect()->route('admin.bioData.index')->with('success', 'Bio data updated successfully!');
    }

    public function destroy($id)
    {
        $bioData = bioData::findOrFail($id);

        // Delete associated files
        if ($bioData->highest_academic_certificate_file) {
            \Storage::disk('public')->delete($bioData->highest_academic_certificate_file);
        }
        if ($bioData->professional_certificate_file) {
            \Storage::disk('public')->delete($bioData->professional_certificate_file);
        }

        $bioData->delete();

        return redirect()->route('admin.bioData.index')->with('success', 'Bio data deleted successfully!');
    }

    public function downloadCertificate($id, $type)
    {
        $bioData = bioData::findOrFail($id);

        if ($type === 'academic' && $bioData->highest_academic_certificate_file) {
            return \Storage::disk('public')->download($bioData->highest_academic_certificate_file);
        } elseif ($type === 'professional' && $bioData->professional_certificate_file) {
            return \Storage::disk('public')->download($bioData->professional_certificate_file);
        }

        return redirect()->back()->with('error', 'Certificate file not found.');
    }

    public function viewCertificate($id, $type)
    {
        $bioData = bioData::findOrFail($id);

        if ($type === 'academic' && $bioData->highest_academic_certificate_file) {
            return response()->file(storage_path('app/public/' . $bioData->highest_academic_certificate_file));
        } elseif ($type === 'professional' && $bioData->professional_certificate_file) {
            return response()->file(storage_path('app/public/' . $bioData->professional_certificate_file));
        }

        return redirect()->back()->with('error', 'Certificate file not found.');
    }

    public function updateResidentType(Request $request)
    {
        $request->validate([
            'resident_type' => 'required|in:NON-RESIDENT,RESIDENT',
        ]);

        $user = auth()->user();
        $bioData = bioData::where('user_id', $user->id)->first();

        if (!$bioData) {
            return response()->json(['success' => false, 'message' => 'Bio data not found. Please submit your bio data first.']);
        }

        $bioData->update(['resident_type' => $request->resident_type]);

        return response()->json(['success' => true, 'message' => 'Resident type updated successfully.']);
    }

    public function approve($id)
    {
        $bioData = bioData::findOrFail($id);
        $bioData->update(['status' => 'approved']);

        // Send congratulation email
        \Mail::to($bioData->user->email)->send(new \App\Mail\CongratulationEmail($bioData));

        return redirect()->route('admin.bioData.show', $id)->with('success', 'Application approved successfully. Email sent to user.');
    }

    public function reject($id)
    {
        $bioData = bioData::findOrFail($id);
        $bioData->update(['status' => 'rejected']);

        // Send rejection email
        \Mail::to($bioData->user->email)->send(new \App\Mail\RejectionEmail($bioData));

        return redirect()->route('admin.bioData.show', $id)->with('success', 'Application rejected successfully. Email sent to user.');
    }
}
