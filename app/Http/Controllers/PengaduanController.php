<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Notifikasi;
use App\Models\Pengaduan;
use App\Models\Respon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PengaduanController extends Controller
{
    public function index() {

        $pengaduan = Pengaduan::where('user_id', Auth::user()->id)->latest()->get();
        $kategori = Kategori::all();
        $notif = notifikasi();

        return view('pengaduan.index', [
            'pengaduan' => $pengaduan,
            'kategori' => $kategori,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function create() {

        $kategori = Kategori::all();
        $notif = notifikasi();

        return view('pengaduan.create', [
            'kategori' => $kategori,
            'notif' => $notif->sortByDesc('created_at'),
        ]);
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'judul' => 'required|max:20|min:3',
            'kategori_id' => 'required',
            'isi_laporan' => 'required|min:10',
            'lampiran' => 'mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = Auth::user()->id;

        if ($request->file('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            $validated['lampiran'] = $lampiranPath;
        }
        
        $pengaduan = Pengaduan::create($validated);
        $id = Crypt::encrypt($pengaduan->id);
        
        if ($pengaduan) {
            $notif['pengaduan_id'] = $pengaduan->id;
            $notif['user_id'] = Auth::user()->id;
            $notif['is_read_user'] = true;
            $notif['judul'] = 'Laporan baru!';
            Respon::create($notif);

            return redirect()->route('pengaduan')->with('success', 'Pengaduan berhasil dibuat.')->with('id', $id);
        } else {
            return redirect()->route('pengaduan')->with('error', 'Terjadi kesalahan saat membuat pengaduan.');
        }
    }

    public function update($id) {

        $id = Crypt::decrypt($id);
        $query =  Pengaduan::findOrFail($id[0]);

        if ($id[1] == 'update') {
            $query->update(['status' => '1']);
            $this->pesan($id[0], "Pengaduan anda kami proses");

        }
        if ($id[1] == 'selesai') {
            $query->update(['status' => '2']);
            $this->pesan($id[0], "Pengaduan anda sudah selesai");
        }

        return back()->with('success', "Status pengaduan berhasil diperbarui.");
    }

    public function destroy($id) {
        $id = Crypt::decrypt($id);

        Pengaduan::findOrFail($id)->delete();

        return back()->with('success', "Pengaduan berhasil dihapus.");
    }

    public function pesan($id, $pesan) {
        $notifikasi = new Respon;
        $notifikasi->user_id = Auth::user()->id;
        $notifikasi->pengaduan_id = $id;
        $notifikasi->judul = $pesan;
        $notifikasi->is_read_admin = true;
        $notifikasi->save();
    }
}
