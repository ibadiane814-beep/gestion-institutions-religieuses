<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deces;
use App\Models\Institution;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\Notification;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'utilisateurs' => User::count(),
            'institutions' => Institution::count(),
            'mariages' => Mariage::count(),
            'deces' => Deces::count(),
            'naissances' => Naissance::count(),
            'notifications_non_lues' => Notification::where('lu', false)->count(),
        ];

        $derniers_mariages = Mariage::latest()->take(5)->get();
        $derniers_deces = Deces::latest()->take(5)->get();
        $dernieres_naissances = Naissance::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'derniers_mariages',
            'derniers_deces',
            'dernieres_naissances'
        ));
    }
}
