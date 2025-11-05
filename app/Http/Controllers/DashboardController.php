<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\bioData;
use App\Models\Employee;
use App\Models\Resident;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        $user = auth()->user();

        // Get user's bio data status
        $bioData = $user->bioData;

        // Get selected resident type from session if no bio data exists
        $selectedResidentType = session('selected_resident_type');

        // Calculate progress
        $progress = 0;
        if ($bioData) {
            $progress = 75; // Bio data submitted
            if ($bioData->certificate_files) {
                $progress = 100; // Documents uploaded
            }
        } else {
            $progress = 25; // Account created
        }

        return view('user.dashboard', compact('user', 'bioData', 'progress', 'selectedResidentType'));
    }

    public function adminDashboard()
    {
        // Admin statistics
        $stats = [
            'total_users' => User::count(),
            'total_bio_data' => bioData::count(),
            'total_employees' => Employee::count(),
            'total_residents' => Resident::count(),
            'active_users' => User::where('status', 'Active')->count(),
            'pending_verifications' => bioData::where('status', 'pending')->count(),
            'approved_applications' => bioData::where('status', 'approved')->count(),
            'rejected_applications' => bioData::where('status', 'rejected')->count(),
        ];

        // Recent applications (bio data submissions)
        $recent_applications = bioData::with('user')->latest()->take(10)->get();

        // Pending applications for quick review
        $pending_applications = bioData::with('user')->where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_applications', 'pending_applications'));
    }
}
