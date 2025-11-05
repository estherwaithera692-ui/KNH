<x-guest-layout>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }
        .registration-card {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h2 {
            color: #0069d9;
            margin-bottom: 20px;
        }
        .submit-btn {
            background: #0069d9;
            color: white;
        }
        .submit-btn:hover {
            background: #004c99;
        }
        .hidden { display: none; }
    </style>

    <div class="registration-card">
        <h2 class="text-center">Hospital Registration</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3 text-center" role="alert">
                {{ session('success') }}
            </div>
            <script>
                // Clear all form fields when success message is shown
                document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('registrationForm');
                    if (form) {
                        // Clear all input fields
                        const inputs = form.querySelectorAll('input:not([type="hidden"]), select, textarea');
                        inputs.forEach(input => {
                            if (input.type === 'checkbox' || input.type === 'radio') {
                                input.checked = false;
                            } else {
                                input.value = '';
                            }
                        });
                    }
                });

                // Redirect to login after 3 seconds
                setTimeout(function() {
                    window.location.href = '{{ route("login") }}';
                }, 3000);
            </script>
        @endif

        <form id="registrationForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <!-- Registration Type -->
            <div class="mb-3">
                <label for="regType" class="form-label">Registration Type </label>
                <select class="form-select" id="regType" name="regType" required>
                    <option value="">-- Select Type --</option>
                    <option value="citizen" {{ old('regType') == 'citizen' ? 'selected' : '' }}>Citizen</option>
                    <option value="foreigner" {{ old('regType') == 'foreigner' ? 'selected' : '' }}>Foreigner</option>
                </select>
                @error('regType')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Personal Info -->
            <div id="personalInfo">
                <h2>Personal Information</h2>
                <div class="row g-3">
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full Name" value="{{ old('fullName') }}" required>
                        <label for="fullName">Full Name </label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth" value="{{ old('dob') }}" required>
                        <label for="dob">Date of Birth </label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <select class="form-select" id="gender" name="gender">
                            <option value="" style="font-size:0.8rem;">--Select Gender--</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            <option value="Prefer not to say" {{ old('gender') == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                        </select>
                        <label for="gender">Gender</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <select class="form-select" id="nationality" name="nationality" required>
                            <option value=""style="font-size:0.8rem;">-- Select Nationality --</option>
                            <!-- Options loaded via JS -->
                        </select>
                        <label for="nationality">Nationality </label>
                    </div>
                </div>

                <!-- ID / Passport -->
                <div id="citizenFields" class="hidden mt-3">
                    <div class="row g-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="idNumber" name="idNumber" placeholder="National ID" value="{{ old('idNumber') }}" required>
                            <label for="idNumber">National ID Number</label>
                        </div>
                        <div class="col-md-6">
                            <label for="idFront" class="form-label">Upload ID Front</label>
                            <input class="form-control" type="file" id="idFront" name="idFront" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                        <div class="col-md-6">
                            <label for="idBack" class="form-label">Upload ID Back</label>
                            <input class="form-control" type="file" id="idBack" name="idBack" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                </div>

                <div id="foreignerFields" class="hidden mt-3">
                    <div class="row g-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="passportNo" name="passportNo" placeholder="Passport Number" value="{{ old('passportNo') }}">
                            <label for="passportNo">Passport Number</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" class="form-control" id="visaNo" name="visaNo" placeholder="Visa / Work Permit Number" value="{{ old('visaNo') }}">
                            <label for="visaNo" style="font-size:0.8rem;">Visa / Work Permit Number</label>
                        </div>
                        <div class="col-md-6">
                            <label for="visaUpload" class="form-label" style="font-size:0.8rem;">Upload Passport / Visa </label>
                            <input class="form-control" type="file" id="visaUpload" name="visaUpload" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <h2 class="mt-4">Contact Information</h2>
            <div class="row g-3">
                <div class="col-md-6 form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    <label for="email">Email </label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="+254700000000" value="{{ old('phone') }}" required>
                    <label for="phone" style="font-size:0.6rem;">Phone Number (+countrycode...) </label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                    <label for="address">Address</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City / Town" value="{{ old('city') }}" required>
                    <label for="city">City/ Town</label>
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="country" name="country" required>
                        <option value="">-- Select Country --</option>
                        <!-- Options loaded via JS -->
                    </select>
                    <label for="country">Country</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="emergencyName" name="emergencyName" placeholder="Emergency Contact Name" value="{{ old('emergencyName') }}">
                    <label for="emergencyName"  style="font-size:0.8rem;">Emergency Contact Name</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="tel" class="form-control" id="emergencyPhone" name="emergencyPhone" placeholder="+254700000000" value="{{ old('emergencyPhone') }}">
                    <label for="emergencyPhone"  style="font-size:0.8rem;">Emergency Contact Phone</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" class="form-control" id="relation" name="relation" placeholder="Relationship" value="{{ old('relation') }}">
                    <label for="relation">Relationship</label>
                </div>
            </div>


            <!-- Account Setup -->
            <h2 class="mt-4">Account Setup</h2>
            <div class="row g-3">
                <div class="col-md-6 form-floating position-relative">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" minlength="8" required>
                    <label for="password">Password</label>
                    <i class="bi bi-eye-fill position-absolute" style="top: 38px; right: 12px; cursor:pointer;" id="togglePassword"></i>
                </div>
                <div class="col-md-6 form-floating position-relative">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" minlength="8" required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>
                <div class="col-md-6 form-floating">
                    <select class="form-select" id="securityQuestion" name="securityQuestion">
                        <option value="">-- Select Question --</option>
                        <option value="What is your mother's maiden name?" {{ old('securityQuestion') == "What is your mother's maiden name?" ? 'selected' : '' }}>What is your mother's maiden name?</option>
                        <option value="What was your first school?" {{ old('securityQuestion') == "What was your first school?" ? 'selected' : '' }}>What was your first school?</option>
                        <option value="What is your favorite color?" {{ old('securityQuestion') == "What is your favorite color?" ? 'selected' : '' }}>What is your favorite color?</option>
                    </select>
                    <label for="securityQuestion" style="font-size:0.9rem;">Security Question (optional)</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" class="form-control" id="securityAnswer" name="securityAnswer" placeholder="Security Answer" value="{{ old('securityAnswer') }}" style="font-size:0.9rem;">
                        <label for="securityAnswer" style="font-size:0.8rem;">Security Answer (optional)</label>
                </div>
            </div>

            <!-- Meta & Legal -->
            <h2 class="mt-4">Meta & Legal</h2>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">I accept the <a href="/terms" target="_blank">Terms & Conditions</a></label>
                @error('terms')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                <label class="form-check-label" for="privacy">I agree to the <a href="/privacy" target="_blank">Privacy Policy</a></label>
                @error('privacy')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- ensure legacy 'name' field used by default Laravel registration gets fullName -->
            <input type="hidden" id="name" name="name" value="{{ old('name', old('fullName')) }}">

            <button type="submit" class="btn submit-btn w-100">Submit Registration</button>

            @if(session('success'))
                <div class="alert alert-success mt-2 text-center" role="alert">{{ session('success') }}</div>
            @elseif(session('status'))
                <div class="alert alert-success mt-2 text-center" role="alert">{{ session('status') }}</div>
            @elseif(session('message'))
                <div class="alert alert-info mt-2 text-center" role="alert">{{ session('message') }}</div>
            @endif

            <p id="formMessage" class="mt-2 text-center"></p>

            <script>
                // copy fullName into hidden legacy name field before submit
                const registrationForm = document.getElementById('registrationForm');
                const fullNameInput = document.getElementById('fullName');
                const nameHidden = document.getElementById('name');
                if (registrationForm) {
                    registrationForm.addEventListener('submit', () => {
                        if (fullNameInput && nameHidden) {
                            nameHidden.value = fullNameInput.value || nameHidden.value;
                        }
                    });
                }

                // if server provided a flash message, show it inside #formMessage (for SPA-like feedback)
                document.addEventListener('DOMContentLoaded', function () {
                    @if(session('success') || session('status') || session('message'))
                        const msg = {!! json_encode(session('success') ?? session('status') ?? session('message')) !!};
                        const fm = document.getElementById('formMessage');
                        if (fm) {
                            fm.textContent = msg;
                            fm.classList.add('text-success');
                        }
                    @endif
                });
            </script>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const regTypeSelect = document.getElementById('regType');
        const citizenFields = document.getElementById('citizenFields');
        const foreignerFields = document.getElementById('foreignerFields');
        const residencySelect = document.getElementById('residency');
        const residencyDetails = document.getElementById('residencyDetails');
        const countrySelect = document.getElementById('country');
        const phoneInput = document.getElementById('phone');
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        // Toggle password visibility
        togglePassword.addEventListener('click', () => {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            togglePassword.classList.toggle('bi-eye-slash-fill');
        });

        // Registration type change
        regTypeSelect.addEventListener('change', () => {
            if (regTypeSelect.value === 'citizen') {
                citizenFields.classList.remove('hidden');
                foreignerFields.classList.add('hidden');
                // Auto-fill nationality example
                document.getElementById('nationality').value = 'Kenyan'; // Adjust as needed
            } else if (regTypeSelect.value === 'foreigner') {
                citizenFields.classList.add('hidden');
                foreignerFields.classList.remove('hidden');
                document.getElementById('nationality').value = '';
            } else {
                citizenFields.classList.add('hidden');
                foreignerFields.classList.add('hidden');
                document.getElementById('nationality').value = '';
            }
        });

    

        // Load countries
        async function loadCountries() {
            try {
                const res = await fetch('https://restcountries.com/v3.1/all?fields=name,idd,flags');
                const data = await res.json();
                const countries = data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                countrySelect.innerHTML = '<option value="">-- Select Country --</option>';
                const nationalitySelect = document.getElementById('nationality');
                nationalitySelect.innerHTML = '<option value="">-- Select Nationality --</option>';

                const seenNats = new Set();
                countries.forEach(c => {
                    const opt1 = document.createElement('option');
                    opt1.value = c.name.common;
                    opt1.textContent = c.name.common;
                    opt1.dataset.code = c.idd?.root + (c.idd?.suffixes?.[0] || '');
                    countrySelect.appendChild(opt1);

                    const nat = c.name.common; // Simplified
                    if (!seenNats.has(nat)) {
                        seenNats.add(nat);
                        const opt2 = document.createElement('option');
                        opt2.value = nat;
                        opt2.textContent = nat;
                        nationalitySelect.appendChild(opt2);
                    }
                });
            } catch (err) {
                console.error('Error loading countries:', err);
            }
        }
        loadCountries();

        // Auto-fill phone country code
        countrySelect.addEventListener('change', () => {
            const selectedOption = countrySelect.options[countrySelect.selectedIndex];
            const code = selectedOption.dataset.code;
            if (code) {
                phoneInput.value = code;
            }
        });
    </script>
</x-guest-layout>
