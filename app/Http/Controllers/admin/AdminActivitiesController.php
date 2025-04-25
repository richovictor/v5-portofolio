<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class AdminActivitiesController extends Controller
{
    public function index()
    {
        $activities = activities::all();
        $user = Auth::user();
        return view('admin.activities.index', compact('activities','user'));
    }

    public function update(Request $request, $id)
    {
        $activities = activities::where('id', $id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'location' => 'nullable',
        ]);

        if ($request->has('title')) {
            $activities->title = $request->title;
        }
        if($request->has('description')){
            $activities->description = $request->description;
        }
        if ($request->has('location')) {
            $activities->location = $request->location;
        }
        $firstImage = $activities->images->first();
        if ($firstImage) {
            $firstImage->image = $this->handleUploadImage($request, 'images', $firstImage->image, 'activity_images');
            $firstImage->save();
        }


        $activities->save();
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
        $activity = Activities::findOrFail($id);

        // Hapus semua gambar terkait di storage dan database
        foreach ($activity->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $image->delete();
        }

        // Hapus aktivitas itu sendiri
        $activity->delete();

        return redirect()->back()->with('success', 'Activity and related images deleted successfully.');
    }   
}
