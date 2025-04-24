<?php

namespace App\Http\Controllers;

use App\Models\experiences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostImages;

class ExperiencesController extends Controller
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
            'position'     => 'required|string|max:255',
            'agency'       => 'required|string|max:255',
            'location'     => 'nullable|string|max:255',
            'start_date'   => 'required|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'description'  => 'nullable|string',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan pengalaman kerja
        $experience = Experiences::create([
            'position'    => $request->position,
            'agency'      => $request->agency,
            'location'    => $request->location,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'description' => $request->description,
            'user_id'     => Auth::id(),
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('experiences', 'public');

                PostImages::create([
                    'type'    => 'experience',
                    'post_id' => $experience->id,
                    'image'   => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Pengalaman kerja berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(experiences $experiences)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(experiences $experiences)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, experiences $experiences)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(experiences $experiences)
    {
        //
    }
}
