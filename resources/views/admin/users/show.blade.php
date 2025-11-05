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
                    {{ __('User Details') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="mb-4">
                                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Back to Users
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded ml-2">
                                    Edit User
                                </a>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <strong>First Name:</strong> {{ $user->first_name }}
                                </div>
                                <div>
                                    <strong>Last Name:</strong> {{ $user->last_name }}
                                </div>
                                <div>
                                    <strong>Email:</strong> {{ $user->email }}
                                </div>
                                <div>
                                    <strong>Phone Number:</strong> {{ $user->phone_number ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>Status:</strong>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $user->status === 'Active' ? 'bg-green-100 text-green-800' :
                                           ($user->status === 'Inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $user->status }}
                                    </span>
                                </div>
                                <div>
                                    <strong>User Type:</strong> {{ $user->usertype->name ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>Nationality:</strong> {{ $user->nationality->name ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>ID Type:</strong> {{ $user->id_type ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>ID Number:</strong> {{ $user->id_number ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>Gender:</strong> {{ $user->gender ?? 'N/A' }}
                                </div>
                                <div>
                                    <strong>Email Verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}
                                </div>
                                <div>
                                    <strong>Created At:</strong> {{ $user->created_at->format('Y-m-d H:i:s') }}
                                </div>
                                <div>
                                    <strong>Updated At:</strong> {{ $user->updated_at->format('Y-m-d H:i:s') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
