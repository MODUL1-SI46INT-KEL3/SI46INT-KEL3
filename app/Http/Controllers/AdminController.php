<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function home() {
        return view('admins.home');
    }

    public function index()
    {    
        $admins = Admin::all();
        $nav = 'Admin';
    
        return view('admins.index', compact('admins', 'nav'));
    }

    public function showLoginForm()
    {
        $nav = 'Login';
        return view('admins.login', compact('nav'));
    }


    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $admin = Admin::where('username', $request->username)->first();
        return redirect()->route('admins.home')->with('success', 'Logged in successfully.');
    
    }
}
