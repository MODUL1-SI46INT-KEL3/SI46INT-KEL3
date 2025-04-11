<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showPatientLoginForm()
    {
        $nav = 'Patient Login';
        return view('patients.login', compact('nav'));
    }

    public function showAdminLoginForm()
    {
        $nav = 'Admin Login';
        return view('admins.login', compact('nav'));
    }

    public function patientLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if ($patient && Hash::check($request->password, $patient->password)) {
            Auth::login($patient);
            return redirect()->route('patients.index')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && $admin->password === $request->password) {
            Auth::login($admin);
            return redirect()->route('admins.home')->with('success', 'Logged in successfully.');
        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('views.landing')->with('success', 'Logged out successfully.');
    }
}