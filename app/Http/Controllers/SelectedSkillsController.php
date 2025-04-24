<?php

namespace App\Http\Controllers;

use App\Models\SelectedSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SelectedSkillsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SelectedSkills $selectedSkills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SelectedSkills $selectedSkills)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:50',
        ]);

        // Ambil atau buat data SelectedSkills
        $selectedSkills = SelectedSkills::firstOrNew(['user_id' => $user->id]);

        // Jika tidak ada skill yang dipilih (uncheck semua)
        if (empty($validated['skills'])) {
            $selectedSkills->skills = null;
        } else {
            // Simpan skill sebagai string comma-separated
            $selectedSkills->skills = implode(',', $validated['skills']);
        }

        $selectedSkills->save();

        return back()->with('success', 'Kemampuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SelectedSkills $selectedSkills)
    {
        //
    }
}
