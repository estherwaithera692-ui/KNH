<x-app-layout>
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white min-h-screen">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-4">Admin Panel</h3>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('admin.bioData.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Applications</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('biodataCollect') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Add New Bio Data</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('admin.employees.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Employees</a>
                    </li>
                    {{-- <li class="mb-2">
                        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Manage Users</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('profile.edit') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Profile</a>
                    </li> --}}
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Applications Management') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <a href="{{ route('biodataCollect') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                                Add New Bio Data
                            </a>

                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">First Name</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Last Name</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Identification</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Phone Number</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Resident Type</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Applicant Email</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                        <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    @foreach($bioData as $data)
                                    <tr class="text-center">
                                        <td class="py-3 px-4">{{ $data->id }}</td>
                                        <td class="py-3 px-4">{{ $data->firstName }}</td>
                                        <td class="py-3 px-4">{{ $data->lastName }}</td>
                                        <td class="py-3 px-4">{{ $data->identification }}</td>
                                        <td class="py-3 px-4">{{ $data->phoneNumber }}</td>
                                        <td class="py-3 px-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if($data->resident_type == 'RESIDENT') bg-green-100 text-green-800
                                                @elseif($data->resident_type == 'NON-RESIDENT') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $data->resident_type ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">{{ $data->user->email }}</td>
                                        <td class="py-3 px-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if($data->status === 'approved') bg-green-100 text-green-800
                                                @elseif($data->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($data->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('admin.bioData.show', $data->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">View</a>
                                            @if($data->status === 'pending')
                                            <a href="{{ route('admin.bioData.edit', $data->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</a>
                                            <form action="{{ route('admin.bioData.approve', $data->id) }}" method="POST" class="inline mr-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to approve this application?')">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.bioData.reject', $data->id) }}" method="POST" class="inline mr-2">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to reject this application?')">Reject</button>
                                            </form>
                                            @endif
                                            <form action="{{ route('admin.bioData.destroy', $data->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
