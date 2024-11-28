<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.add-admin');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 1, // Admin role
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin created successfully');
    }

    public function index()
    {
        $admins = User::where('role_id', 1)->get();
        return view('admin.dashboard', compact('admins'));
    }
}
