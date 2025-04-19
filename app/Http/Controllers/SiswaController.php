<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;

class SiswaController extends Controller
{
    public function halamanSiswa()
    {
        $user = Auth::user();
        $profil = $user->profil;

        return view('siswa', compact('profil'));
    }
    
    public function hapusCover()
    {
        $user = Auth::user();
        $profil = $user->profil;

        if ($profil && $profil->cover) {
            $path = public_path($profil->cover);
            if (file_exists($path)) {
                unlink($path);
            }

            $profil->cover = null;
            $profil->save();
        }

        return redirect()->route('laman.siswa')->with('success', 'Cover berhasil dihapus');
    }

    public function profil()
    {
        $user = Auth::user();
        $profil = $user->profil;

        return view('profil', compact('user', 'profil'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $profil = $user->profil ?? new Profil();
        $profil->user_id = $user->id;

        if ($request->hasFile('foto'))
        {
            $file = $request->file('foto');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $profil->foto = 'uploads/' . $filename;
        }

        $profil->username = $request->username;
        $profil->alamat = $request->alamat;
        $profil->no_telp = $request->no_telp;
        $profil->instagram = $request->instagram;
        $profil->twitter = $request->twitter;
        $profil->save();

        return redirect()->route('laman.siswa')->with('success', 'Profil berhasil diperbarui');
    }
    public function hapusFoto()
    {
        $user = Auth::user();
        $profil = $user->profil;

        if ($profil && $profil->foto) {
            // Hapus file dari storage (opsional)
            $path = public_path($profil->foto);
            if (file_exists($path)) {
                unlink($path);
            }

            // Kosongkan kolom foto di database
            $profil->foto = null;
            $profil->save();
        }

        return redirect()->route('laman.siswa')->with('success', 'Foto profil berhasil dihapus');
    }

}