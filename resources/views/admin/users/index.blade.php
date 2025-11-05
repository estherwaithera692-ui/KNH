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
                        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded bg-gray-700">Manage Users</a>
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
                    {{ __('User Management') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                                Add New User
                            </a>

                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white">
                                    <thead class="bg-gray-800 text-white">
                                        <tr>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Phone</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">User Type</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Nationality</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">ID Type</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Gender</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        @foreach($users as $user)
                                        <tr class="text-center">
                                            <td class="py-3 px-4">{{ $user->id }}</td>
                                            <td class="py-3 px-4">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="py-3 px-4">{{ $user->email }}</td>
                                            <td class="py-3 px-4">{{ $user->phone_number ?? 'N/A' }}</td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $user->status === 'Active' ? 'bg-green-100 text-green-800' :
                                                       ($user->status === 'Inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ $user->status }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">{{ $user->usertype->name ?? 'N/A' }}</td>
                                            <td class="py-3 px-4">{{ $user->nationality->name ?? 'N/A' }}</td>
                                            <td class="py-3 px-4">{{ $user->id_type ?? 'N/A' }}</td>
                                            <td class="py-3 px-4">{{ $user->gender ?? 'N/A' }}</td>
                                            <td class="py-3 px-4">
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2">View</a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">Edit</a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
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

                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
