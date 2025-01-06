<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Respon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ResponController extends Controller
{
    public function index() {

        $pengaduan = Pengaduan::whereIn('status', [0,1])->get();
        $notif = notifikasi();

        return view('respon.index', [
            'pengaduan' => $pengaduan,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function balas(Request $request) {

        $validated = $request->validate([
            'pengaduan_id' => 'required',
            'pesan' => 'required',
        ]);

        $id = Crypt::decrypt($request->pengaduan_id);

        $validated['pengaduan_id'] = $id;
        $validated['user_id'] = Auth::user()->id;

        if (Auth::user()->role == 'Admin') {
            $validated['is_read_admin'] = true;
        } else {
            $validated['is_read_user'] = true;
        }
        
        Respon::create($validated);

        return back();
    }
}
