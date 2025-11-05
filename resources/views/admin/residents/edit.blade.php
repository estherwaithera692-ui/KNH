<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Resident') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.residents.update', $resident) }}">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $resident->first_name)" required />
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $resident->last_name)" required />
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="identification_number" :value="__('Identification Number')" />
                                    <x-text-input id="identification_number" name="identification_number" type="text" class="mt-1 block w-full" :value="old('identification_number', $resident->identification_number)" required />
                                    <x-input-error :messages="$errors->get('identification_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="phone_number" :value="__('Phone Number')" />
                                    <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full" :value="old('phone_number', $resident->phone_number)" required />
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $resident->email)" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                    <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $resident->date_of_birth->format('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender', $resident->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $resident->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender', $resident->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="nationality_id" :value="__('Nationality')" />
                                    <select id="nationality_id" name="nationality_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Nationality</option>
                                        @foreach($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}" {{ old('nationality_id', $resident->nationality_id) == $nationality->id ? 'selected' : '' }}>{{ $nationality->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('nationality_id')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Address Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <x-input-label for="address" :value="__('Address')" />
                                    <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('address', $resident->address) }}</textarea>
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="city" :value="__('City')" />
                                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $resident->city)" required />
                                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="state" :value="__('State')" />
                                    <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $resident->state)" required />
                                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="postal_code" :value="__('Postal Code')" />
                                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $resident->postal_code)" required />
                                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Residency Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Residency Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="resident_number" :value="__('Resident Number')" />
                                    <x-text-input id="resident_number" name="resident_number" type="text" class="mt-1 block w-full" :value="old('resident_number', $resident->resident_number)" required />
                                    <x-input-error :messages="$errors->get('resident_number')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="resident_area" :value="__('Resident Area')" />
                                    <x-text-input id="resident_area" name="resident_area" type="text" class="mt-1 block w-full" :value="old('resident_area', $resident->resident_area)" placeholder="e.g., University, Hospital" required />
                                    <x-input-error :messages="$errors->get('resident_area')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="role" :value="__('Role')" />
                                    <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $resident->role)" placeholder="e.g., Doctor, Nurse, Student" required />
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="department" :value="__('Department')" />
                                    <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="old('department', $resident->department)" placeholder="e.g., Surgery, Pediatrics" required />
                                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $resident->start_date->format('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="end_date" :value="__('End Date (Optional)')" />
                                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $resident->end_date ? $resident->end_date->format('Y-m-d') : '')" />
                                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Medical Credentials -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Medical Credentials</h3>
                            <div>
                                <x-input-label for="medical_credentials" :value="__('Medical Credentials')" />
                                <textarea id="medical_credentials" name="medical_credentials" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Enter medical qualifications, certifications, etc.">{{ old('medical_credentials', $resident->medical_credentials) }}</textarea>
                                <x-input-error :messages="$errors->get('medical_credentials')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-gray-800">Additional Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="marital_status" :value="__('Marital Status')" />
                                    <select id="marital_status" name="marital_status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">Select Marital Status</option>
                                        <option value="Single" {{ old('marital_status', $resident->marital_status) == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ old('marital_status', $resident->marital_status) == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ old('marital_status', $resident->marital_status) == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ old('marital_status', $resident->marital_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="occupation" :value="__('Occupation')" />
                                    <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full" :value="old('occupation', $resident->occupation)" />
                                    <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="registration_date" :value="__('Registration Date')" />
                                    <x-text-input id="registration_date" name="registration_date" type="date" class="mt-1 block w-full" :value="old('registration_date', $resident->registration_date->format('Y-m-d'))" required />
                                    <x-input-error :messages="$errors->get('registration_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="Active" {{ old('status', $resident->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Inactive" {{ old('status', $resident->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="Suspended" {{ old('status', $resident->status) == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.residents.show', $resident) }}" class="mr-4 text-gray-600 hover:text-gray-900">Cancel</a>
                            <x-primary-button>
                                {{ __('Update Resident') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
