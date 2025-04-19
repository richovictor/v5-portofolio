<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoverController extends Controller
{
    public function uploadCover(Request $request)
    {
        $request->validate([
            'cover' => 'required|image|max:2048'
        ]);

        $user = Auth::user();
        $profil = $user->profil;

        // Hapus cover lama jika ada
        if ($profil->cover && file_exists(public_path($profil->cover))) {
            unlink(public_path($profil->cover));
        }

        // Upload cover baru
        $file = $request->file('cover');
        $filename = time() . '_cover.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $profil->cover = 'uploads/' . $filename;
        $profil->save();

        return redirect()->route('laman.siswa')->with('success', 'Foto cover berhasil diperbarui');
    }

    public function hapusCover()
    {
        $user = Auth::user();
        $profil = $user->profil;

        if ($profil->cover && file_exists(public_path($profil->cover))) {
            unlink(public_path($profil->cover));
        }

        $profil->cover = null;
        $profil->save();

        return redirect()->route('laman.siswa')->with('success', 'Foto cover berhasil dihapus');
    }
}

