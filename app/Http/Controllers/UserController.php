<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pages.users.view');
    }

    public function store(Request $request)
    {
        // Validation logic here

        // Create user
        User::create($request->all());

        // Redirect to index or show success message
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        // dd($roles);
        return view('admin.pages.users.view', compact('user', 'roles'));
    }
    public function update(Request $request, User $user)
    {
        // Validation logic here

        // Update user details
        $user->update($request->only(['name', 'email', 'role']));

        // Sync roles
        // $user->syncRole($request->input('roles'));

        // Redirect to index or show success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        // Delete user
        $user->delete();

        // Redirect to index or show success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    protected function syncRole()
    {

    }
}
