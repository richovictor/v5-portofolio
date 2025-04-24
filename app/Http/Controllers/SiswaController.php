<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use Illuminate\Support\Facades\Storage;
use App\Models\Certificates;
use App\Models\Experiences;
use App\Models\Activities;
use App\Models\User;
class SiswaController extends Controller
{



    public function index()
    {
        $user = Auth::user();
        $profil = $user->profile;
        $selectedSkills = $user->selectedSkills;

        // Ambil sertifikat, pengalaman, aktivitas berdasarkan user dan urutan terbaru
        $certificates = Certificates::where('user_id', $user->id)->latest()->get();
        $experiences = Experiences::where('user_id', $user->id)->latest()->get();
        $activities = Activities::where('user_id', $user->id)->latest()->get();

        return view('siswa', compact(
            'user',
            'profil',
            'selectedSkills',
            'certificates',
            'experiences',
            'activities'
        ));
    }

    public function view($id)
    {
        $user = User::where('id', $id)->first();
        $profil = $user->profile;
        $selectedSkills = $user->selectedSkills;

        // Ambil sertifikat, pengalaman, aktivitas berdasarkan user dan urutan terbaru
        $certificates = Certificates::where('user_id', $user->id)->latest()->get();
        $experiences = Experiences::where('user_id', $user->id)->latest()->get();
        $activities = Activities::where('user_id', $user->id)->latest()->get();

        return view('view-siswa', compact(
            'user',
            'profil',
            'selectedSkills',
            'certificates',
            'experiences',
            'activities'
        ));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $experiences)
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('profile', compact('user', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($experiences)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek jika profil sudah ada atau belum
        $profil = $user->profile;

        // Jika profil belum ada, buat profil baru
        if (!$profil) {
            $profil = new Profil();
            $profil->user_id = $user->id;
        }

        // Validasi data yang diinput
        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'link_instagram' => 'nullable|url|max:255',
            'link_twitter' => 'nullable|url|max:255',
            'link_facebook' => 'nullable|url|max:255',
        ]);

        // Isi data profil dengan request jika ada
        if ($request->has('username')) {
            $profil->username = $request->username;
        }

        if ($request->has('phone_number')) {
            $profil->phone_number = $request->phone_number;
        }

        if ($request->has('instagram')) {
            $profil->instagram = $request->instagram;
        }

        if ($request->has('twitter')) {
            $profil->twitter = $request->twitter;
        }

        if ($request->has('facebook')) {
            $profil->facebook = $request->facebook;
        }

        if ($request->has('link_instagram')) {
            $profil->link_instagram = $request->link_instagram;
        }

        if ($request->has('link_twitter')) {
            $profil->link_twitter = $request->link_twitter;
        }

        if ($request->has('link_facebook')) {
            $profil->link_facebook = $request->link_facebook;
        }

        $profil->profile_image = $this->handleUploadImage($request, 'profile_image', $profil->profile_image, 'uploads/foto_profil');
        $profil->cover_image = $this->handleUploadImage($request, 'cover_image', $profil->cover_image, 'uploads/cover_profil');



        // Simpan profil yang sudah diupdate
        $profil->save();

        // Kembalikan response sukses
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
    private function handleUploadImage($request, $fieldName, $oldFilePath, $uploadDir)
    {
        if ($request->hasFile($fieldName)) {
            if ($oldFilePath && file_exists(public_path($oldFilePath))) {
                unlink(public_path($oldFilePath));
            }

            $file = $request->file($fieldName);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($uploadDir), $filename);

            return $uploadDir . '/' . $filename;
        }

        return $oldFilePath;
    }


    public function deletePhoto()
    {
        $user = Auth::user();
        $profil = $user->profil;

        if ($profil && $profil->foto && Storage::exists($profil->foto)) {
            Storage::delete($profil->foto);
            $profil->foto = null;
            $profil->save();
        }

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($experiences)
    {
        //
    }
}
