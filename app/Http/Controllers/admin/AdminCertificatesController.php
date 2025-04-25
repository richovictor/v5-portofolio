<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\certificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminCertificatesController extends Controller
{
    public function index()
    {
        $certificates = certificates::all();
        $user = Auth::user();
        return view('admin.certificates.index', compact('certificates', 'user'));
    }

    public function update(Request $request, $id)
    {
        $certificates = certificates::where('id', $id)->first();
        $validated = $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
            'agency' => 'nullable',
            'location' => 'nullable',
        ]);

        if ($request->has('title')) {
            $certificates->title = $request->title;
        }
        if($request->has('description')){
            $certificates->description = $request->description;
        }
        if($request->has('agenct')){
            $certificates->agenct = $request->agenct;
        }
        if ($request->has('location')) {
            $certificates->location = $request->location;
        }
        $firstImage = $certificates->images->first();
        if ($firstImage) {
            $firstImage->image = $this->handleUploadImage($request, 'images', $firstImage->image, 'certificates');
            $firstImage->save();
        }


        $certificates->save();
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
        $activity = certificates::findOrFail($id);

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
