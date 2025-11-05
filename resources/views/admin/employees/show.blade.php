<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details - Admin Panel</title>
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
        .detail-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
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
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-section h3 {
            color: #2563eb;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .info-section h3 i {
            margin-right: 8px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }
        .info-item {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #2563eb;
        }
        .info-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 1rem;
            color: #1e293b;
            font-weight: 600;
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
                    <a href="{{ route('admin.employees.index') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition duration-300">
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
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Employee Details</h1>
            <p class="text-gray-600">Detailed information for {{ $employee->first_name }} {{ $employee->last_name }}</p>
        </div>

        <div class="detail-container">
            <!-- Header with Actions -->
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-user text-3xl text-gray-600"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $employee->first_name }} {{ $employee->last_name }}</h2>
                        <p class="text-gray-600">{{ $employee->job_title }} - {{ $employee->department }}</p>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                            @if($employee->role == 'Doctor') bg-blue-100 text-blue-800
                            @elseif($employee->role == 'Nurse') bg-green-100 text-green-800
                            @elseif($employee->role == 'Pharmacist') bg-purple-100 text-purple-800
                            @elseif($employee->role == 'Lab Tech') bg-yellow-100 text-yellow-800
                            @elseif($employee->role == 'Admin') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $employee->role }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.employees.edit', $employee) }}" class="btn-primary">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.employees.destroy', $employee) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-secondary">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="info-section">
                <h3><i class="fas fa-user text-blue-600"></i>Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Employee ID</div>
                        <div class="info-value">{{ $employee->employee_id }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $employee->first_name }} {{ $employee->last_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Gender</div>
                        <div class="info-value">{{ $employee->gender }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Date of Birth</div>
                        <div class="info-value">{{ $employee->date_of_birth->format('M d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">National ID</div>
                        <div class="info-value">{{ $employee->national_id }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Age</div>
                        <div class="info-value">{{ $employee->date_of_birth->age }} years old</div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="info-section">
                <h3><i class="fas fa-phone text-green-600"></i>Contact Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Contact Number</div>
                        <div class="info-value">{{ $employee->contact_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $employee->email }}</div>
                    </div>
                    <div class="info-item" style="grid-column: span 2;">
                        <div class="info-label">Address</div>
                        <div class="info-value">{{ $employee->address }}</div>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="info-section">
                <h3><i class="fas fa-briefcase text-purple-600"></i>Professional Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Job Title</div>
                        <div class="info-value">{{ $employee->job_title }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Department</div>
                        <div class="info-value">{{ $employee->department }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Qualification</div>
                        <div class="info-value">{{ $employee->qualification }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Years of Experience</div>
                        <div class="info-value">{{ $employee->years_of_experience }} years</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Date Joined</div>
                        <div class="info-value">{{ $employee->date_joined->format('M d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Role</div>
                        <div class="info-value">{{ $employee->role }}</div>
                    </div>
                </div>
            </div>

            <!-- Medical Credentials -->
            <div class="info-section">
                <h3><i class="fas fa-certificate text-red-600"></i>Medical Credentials</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">License Number</div>
                        <div class="info-value">{{ $employee->license_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">License Expiry Date</div>
                        <div class="info-value {{ $employee->license_expiry_date <= now()->addDays(30) ? 'text-red-600 font-bold' : '' }}">
                            {{ $employee->license_expiry_date->format('M d, Y') }}
                            @if($employee->license_expiry_date <= now()->addDays(30))
                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded ml-2">Expiring Soon</span>
                            @endif
                        </div>
                    </div>
                    @if($employee->certificate_path)
                    <div class="info-item" style="grid-column: span 2;">
                        <div class="info-label">Certificate</div>
                        <div class="info-value">
                            <a href="{{ asset('storage/' . $employee->certificate_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                <i class="fas fa-file-download mr-2"></i>View Certificate
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="info-section">
                <h3><i class="fas fa-phone-alt text-orange-600"></i>Emergency Contact</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Contact Name</div>
                        <div class="info-value">{{ $employee->emergency_contact_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Relationship</div>
                        <div class="info-value">{{ $employee->emergency_contact_relationship }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Contact Phone</div>
                        <div class="info-value">{{ $employee->emergency_contact_phone }}</div>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="info-section">
                <h3><i class="fas fa-clock text-gray-600"></i>System Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Created At</div>
                        <div class="info-value">{{ $employee->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $employee->updated_at->format('M d, Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <a href="{{ route('admin.employees.index') }}" class="btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Employees
                </a>
            </div>
        </div>
    </div>
</body>
</html>
