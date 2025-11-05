<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report - Medical Organization</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        .header p {
            margin: 0;
            color: #666;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 5px;
        }
        .summary-item {
            text-align: center;
            flex: 1;
        }
        .summary-item h3 {
            margin: 0 0 5px 0;
            font-size: 18px;
            color: #2563eb;
        }
        .summary-item p {
            margin: 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background: #2563eb;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .role-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .role-doctor { background: #dbeafe; color: #1e40af; }
        .role-nurse { background: #dcfce7; color: #166534; }
        .role-pharmacist { background: #ede9fe; color: #5b21b6; }
        .role-lab-tech { background: #fef3c7; color: #92400e; }
        .role-admin { background: #fee2e2; color: #991b1b; }
        .role-other { background: #f3f4f6; color: #374151; }
        .license-expiring {
            color: #dc2626;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 10px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Medical Organization Employee Report</h1>
        <p>Generated on {{ now()->format('F d, Y \a\t H:i') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>{{ $employees->count() }}</h3>
            <p>Total Employees</p>
        </div>
        <div class="summary-item">
            <h3>{{ $employees->where('role', 'Doctor')->count() }}</h3>
            <p>Doctors</p>
        </div>
        <div class="summary-item">
            <h3>{{ $employees->where('role', 'Nurse')->count() }}</h3>
            <p>Nurses</p>
        </div>
        <div class="summary-item">
            <h3>{{ $employees->where('license_expiry_date', '<=', now()->addDays(30))->count() }}</h3>
            <p>License Expiring Soon</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Department</th>
                <th>Contact</th>
                <th>License Expiry</th>
                <th>Date Joined</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>
                    <span class="role-badge role-{{ strtolower(str_replace(' ', '-', $employee->role)) }}">
                        {{ $employee->role }}
                    </span>
                </td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->contact_number }}</td>
                <td class="{{ $employee->license_expiry_date <= now()->addDays(30) ? 'license-expiring' : '' }}">
                    {{ $employee->license_expiry_date->format('M d, Y') }}
                </td>
                <td>{{ $employee->date_joined->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>This report contains confidential employee information. Handle with care.</p>
        <p>Medical Organization - Human Resources Department</p>
    </div>
</body>
</html>
