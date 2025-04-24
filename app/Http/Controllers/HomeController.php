<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::inRandomOrder()->take(6)->get();

        return view('dashboard', compact('users'));
    }

    public function seeall(Request $request)
    {
        $query = User::with(['profile', 'selectedSkills']);

        if ($request->has('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function ($q2) use ($search) {
                      $q2->where('username', 'like', "%{$search}%");
                  })
                  ->orWhereHas('selectedSkills', function ($q3) use ($search) {
                      $q3->where('skills', 'like', "%{$search}%");
                  });
            });
        }

        $users = $query->get(); // bisa juga paginate(6) kalau mau
        return view('allsiswa', compact('users'));
    }

}
