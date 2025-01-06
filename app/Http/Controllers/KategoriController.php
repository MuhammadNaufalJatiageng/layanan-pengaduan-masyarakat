<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KategoriController extends Controller
{
    
    public function store(Request $request) {

        // dd($request->all());
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        Kategori::create($validated);

        return redirect()->route('pengaduan')->with('success', "Kategori berhasil ditambahkan.");
    }

    public function destroy($id) {
        $id = Crypt::decrypt($id);

        Kategori::findOrFail($id)->delete();

        return back()->with('success', "Kategori berhasil dihapus.");
    }
}
