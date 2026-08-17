<?php
namespace App\Http\Controllers;
use App\Models\Mariage;
use App\Models\Deces;
use App\Models\Naissance;

class ResponsableController extends Controller
{
    public function dashboard()
    {
        $totalMariages = Mariage::count();
        $totalDeces = Deces::count();
        $totalNaissances = Naissance::count();
        $derniersMariages = Mariage::latest()->take(5)->get();
        $dernieresNaissances = Naissance::latest()->take(5)->get();

        return view('responsable.dashboard', compact(
            'totalMariages',
            'totalDeces',
            'totalNaissances',
            'derniersMariages',
            'dernieresNaissances'
        ));
    }
}