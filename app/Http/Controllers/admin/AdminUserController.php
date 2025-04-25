<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Profil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.apps-contacts-list', compact('users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $profil = $user->profile;

        if (!$profil){
            $profil = new Profil();
            $profil->user_id = $user->id;
        }

        $validated = $request->validate([
            'name' => 'nullable',
            'username' => 'nullable',
            'phone_number' => 'nullable|string|max:15',
            'instagram' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'link_instagram' => 'nullable|url|max:255',
            'link_twitter' => 'nullable|url|max:255',
            'link_facebook' => 'nullable|url|max:255',
            'password' => 'nullable',
        ]);
        if ($request->verified_status) {
            $user->email_verified_at = now(); // Verified
        } else {
            $user->email_verified_at = null; // Unverified
        }
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        if($request->has('name')){
            $user->name = $request->name;
        }
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
        $user->save();
        return redirect()->back();
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto jika ada
        if (!empty($user->profile) && !empty($user->profile->profile_image)) {
            $imagePath = public_path($user->profile->profile_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus profil jika ada
        if ($user->profile) {
            $user->profile->delete();
        }

        // Hapus user
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
