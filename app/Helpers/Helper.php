<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

if (! function_exists('notifikasi')) {
    function notifikasi() {
        if (Auth::user()->role == 'Admin') {
            $notif = DB::table('pengaduans')
            ->leftJoin('respons', 'pengaduans.id', '=', 'respons.pengaduan_id')
            ->select(
                'pengaduans.id', 
                'pengaduans.user_id', 
                'pengaduans.judul as peng_judul', 
                'respons.judul', 
                DB::raw('COUNT(*) as total'),
                DB::raw('CASE WHEN respons.judul IS NULL THEN "0" ELSE "1" END AS judul_status')
            )
            ->where('is_read_admin', 0)
            ->groupBy('pengaduans.id','pengaduans.user_id', 'pengaduans.judul', 'respons.judul', 'judul_status')
            ->get();
        } else {
            $notif = DB::table('pengaduans')
            ->leftJoin('respons', 'pengaduans.id', '=', 'respons.pengaduan_id')
            ->select(
                'pengaduans.id', 
                'pengaduans.user_id', 
                'pengaduans.judul as peng_judul', 
                'respons.judul', 
                DB::raw('COUNT(*) as total'),
                DB::raw('CASE WHEN respons.judul IS NULL THEN "0" ELSE "1" END AS judul_status')
            )
            ->where('pengaduans.user_id', Auth::user()->id)
            ->where('is_read_user', 0)
            ->groupBy('pengaduans.id','pengaduans.user_id', 'pengaduans.judul', 'respons.judul', 'judul_status')
            ->get();
        }

        return $notif;
    }
}