<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if (
            Auth::attempt(['email' => $credentials['login'], 'password' => $credentials['password']]) ||
            Auth::attempt(['phone' => $credentials['login'], 'password' => $credentials['password']])
        ) {

            $user = Auth::user(); // Get authenticated user

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'customer') {
                return redirect()->route('home');
            }
        }

        return redirect()->back()->with('error', 'Wrong credentials');
    }

    public function registerAction(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'between:3,255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
            'policy' => ['required'],
        ]);

        $user = User::create($fields);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}
