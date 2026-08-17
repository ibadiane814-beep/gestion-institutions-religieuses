<?php
namespace App\Http\Controllers;
use App\Models\Mariage;
use App\Models\Deces;
use App\Models\Naissance;
use App\Models\Institution;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalMariages = Mariage::count();
        $totalDeces = Deces::count();
        $totalNaissances = Naissance::count();
        $institutions = Institution::orderBy('nom')->get();

        return view('user.dashboard', compact(
            'totalMariages',
            'totalDeces',
            'totalNaissances',
            'institutions'
        ));
    }
}