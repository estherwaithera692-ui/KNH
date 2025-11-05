<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Registration System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            font-size: 1.2rem;
            color: #3498db;
            font-weight: 500;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(45deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .admin-badge {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .content-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .status-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .status-card:hover {
            transform: translateY(-5px);
        }

        .status-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .status-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .status-description {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            display: inline-block;
            padding: 15px 25px;
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }

        .action-btn.secondary {
            background: linear-gradient(45deg, #3498db, #2980b9);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .action-btn.secondary:hover {
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .sidebar-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .sidebar-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .recent-activity {
            list-style: none;
        }

        .activity-item {
            padding: 15px 0;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #ecf0f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 3px;
        }

        .activity-time {
            font-size: 0.85rem;
            color: #7f8c8d;
        }

        .progress-section {
            text-align: center;
        }

        .progress-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: conic-gradient(#27ae60 {{ $progress }}%, #ecf0f1 {{ $progress }}%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            position: relative;
        }

        .progress-circle::before {
            content: '';
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: white;
            position: absolute;
        }

        .progress-text {
            position: relative;
            z-index: 1;
            font-size: 1.5rem;
            font-weight: bold;
            color: #27ae60;
        }

        .progress-label {
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .status-cards {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1 class="welcome-title">Welcome Back!</h1>
            <p class="welcome-subtitle">Here's your personal dashboard overview</p>
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}</div>
                <span>{{ $user->name ?? 'User' }}</span>
                @if($user->usertype && $user->usertype->name === 'Admin')
                    <span class="admin-badge">ADMIN</span>
                @endif
            </div>
        </div>

        <div class="main-content">
            <div>
                <div class="content-section">
                    <h2 class="section-title">📋 Your Registration Status</h2>
                    {{-- <div class="status-cards">
                        <div class="status-card">
                            <div class="status-icon">📝</div>
                            <div class="status-title">Bio Data</div>
                            <div class="status-description">
                                {{ $bioData ? 'Completed' : 'Not Submitted' }}
                            </div>
                        </div>
                        <div class="status-card">
                            <div class="status-icon">📄</div>
                            <div class="status-title">Documents</div>
                            <div class="status-description">
                                {{ $bioData && $bioData->certificate_files ? 'Uploaded' : 'Pending' }}
                            </div>
                        </div>
                        <div class="status-card">
                            <div class="status-icon">✅</div>
                            <div class="status-title">Verification</div>
                            <div class="status-description">
                                {{ $user->status == 'Active' ? 'Verified' : 'In Progress' }}
                            </div>
                        </div>
                    </div> --}}

                    <div class="action-buttons">
                        @php
                            $userType = auth()->user()->usertype ? auth()->user()->usertype->name : null;
                            $bioDataType = $bioData ? $bioData->resident_type : null;
                            $defaultType = ($userType === 'Resident') ? 'RESIDENT' : 'NON-RESIDENT';
                            $type = $bioDataType ?: $defaultType;
                        @endphp
                        <a href="{{ route('biodataCollect') }}?type={{ $type }}" class="action-btn">
                            {{ $bioData ? 'Update Bio Data' : 'Submit Bio Data' }}
                        </a>
                        <a href="{{ url('/profile') }}" class="action-btn secondary">Edit Profile</a>

                        <!-- Resident Type Dropdown -->
                        {{-- <div class="action-btn" style="background: linear-gradient(45deg, #f39c12, #e67e22); box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3); cursor: default;">
                            <select id="resident_type" name="resident_type" onchange="updateResidentType(this.value)" style="background: transparent; border: none; color: white; font-weight: 600; cursor: pointer; width: 100%;">
                                <option value="" style="color: black;">Select Resident Type</option>
                                <option value="NON-RESIDENT" {{ ($bioData && $bioData->resident_type == 'NON-RESIDENT') ? 'selected' : '' }} style="color: black;">NON-RESIDENT</option>
                                <option value="RESIDENT" {{ ($bioData && $bioData->resident_type == 'RESIDENT') ? 'selected' : '' }} style="color: black;">RESIDENT</option>
                            </select>
                        </div> --}}

                        @if($user->usertype && $user->usertype->name === 'Admin')
                            <a href="{{ route('admin.bioData.index') }}" class="action-btn" style="background: linear-gradient(45deg, #e74c3c, #c0392b); box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);">Admin Panel</a>
                        @endif

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="action-btn" style="background: linear-gradient(45deg, #95a5a6, #7f8c8d); box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3); border: none; cursor: pointer; width: 100%;">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="sidebar">
                <div class="sidebar-section progress-section">
                    <h3 class="sidebar-title">📊 Completion Progress</h3>
                    <div class="progress-circle">
                        <div class="progress-text">
                            {{ $progress }}%
                        </div>
                    </div>
                    <div class="progress-label">
                        Registration Complete
                    </div>
                </div>

                <div class="sidebar-section">
                    <h3 class="sidebar-title">🔔 Recent Activity</h3>
                    <ul class="recent-activity">
                        <li class="activity-item">
                            <div class="activity-icon">👤</div>
                            <div class="activity-content">
                                <div class="activity-title">Profile Updated</div>
                                <div class="activity-time">2 hours ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">📝</div>
                            <div class="activity-content">
                                <div class="activity-title">
                                    {{ $bioData ? 'Bio Data Submitted' : 'Bio Data Pending' }}
                                </div>
                                <div class="activity-time">{{ $bioData ? '1 day ago' : 'Not yet' }}</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-icon">🔐</div>
                            <div class="activity-content">
                                <div class="activity-title">Account Created</div>
                                <div class="activity-time">{{ $user->created_at->diffForHumans() }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> --}}
        </div>
    <script>
        function updateResidentType(residentType) {
            if (!residentType) return;

            fetch('/update-resident-type', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    resident_type: residentType
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Resident type updated successfully!');
                    location.reload();
                } else {
                    alert('Error updating resident type: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating resident type. Please try again.');
            });
        }
    </script>
</body>
</html>
