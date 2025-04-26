<?php

namespace App\Http\Controllers;

use App\Models\activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostImages;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
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
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan aktivitas baru
        $activity = Activities::create([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        // Simpan gambar (jika ada)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('activity_images', 'public');

                PostImages::create([
                    'type' => 'activity',
                    'post_id' => $activity->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(activities $activities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(activities $activities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $activity = activities::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Update aktivitas
        $activity->update($validated);

        // Menyimpan gambar jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $activity->images()->create([
                    'image' => $image->store('activities'),
                ]);
            }
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $activity = activities::findOrFail($id);

        // Menghapus gambar yang terhubung jika ada
        foreach ($activity->images as $image) {
            Storage::delete($image->image);
        }

        // Hapus aktivitas
        $activity->delete();

        return redirect()->back();
    }
}
