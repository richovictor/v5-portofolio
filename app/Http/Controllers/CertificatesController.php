<?php

namespace App\Http\Controllers;

use App\Models\certificates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostImages;
use Illuminate\Support\Facades\Storage;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'       => 'required|string|max:255',
            'agency'      => 'required|string|max:255',
            'location'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Simpan data sertifikat
        // dd($request);
        $certificate = Certificates::create([
            'title'       => $request->title,
            'agency'      => $request->agency,
            'location'    => $request->location,
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        // Upload dan simpan semua gambar
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('certificates', 'public');

                PostImages::create([
                    'type'     => 'certificate',
                    'post_id'  => $certificate->id,
                    'image'    => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(certificates $certificates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(certificates $certificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $certificate = certificates::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'agency' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update sertifikat
        $certificate->update($validated);

        // Menyimpan gambar jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $certificate->images()->create([
                    'image' => $image->store('certificates'),
                ]);
            }
        }

        return redirect()->back();;
    }

    public function destroy($id)
    {
        $certificate = certificates::findOrFail($id);

        // Menghapus gambar yang terhubung jika ada
        foreach ($certificate->images as $image) {
            Storage::delete($image->image);
        }

        // Hapus sertifikat
        $certificate->delete();

        return redirect()->back()->with('success', 'Sertifikat berhasil dihapus');
    }
}
