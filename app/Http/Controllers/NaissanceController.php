<?php

namespace App\Http\Controllers;

use App\Models\Naissance;
use Illuminate\Http\Request;

class NaissanceController extends Controller
{
    public function create()
    {
        return view('naissances.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'enfant_nom' => 'required|string|max:255',
            'enfant_prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'pere_nom' => 'nullable|string|max:255',
            'mere_nom' => 'nullable|string|max:255',
            'lieu' => 'nullable|string|max:255',
        ]);

        Naissance::create($data);

        return redirect()->route('naissances.create')
            ->with('success', 'Enregistrement de naissance effectué avec succès.');
    }
}
