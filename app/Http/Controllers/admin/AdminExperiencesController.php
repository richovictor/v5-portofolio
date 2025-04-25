<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\experiences;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminExperiencesController extends Controller
{
    public function index()
    {
        $experiences = experiences::all();
        $user = Auth::user();
        return view('admin.experiences.index', compact('experiences', 'user'));
    }

    public function update(Request $request, $id)
    {
        $experiences = experiences::where('id', $id)->first();
        $validated = $request->validate([
            'position' => 'nullable',
            'description' => 'nullable',
            'agency' => 'nullable',
            'location' => 'nullable',
        ]);

        if ($request->has('position')) {
            $experiences->position = $request->position;
        }
        if($request->has('description')){
            $experiences->description = $request->description;
        }
        if($request->has('agenct')){
            $experiences->agenct = $request->agenct;
        }
        if ($request->has('location')) {
            $experiences->location = $request->location;
        }
        $firstImage = $experiences->images->first();
        if ($firstImage) {
            $firstImage->image = $this->handleUploadImage($request, 'images', $firstImage->image, 'experiences');
            $firstImage->save();
        }


        $experiences->save();
        return redirect()->back();
    }

    private function handleUploadImage($request, $fieldName, $oldFilePath, $uploadDir)
    {
        if ($request->hasFile($fieldName)) {
            // Hapus file lama jika ada
            if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Simpan file ke direktori storage/public/$uploadDir
            $file = $request->file($fieldName);
            $path = $file->store($uploadDir, 'public');

            return $path; // Contoh hasil: activity_images/namafile.png
        }

        return $oldFilePath;
    }
    public function destroy($id)
    {
        $activity = experiences::findOrFail($id);

        // Hapus semua gambar terkait di storage dan database
        foreach ($activity->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $image->delete();
        }

        // Hapus aktivitas itu sendiri
        $activity->delete();

        return redirect()->back()->with('success', 'Experience and related images deleted successfully.');
    }
}
