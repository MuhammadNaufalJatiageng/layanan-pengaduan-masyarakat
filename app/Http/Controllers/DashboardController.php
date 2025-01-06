<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Respon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $pengaduan = Pengaduan::latest()->get();
        $kategori = Kategori::all();
        $notif = notifikasi();
        // return json_encode($notif);exit;
        return view('dashboard.index', [
            'pengaduan' => $pengaduan,
            'kategori' => $kategori,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function search(Request $request) {

        if ($request->has('keyword')) {
            $pengaduan = Pengaduan::where('judul', 'like', "%{$request->keyword}%")->latest()->get();
        }
        if ($request->has('filter')) {
            $pengaduan = Pengaduan::where('kategori_id', $request->filter)->latest()->get();
        }

        $kategori = Kategori::all();
        $notif = notifikasi();

        return view('dashboard.index', [
            'pengaduan' => $pengaduan,
            'kategori' => $kategori,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function show($id){
        $id = Crypt::decrypt($id);

        $pengaduan = Pengaduan::findOrFail($id);
        $respons = Respon::where('pengaduan_id', $id)->get();

        if ($pengaduan->user_id == Auth::user()->id) {
            foreach ($respons as $respon) {
                $respon->update(['is_read_user' => true]);
            }
        }
        
        if (Auth::user()->role == 'Admin') {
            foreach ($respons as $respon) {
                $respon->update(['is_read_admin' => true]);
            }
        }

        $notif = notifikasi();
        
        return view('dashboard.show', [
            'pengaduan' => $pengaduan,
            'respons' => $respons,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }
}
