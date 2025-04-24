<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CVController extends Controller
{
    public function generatePDF()
    {
        $user = Auth::user();
        $profil = $user->profile;
        $skills = $user->selectedSkills;
        $certificates = $user->certificates()->latest()->get();
        $experiences = $user->experiences()->latest()->get();
        $activities = $user->activities()->latest()->get();


        $pdf = Pdf::loadView('cv.template1', compact('user', 'profil', 'skills', 'certificates', 'experiences', 'activities'))
                ->setPaper('A4', 'portrait');

        return $pdf->download('cv-'.$user->name.'.pdf');
    }
}
