<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use App\Models\Institution;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\Notification;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    public function dashboard()
    {
        $institution = Institution::where('responsable_id', auth()->id())->first();

        $stats = [
            'institution' => $institution,
            'mariages' => Mariage::count(),
            'deces' => Deces::count(),
            'naissances' => Naissance::count(),
            'notifications_non_lues' => Notification::where('lu', false)->count(),
        ];

        $derniers_mariages = Mariage::latest()->take(5)->get();
        $derniers_deces = Deces::latest()->take(5)->get();
        $dernieres_naissances = Naissance::latest()->take(5)->get();

        return view('responsable.dashboard', compact(
            'stats',
            'derniers_mariages',
            'derniers_deces',
            'dernieres_naissances'
        ));
    }
}
