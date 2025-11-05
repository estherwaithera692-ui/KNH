<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white min-h-screen">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-4">EDIT BIO DATA</h3>
                <ul>
                    {{-- <li class="mb-2">
                        <a href="{{ route('admin.bioData.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Bio Data</a>
                    </li> --}}
                    {{-- <li class="mb-2">
                        <a href="{{ route('biodataCollect') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Add New Bio Data</a>
                    </li> --}}
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    {{-- <li class="mb-2">
                        <a href="{{ route('profile.edit') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Profile</a>
                    </li> --}}
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{-- {{ __('Edit Bio Data') }} --}}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <form method="POST" action="{{ route('admin.bioData.update', $bioData->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Identification -->
                                <div class="mt-4">
                                    <x-input-label for="identification" :value="__('Identification')" />
                                    <x-text-input id="identification" class="block mt-1 w-full" type="text" name="identification" :value="old('identification', $bioData->identification)" required />
                                    <x-input-error :messages="$errors->get('identification')" class="mt-2" />
                                </div>

                                <!-- First Name -->
                                <div class="mt-4">
                                    <x-input-label for="firstName" :value="__('First Name')" />
                                    <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName', $bioData->firstName)" required autofocus autocomplete="given-name" />
                                    <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                                </div>

                                <!-- Last Name -->
                                <div class="mt-4">
                                    <x-input-label for="lastName" :value="__('Last Name')" />
                                    <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName', $bioData->lastName)" required autocomplete="family-name" />
                                    <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                                </div>

                                <!-- Gender -->
                                <div class="mt-4">
                                    <x-input-label for="gender" :value="__('Gender')" />
                                    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="">-- Select Gender --</option>
                                        <option value="Male" {{ old('gender', $bioData->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $bioData->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Transgender" {{ old('gender', $bioData->gender) == 'Transgender' ? 'selected' : '' }}>Transgender</option>
                                        <option value="Intersex" {{ old('gender', $bioData->gender) == 'Intersex' ? 'selected' : '' }}>Intersex</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                </div>

                                <!-- Nationality -->
                                <div class="mt-4">
                                    <x-input-label for="nationality" :value="__('Nationality')" />
                                    <select id="nationality" name="nationality" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="">-- Select Nationality --</option>
                                        @foreach($nationalities as $nat)
                                            <option value="{{ $nat->name }}" {{ old('nationality', $bioData->nationality) == $nat->name ? 'selected' : '' }}>{{ $nat->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                                </div>

                                <!-- Phone Number -->
                                <div class="mt-4">
                                    <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                                    <x-text-input id="phoneNumber" class="block mt-1 w-full" type="tel" name="phoneNumber" :value="old('phoneNumber', $bioData->phoneNumber)" required />
                                    <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                                </div>

                                <!-- HAC -->
                                <div class="mt-4">
                                    <x-input-label for="HAC" :value="__('HAC')" />
                                    <x-text-input id="HAC" class="block mt-1 w-full" type="text" name="HAC" :value="old('HAC', $bioData->HAC)" required />
                                    <x-input-error :messages="$errors->get('HAC')" class="mt-2" />
                                </div>

                                <!-- C_name -->
                                <div class="mt-4">
                                    <x-input-label for="C_name" :value="__('Company Name')" />
                                    <x-text-input id="C_name" class="block mt-1 w-full" type="text" name="C_name" :value="old('C_name', $bioData->C_name)" required />
                                    <x-input-error :messages="$errors->get('C_name')" class="mt-2" />
                                </div>

                                <!-- C_no -->
                                <div class="mt-4">
                                    <x-input-label for="C_no" :value="__('Company Number')" />
                                    <x-text-input id="C_no" class="block mt-1 w-full" type="text" name="C_no" :value="old('C_no', $bioData->C_no)" required />
                                    <x-input-error :messages="$errors->get('C_no')" class="mt-2" />
                                </div>

                                <!-- p_No_cert -->
                                <div class="mt-4">
                                    <x-input-label for="p_No_cert" :value="__('Permit Number Certificate')" />
                                    <x-text-input id="p_No_cert" class="block mt-1 w-full" type="text" name="p_No_cert" :value="old('p_No_cert', $bioData->p_No_cert)" required />
                                    <x-input-error :messages="$errors->get('p_No_cert')" class="mt-2" />
                                </div>

                                <!-- p_name -->
                                <div class="mt-4">
                                    <x-input-label for="p_name" :value="__('Permit Name')" />
                                    <x-text-input id="p_name" class="block mt-1 w-full" type="text" name="p_name" :value="old('p_name', $bioData->p_name)" required />
                                    <x-input-error :messages="$errors->get('p_name')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-6">
                                    <a href="{{ route('admin.bioData.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                                    <x-primary-button>
                                        {{ __('Update Bio Data') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
