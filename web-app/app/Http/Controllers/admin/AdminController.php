<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.Home.admin', compact('admins'));
    }

    public function showAddAdminForm()
    {
        if (auth()->user()->email !== 'madushankaeranda56@gmail.com') {
            return redirect()->route('admin.index')->with('error', 'Only the superadmin can add admins.');
        }
        return view('admin.Home.add_admin');
    }

    public function store(Request $request)
    {
        if (auth()->user()->email !== 'madushankaeranda56@gmail.com') {
            return redirect()->route('admin.index')->with('error', 'Only the superadmin can add admins.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin added successfully!');
    }

    public function delete($id)
    {
        if (auth()->user()->email !== 'madushankaeranda56@gmail.com') {
            return redirect()->route('admin.index')->with('error', 'Only the superadmin can delete admins.');
        }

        $admin = Admin::findOrFail($id);
        $admin->status = 0;
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Admin marked as deleted successfully!');
    }
}