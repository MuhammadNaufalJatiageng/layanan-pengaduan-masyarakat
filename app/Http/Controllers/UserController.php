<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index() {
        $user = User::all();
        $notif = notifikasi();

        return view('user.index', [
            'user' => $user,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function profile() {
        $notif = notifikasi();

        return view('user.profile', [
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function store(Request $request) {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
            'nik' => 'required|unique:users,nik',
            'email' => 'required|unique:users,email',
            'alamat' => 'required',
            'password' => ['required', Password::min(8)->letters()->numbers()],
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = $request->role;

        $newUser = User::create($validated);
        if ($newUser) {
            return back()->with('success', "Anda berhasil melakukan pendaftaran, silakan login.");
        } else {
            return back()->with('error', "Terjadi kesalahan saat melakukan pendaftaran.");
        }
        
    }

    public function destroy($id) {
        $id = Crypt::decrypt($id);

        User::findOrFail($id)->delete();

        return back()->with('success', "User berhasil dihapus.");
    }
}
