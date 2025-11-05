<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bioData;

class ResidentTypeController extends Controller
{
    public function show()
    {
        return view('auth.resident-type');
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_type' => 'required|in:NON-RESIDENT,RESIDENT',
        ]);

        // Store resident type in session temporarily
        session(['selected_resident_type' => $request->resident_type]);

        return redirect()->route('dashboard');
    }
}
