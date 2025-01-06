<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index() {
        $pengaduan = Pengaduan::all();
        $diterima = Pengaduan::where('status', '0')->count();
        $diproses = Pengaduan::where('status', '1')->count();
        $selesai = Pengaduan::where('status', '2')->count();
        $notif = notifikasi();

        $data = [$diterima, $diproses, $selesai];
        
        return view('laporan.index', [
            'pengaduan' => $pengaduan,
            'data' => $data,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }
}
