<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['usertype', 'nationality'])->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $usertypes = UserType::all();
        $nationalities = Nationality::all();
        return view('admin.users.create', compact('usertypes', 'nationalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:Active,Inactive,Deactivated',
            'usertype_id' => 'nullable|exists:usertypes,id',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'id_type' => 'nullable|in:Passport,ID,Birth Certificate',
            'id_number' => 'nullable|string|max:255|unique:users',
            'gender' => 'nullable|in:Male,Female,Other',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'usertype_id' => $request->usertype_id,
            'nationality_id' => $request->nationality_id,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function show(User $user)
    {
        $user->load(['usertype', 'nationality']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $usertypes = UserType::all();
        $nationalities = Nationality::all();
        return view('admin.users.edit', compact('user', 'usertypes', 'nationalities'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:20|unique:users,phone_number,' . $user->id,
            'status' => 'required|in:Active,Inactive,Deactivated',
            'usertype_id' => 'nullable|exists:usertypes,id',
            'nationality_id' => 'nullable|exists:nationalities,id',
            'id_type' => 'nullable|in:Passport,ID,Birth Certificate',
            'id_number' => 'nullable|string|max:255|unique:users,id_number,' . $user->id,
            'gender' => 'nullable|in:Male,Female,Other',
        ]);

        $user->update($request->only([
            'first_name', 'last_name', 'email', 'phone_number', 'status',
            'usertype_id', 'nationality_id', 'id_type', 'id_number', 'gender'
        ]));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
