<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'regType' => ['required', 'string', 'in:citizen,foreigner'],
            'fullName' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:Male,Female,Other,Prefer not to say'],
            'nationality' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'country' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'emergencyName' => ['nullable', 'string', 'max:255'],
            'emergencyPhone' => ['nullable', 'string', 'max:20'],
            'relation' => ['nullable', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'securityQuestion' => ['nullable', 'string'],
            'securityAnswer' => ['nullable', 'string'],
            'terms' => ['required', 'accepted'],
            'privacy' => ['required', 'accepted'],
            // Conditional validations
            'idNumber' => ['nullable', 'string', 'required_if:regType,citizen'],
            'idFront' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048', 'required_if:regType,citizen'],
            'idBack' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048', 'required_if:regType,citizen'],
            'passportNo' => ['nullable', 'string', 'required_if:regType,foreigner'],
            'visaNo' => ['nullable', 'string', 'required_if:regType,foreigner'],
            'visaUpload' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048', 'required_if:regType,foreigner'],
        ]);

        // Handle file uploads
        $idFrontPath = null;
        $idBackPath = null;
        $visaUploadPath = null;

        if ($request->hasFile('idFront')) {
            $idFrontPath = $request->file('idFront')->store('uploads/id_front', 'public');
        }
        if ($request->hasFile('idBack')) {
            $idBackPath = $request->file('idBack')->store('uploads/id_back', 'public');
        }
        if ($request->hasFile('visaUpload')) {
            $visaUploadPath = $request->file('visaUpload')->store('uploads/visa', 'public');
        }

        // Get nationality
        $nationality = \App\Models\nationalities::where('name', $request->nationality)->firstOrFail();

        // Get user type based on regType
        $userTypeName = $request->regType === 'citizen' ? 'Resident' : 'Non-Resident';
        $userType = \App\Models\UserType::where('name', $userTypeName)->firstOrFail();

        // Split full name
        $nameParts = explode(' ', $request->fullName, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? '';

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 'Active',
            'usertype_id' => $userType->id,
            'nationality_id' => $nationality->id,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'emergency_name' => $request->emergencyName,
            'emergency_phone' => $request->emergencyPhone,
            'relation' => $request->relation,
            'security_question' => $request->securityQuestion,
            'security_answer' => $request->securityAnswer,
        ]);

        // Create bio_data entry
        $bioData = \App\Models\bioData::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'gender' => $request->gender,
            'nationality_id' => $nationality->id,
            'phoneNumber' => $request->phone,
            'resident_type' => $userTypeName,
            'user_id' => $user->id,
            'status' => 'pending',
            // Conditional fields
            'id_front' => $idFrontPath,
            'id_back' => $idBackPath,
            'passport_no' => $request->passportNo,
            'visa_no' => $request->visaNo,
            'visa_upload' => $visaUploadPath,
        ]);

        event(new Registered($user));

        // Flash success message for the register page
        session()->flash('success', 'Registration successful! Redirecting to login page...');

        // Redirect back to register page to show success message and clear form
        return redirect(route('register', absolute: false));
    }
}
