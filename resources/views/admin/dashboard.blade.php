<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Admin Panel</title>
    <link rel="icon" href="{{ asset('img/bg-icon.png') }}" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/bg-icon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .stat-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-radius: 10px;
            padding: 20px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .stat-card.approved {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stat-card.rejected {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        }
        .stat-card.pending {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-2"><i class="fas fa-hospital mr-2"></i>Medical HR</h2>
            <p class="text-sm opacity-75">Admin Panel</p>
        </div>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition duration-300">
                        <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.employees.index') }}" class="flex items-center py-3 px-4 rounded-lg bg-white bg-opacity-20 transition duration-300">
                        <i class="fas fa-users mr-3"></i>Employees
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.employees.create') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition duration-300">
                        <i class="fas fa-user-plus mr-3"></i>Add Employee
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.bioData.index') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition duration-300">
                        <i class="fas fa-id-card mr-3"></i>Bio Data
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition duration-300">
                        <i class="fas fa-user-cog mr-3"></i>Profile
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition duration-300 w-full text-left">
                            <i class="fas fa-sign-out-alt mr-3"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Bio Data Management</h1>
                <p class="text-gray-600">Manage user bio data records</p>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-75">Total Applications</p>
                        <p class="text-2xl font-bold">{{ $stats['total_bio_data'] }}</p>
                    </div>
                    <i class="fas fa-file-alt text-3xl"></i>
                </div>
            </div>
            <div class="stat-card approved">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-75">Approved</p>
                        <p class="text-2xl font-bold">{{ $stats['approved_applications'] }}</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl"></i>
                </div>
            </div>
            <div class="stat-card pending">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-75">Pending Review</p>
                        <p class="text-2xl font-bold">{{ $stats['pending_verifications'] }}</p>
                    </div>
                    <i class="fas fa-clock text-3xl"></i>
                </div>
            </div>
            <div class="stat-card rejected">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white text-opacity-75">Rejected</p>
                        <p class="text-2xl font-bold">{{ $stats['rejected_applications'] }}</p>
                    </div>
                    <i class="fas fa-times-circle text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Recent Applications -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Applications</h2>
            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Resident Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recent_applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $application->firstName }} {{ $application->lastName }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $application->user->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($application->resident_type == 'RESIDENT') bg-green-100 text-green-800
                                        @elseif($application->resident_type == 'NON-RESIDENT') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $application->resident_type ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($application->status == 'approved') bg-green-100 text-green-800
                                        @elseif($application->status == 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $application->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.bioData.show', $application) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($application->status == 'pending')
                                        <a href="{{ route('admin.bioData.edit', $application) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.bioData.approve', $application) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Are you sure you want to approve this application?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bioData.reject', $application) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to reject this application?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No recent applications found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pending Applications -->
        @if($pending_applications->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Pending Review</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pending_applications as $application)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-400">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $application->firstName }} {{ $application->lastName }}
                        </h3>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p><strong>Email:</strong> {{ $application->user->email ?? 'N/A' }}</p>
                        <p><strong>Type:</strong> {{ $application->resident_type ?? 'N/A' }}</p>
                        <p><strong>Submitted:</strong> {{ $application->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="mt-4 flex space-x-2">
                        <a href="{{ route('admin.bioData.show', $application) }}" class="btn-primary text-xs">
                            <i class="fas fa-eye mr-1"></i>View
                        </a>
                        <a href="{{ route('admin.bioData.edit', $application) }}" class="btn-secondary text-xs">
                            <i class="fas fa-edit mr-1"></i>Review
                        </a>
                        <form action="{{ route('admin.bioData.approve', $application) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white text-xs px-3 py-1 rounded" onclick="return confirm('Are you sure you want to approve this application?')">
                                <i class="fas fa-check mr-1"></i>Approve
                            </button>
                        </form>
                        <form action="{{ route('admin.bioData.reject', $application) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-xs px-3 py-1 rounded" onclick="return confirm('Are you sure you want to reject this application?')">
                                <i class="fas fa-times mr-1"></i>Reject
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    </div>
    @endif

    <script>
        // Auto-hide success message
        setTimeout(() => {
            const message = document.querySelector('.bg-green-500');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>
