<?php

namespace App\Http\Controllers;

use App\Models\Mariage;
use Illuminate\Http\Request;

class MariageController extends Controller
{
    public function create()
    {
        return view('mariages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'conjoint1_nom' => 'required|string|max:255',
            'conjoint1_prenom' => 'required|string|max:255',
            'conjoint2_nom' => 'required|string|max:255',
            'conjoint2_prenom' => 'required|string|max:255',
            'date_mariage' => 'required|date',
            'lieu' => 'nullable|string|max:255',
            'officiant' => 'nullable|string|max:255',
        ]);

        Mariage::create($data);

        return redirect()->route('mariages.create')
            ->with('success', 'Demande de mariage enregistrée avec succès.');
    }
}
