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
                    {{ __('Bio Data Details') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <strong>Identification:</strong> {{ $bioData->identification }}
                                </div>
                                <div>
                                    <strong>First Name:</strong> {{ $bioData->firstName }}
                                </div>
                                <div>
                                    <strong>Last Name:</strong> {{ $bioData->lastName }}
                                </div>
                                <div>
                                    <strong>Gender:</strong> {{ $bioData->gender }}
                                </div>
                                <div>
                                    <strong>Nationality:</strong> {{ $bioData->nationality }}
                                </div>
                                <div>
                                    <strong>Phone Number:</strong> {{ $bioData->phoneNumber }}
                                </div>
                                <div>
                                    <strong>Highest Academic Certificate:</strong> {{ $bioData->highest_academic_certificate }}
                                </div>
                                <div>
                                    <strong>Professional Certificate:</strong> {{ $bioData->professional_certificate }}
                                </div>
                                <div>
                                    <strong>Highest Academic Certificate File:</strong>
                                    @if($bioData->highest_academic_certificate_file)
                                        <a href="{{ route('admin.bioData.certificate.view', [$bioData->id, 'academic']) }}" target="_blank" class="text-blue-500 hover:text-blue-700">View</a> |
                                        <a href="{{ route('admin.bioData.certificate.download', [$bioData->id, 'academic']) }}" class="text-green-500 hover:text-green-700">Download</a>
                                    @else
                                        No file uploaded
                                    @endif
                                </div>
                                <div>
                                    <strong>Professional Certificate File:</strong>
                                    @if($bioData->professional_certificate_file)
                                        <a href="{{ route('admin.bioData.certificate.view', [$bioData->id, 'professional']) }}" target="_blank" class="text-blue-500 hover:text-blue-700">View</a> |
                                        <a href="{{ route('admin.bioData.certificate.download', [$bioData->id, 'professional']) }}" class="text-green-500 hover:text-green-700">Download</a>
                                    @else
                                        No file uploaded
                                    @endif
                                </div>
                                <div>
                                    <strong>Company Name:</strong> {{ $bioData->C_name }}
                                </div>
                                <div>
                                    <strong>Company Number:</strong> {{ $bioData->C_no }}
                                </div>
                                <div>
                                    <strong>Permit Number Certificate:</strong> {{ $bioData->p_No_cert }}
                                </div>
                                <div>
                                    <strong>Permit Name:</strong> {{ $bioData->p_name }}
                                </div>
                                <div>
                                    <strong>Resident Type:</strong> {{ $bioData->resident_type }}
                                </div>
                                @if($bioData->resident_type === 'RESIDENT')
                                <div>
                                    <strong>Residence Address:</strong> {{ $bioData->residence_address }}
                                </div>
                                <div>
                                    <strong>Residence Duration:</strong> {{ $bioData->residence_duration }} months
                                </div>
                                @else
                                <div>
                                    <strong>Visa Type:</strong> {{ $bioData->visa_type }}
                                </div>
                                <div>
                                    <strong>Visa Expiry:</strong> {{ $bioData->visa_expiry }}
                                </div>
                                @endif
                                <div>
                                    <strong>Status:</strong>
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($bioData->status === 'approved') bg-green-100 text-green-800
                                        @elseif($bioData->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($bioData->status) }}
                                    </span>
                                </div>
                                <div>
                                    <strong>Applicant Email:</strong> {{ $bioData->user->email }}
                                </div>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('admin.bioData.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Back to List</a>
                                <a href="{{ route('admin.bioData.edit', $bioData->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                @if($bioData->status === 'pending')
                                <form action="{{ route('admin.bioData.approve', $bioData->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">Approve</button>
                                </form>
                                <form action="{{ route('admin.bioData.reject', $bioData->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
