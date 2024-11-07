<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:admin_users',
            'password' => 'required|min:6|confirmed',
        ]);

        AdminUser::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin-users.index')
            ->with('success', 'Admin user created successfully');
    }

    public function edit(AdminUser $adminUser)
    {
        return view('admin.users.edit', compact('adminUser'));
    }

    public function update(Request $request, AdminUser $adminUser)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:admin_users,email,' . $adminUser->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = ['email' => $validated['email']];
        if ($validated['password']) {
            $data['password'] = Hash::make($validated['password']);
        }

        $adminUser->update($data);

        return redirect()->route('admin-users.index')
            ->with('success', 'Admin user updated successfully');
    }

    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();
        return redirect()->route('admin-users.index');
    }
} 