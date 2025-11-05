<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white min-h-screen">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-4">Admin Panel</h3>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('admin.bioData.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Bio Data</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('biodataCollect') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Add New Bio Data</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.employees.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Employees</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Users</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('profile.edit') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Profile</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create New User') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <form method="POST" action="{{ route('admin.users.store') }}">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- First Name -->
                                    <div>
                                        <x-input-label for="first_name" :value="__('First Name')" />
                                        <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>

                                    <!-- Last Name -->
                                    <div>
                                        <x-input-label for="last_name" :value="__('Last Name')" />
                                        <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Phone Number -->
                                    <div>
                                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                                        <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number" :value="old('phone_number')" required autocomplete="tel" />
                                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div>
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <x-input-label for="status" :value="__('Status')" />
                                        <select id="status" name="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                            <option value="">-- Select Status --</option>
                                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="Deactivated" {{ old('status') == 'Deactivated' ? 'selected' : '' }}>Deactivated</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>

                                    <!-- User Type -->
                                    <div>
                                        <x-input-label for="usertype_id" :value="__('User Type')" />
                                        <select id="usertype_id" name="usertype_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                            <option value="">-- Select User Type --</option>
                                            @foreach($usertypes as $usertype)
                                                <option value="{{ $usertype->id }}" {{ old('usertype_id') == $usertype->id ? 'selected' : '' }}>{{ $usertype->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('usertype_id')" class="mt-2" />
                                    </div>

                                    <!-- Nationality -->
                                    <div>
                                        <x-input-label for="nationality_id" :value="__('Nationality')" />
                                        <select id="nationality_id" name="nationality_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                            <option value="">-- Select Nationality --</option>
                                            @foreach($nationalities as $nationality)
                                                <option value="{{ $nationality->id }}" {{ old('nationality_id') == $nationality->id ? 'selected' : '' }}>{{ $nationality->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('nationality_id')" class="mt-2" />
                                    </div>

                                    <!-- ID Type -->
                                    <div>
                                        <x-input-label for="id_type" :value="__('ID Type')" />
                                        <select id="id_type" name="id_type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                            <option value="">-- Select ID Type --</option>
                                            <option value="Passport" {{ old('id_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                            <option value="ID" {{ old('id_type') == 'ID' ? 'selected' : '' }}>ID</option>
                                            <option value="Birth Certificate" {{ old('id_type') == 'Birth Certificate' ? 'selected' : '' }}>Birth Certificate</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('id_type')" class="mt-2" />
                                    </div>

                                    <!-- ID Number -->
                                    <div>
                                        <x-input-label for="id_number" :value="__('ID Number')" />
                                        <x-text-input id="id_number" class="block mt-1 w-full" type="text" name="id_number" :value="old('id_number')" autocomplete="off" />
                                        <x-input-error :messages="$errors->get('id_number')" class="mt-2" />
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <x-input-label for="gender" :value="__('Gender')" />
                                        <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                            <option value="">-- Select Gender --</option>
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="flex items-center justify-end mt-6">
                                    <x-primary-button>
                                        {{ __('Create User') }}
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
