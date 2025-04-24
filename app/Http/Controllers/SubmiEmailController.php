<?php

namespace App\Http\Controllers;

use App\Models\submiEmail;
use Illuminate\Http\Request;

class SubmiEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function submit(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255', // <- disesuaikan dari 15 ke 255
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        SubmiEmail::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda telah dikirim!');
    }

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
    public function show(submiEmail $submiEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(submiEmail $submiEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, submiEmail $submiEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(submiEmail $submiEmail)
    {
        //
    }
}
