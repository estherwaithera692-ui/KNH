<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resident Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Resident Information</h3>
                        <div>
                            <a href="{{ route('admin.residents.edit', $resident) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit Resident
                            </a>
                            <a href="{{ route('admin.residents.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Personal Information -->
                        <div>
                            <h4 class="text-md font-semibold mb-4 text-gray-700">Personal Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <strong class="text-gray-600">Full Name:</strong>
                                    <span>{{ $resident->first_name }} {{ $resident->last_name }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Identification Number:</strong>
                                    <span>{{ $resident->identification_number }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Phone Number:</strong>
                                    <span>{{ $resident->phone_number }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Email:</strong>
                                    <span>{{ $resident->email ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Date of Birth:</strong>
                                    <span>{{ $resident->date_of_birth->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Gender:</strong>
                                    <span>{{ $resident->gender }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Nationality:</strong>
                                    <span>{{ $resident->nationality->name ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Marital Status:</strong>
                                    <span>{{ $resident->marital_status }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Occupation:</strong>
                                    <span>{{ $resident->occupation ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div>
                            <h4 class="text-md font-semibold mb-4 text-gray-700">Address Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <strong class="text-gray-600">Address:</strong>
                                    <span>{{ $resident->address }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">City:</strong>
                                    <span>{{ $resident->city }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">State:</strong>
                                    <span>{{ $resident->state }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Postal Code:</strong>
                                    <span>{{ $resident->postal_code }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Residency Information -->
                        <div>
                            <h4 class="text-md font-semibold mb-4 text-gray-700">Residency Information</h4>
                            <div class="space-y-3">
                                <div>
                                    <strong class="text-gray-600">Resident Number:</strong>
                                    <span>{{ $resident->resident_number }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Resident Area:</strong>
                                    <span>{{ $resident->resident_area }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Role:</strong>
                                    <span>{{ $resident->role }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Department:</strong>
                                    <span>{{ $resident->department }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Start Date:</strong>
                                    <span>{{ $resident->start_date->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">End Date:</strong>
                                    <span>{{ $resident->end_date ? $resident->end_date->format('M d, Y') : 'Ongoing' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Status and Registration -->
                        <div>
                            <h4 class="text-md font-semibold mb-4 text-gray-700">Status & Registration</h4>
                            <div class="space-y-3">
                                <div>
                                    <strong class="text-gray-600">Registration Date:</strong>
                                    <span>{{ $resident->registration_date->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <strong class="text-gray-600">Status:</strong>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $resident->status === 'Active' ? 'bg-green-100 text-green-800' :
                                           ($resident->status === 'Inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $resident->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Credentials -->
                    @if($resident->medical_credentials)
                    <div class="mt-8">
                        <h4 class="text-md font-semibold mb-4 text-gray-700">Medical Credentials</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-800 whitespace-pre-line">{{ $resident->medical_credentials }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Delete Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <form method="POST" action="{{ route('admin.residents.destroy', $resident) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this resident?')">
                                Delete Resident
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
