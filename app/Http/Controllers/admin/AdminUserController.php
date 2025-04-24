<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.apps-contacts-list', compact('users', 'roles'));
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
