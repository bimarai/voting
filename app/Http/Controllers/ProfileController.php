<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        // $profile = Admin::all();
        $name = 'Profile Admin';
        return view('Dashboard.Profile', compact('admin', 'name'));
    }
}