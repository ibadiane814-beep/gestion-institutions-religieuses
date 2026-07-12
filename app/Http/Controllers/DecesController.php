<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use Illuminate\Http\Request;

class DecesController extends Controller
{
    public function create()
    {
        return view('deces.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'defunt_nom' => 'required|string|max:255',
            'defunt_prenom' => 'required|string|max:255',
            'date_deces' => 'required|date',
            'lieu' => 'nullable|string|max:255',
            'cause' => 'nullable|string',
        ]);

        Deces::create($data);

        return redirect()->route('deces.create')
            ->with('success', 'Déclaration de décès enregistrée avec succès.');
    }
}
