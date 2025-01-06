<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthenticationController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nik' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended(route('dashboard'));
        }
 
        return back()->withErrors([
            'auth_fail' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('nik');
    }

    public function register(Request $request) {
        
        $validated = $request->validate([
            'name' => 'required',
            'nik' => 'required|unique:users,nik',
            'email' => 'required|unique:users,email',
            'alamat' => 'required',
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'User';

        $newUser = User::create($validated);
        
        return back()->with('success', "Anda berhasil melakukan pendaftaran, silakan login.");

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to the desired location after logout
    }
}
