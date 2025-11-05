<x-guest-layout>
    <form method="POST" action="{{ route('storeBioData') }}" enctype="multipart/form-data">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="firstName" :value="__('First Name')" />
            <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="lastName" :value="__('Last Name')" />
            <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Select Gender --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
                <option value="Intersex">Intersex</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Nationality -->
        <div class="mt-4">
            <x-input-label for="nationality_id" :value="__('Nationality')" />
            <select id="nationality_id" name="nationality_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Select Nationality --</option>
                @foreach($nationalities as $nat)
                    <option value="{{ $nat->id }}" {{ old('nationality_id') == $nat->id ? 'selected' : '' }}>{{ $nat->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('nationality_id')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phoneNumber" :value="__('Phone Number')" />
            <x-text-input id="phoneNumber" class="block mt-1 w-full" type="tel" name="phoneNumber" :value="old('phoneNumber')" required />
            <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
        </div>

        <!-- Highest Academic Certificate -->
        <div class="mt-4">
            <x-input-label for="highest_academic_certificate" :value="__('Highest Academic Certificate')" />
            <x-text-input id="highest_academic_certificate" class="block mt-1 w-full" type="text" name="highest_academic_certificate" :value="old('highest_academic_certificate')" required />
            <x-input-error :messages="$errors->get('highest_academic_certificate')" class="mt-2" />
        </div>

        <!-- Highest Academic Certificate File -->
        <div class="mt-4">
            <x-input-label for="highest_academic_certificate_file" :value="__('Highest Academic Certificate File (PDF, JPG, PNG)')" />
            <input id="highest_academic_certificate_file" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="file" name="highest_academic_certificate_file" accept=".pdf,.jpg,.jpeg,.png" />
            <x-input-error :messages="$errors->get('highest_academic_certificate_file')" class="mt-2" />
            <small class="text-gray-500">Max file size: 2MB. Accepted formats: PDF, JPG, PNG</small>
        </div>

        <!-- Professional Certificate -->
        <div class="mt-4">
            <x-input-label for="professional_certificate" :value="__('Professional Certificate')" />
            <x-text-input id="professional_certificate" class="block mt-1 w-full" type="text" name="professional_certificate" :value="old('professional_certificate')" required />
            <x-input-error :messages="$errors->get('professional_certificate')" class="mt-2" />
        </div>

        <!-- Professional Certificate File -->
        <div class="mt-4">
            <x-input-label for="professional_certificate_file" :value="__('Professional Certificate File (PDF, JPG, PNG)')" />
            <input id="professional_certificate_file" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="file" name="professional_certificate_file" accept=".pdf,.jpg,.jpeg,.png" />
            <x-input-error :messages="$errors->get('professional_certificate_file')" class="mt-2" />
            <small class="text-gray-500">Max file size: 2MB. Accepted formats: PDF, JPG, PNG</small>
        </div>

        <!-- Certificate_name -->
        <div class="mt-4">
            <x-input-label for="C_name" :value="__('Certificate Name')" />
            <x-text-input id="C_name" class="block mt-1 w-full" type="text" name="C_name" :value="old('C_name')" required />
            <x-input-error :messages="$errors->get('C_name')" class="mt-2" />
        </div>

        <!-- Certificate_number -->
        <div class="mt-4">
            <x-input-label for="Certificate Number" :value="__('Certificate Number')" />
            <x-text-input id="Certificate Number" class="block mt-1 w-full" type="text" name="C_no" :value="old('C_no')" required />
            <x-input-error :messages="$errors->get('Certificate Number')" class="mt-2" />
        </div>

        <!-- Professional_cert_no -->
        <div class="mt-4">
            <x-input-label for="p_cert_no" :value="__('Professional Certificate Number')" />
            <x-text-input id="Professional Certificate Number" class="block mt-1 w-full" type="text" name="p_No_cert" :value="old('p_No_cert')" required />
            <x-input-error :messages="$errors->get('Professional Certificate Number')" class="mt-2" />
        </div>

        <!-- p_name -->
        <div class="mt-4">
            <x-input-label for="p_name" :value="__('Permit Name')" />
            <x-text-input id="p_name" class="block mt-1 w-full" type="text" name="p_name" :value="old('p_name')" required />
            <x-input-error :messages="$errors->get('p_name')" class="mt-2" />
        </div>

        <!-- Identification -->
        <div class="mt-4">
            <x-input-label for="identification" :value="__('Identification')" />
            <x-text-input id="identification" class="block mt-1 w-full" type="text" name="identification" :value="old('identification')" required />
            <x-input-error :messages="$errors->get('identification')" class="mt-2" />
        </div>

        <!-- Resident Type (Hidden Field) -->
        <input type="hidden" name="resident_type" value="{{ request('type', session('selected_resident_type', 'NON-RESIDENT')) }}" />

        <!-- Conditional Fields Based on Resident Type -->
        @if(request('type', session('selected_resident_type', 'NON-RESIDENT')) === 'RESIDENT')
            <!-- Additional fields for RESIDENT -->
            <div class="mt-4">
                <x-input-label for="residence_address" :value="__('Residence Address')" />
                <x-text-input id="residence_address" class="block mt-1 w-full" type="text" name="residence_address" :value="old('residence_address')" required />
                <x-input-error :messages="$errors->get('residence_address')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="residence_duration" :value="__('Duration of Residence (Years)')" />
                <x-text-input id="residence_duration" class="block mt-1 w-full" type="number" name="residence_duration" :value="old('residence_duration')" required />
                <x-input-error :messages="$errors->get('residence_duration')" class="mt-2" />
            </div>
        @else
            <!-- Additional fields for NON-RESIDENT -->
            <div class="mt-4">
                <x-input-label for="visa_type" :value="__('Visa Type')" />
                <x-text-input id="visa_type" class="block mt-1 w-full" type="text" name="visa_type" :value="old('visa_type')" required />
                <x-input-error :messages="$errors->get('visa_type')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="visa_expiry" :value="__('Visa Expiry Date')" />
                <x-text-input id="visa_expiry" class="block mt-1 w-full" type="date" name="visa_expiry" :value="old('visa_expiry')" required />
                <x-input-error :messages="$errors->get('visa_expiry')" class="mt-2" />
            </div>
        @endif

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Submit Bio Data') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
