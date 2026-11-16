<?php

namespace App\Http\Controllers;

use App\Models\Naissance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NaissanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Naissance::orderBy('date_naissance', 'desc');
        if ($request->filled('mois')) {
            $query->whereMonth('date_naissance', $request->mois);
        }
        if ($request->filled('annee')) {
            $query->whereYear('date_naissance', $request->annee);
        }
        $naissances = $query->paginate(10);
        return view('admin.naissances.index', compact('naissances'));
    }

    public function create()
    {
        return view('naissances.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'enfant_nom'     => 'required|string|max:255',
            'enfant_prenom'  => 'required|string|max:255',
            'date_naissance' => 'required|date|before_or_equal:today',
            'pere_nom'       => 'nullable|string|max:255',
            'mere_nom'       => 'nullable|string|max:255',
            'lieu'           => 'nullable|string|max:255',
        ], [
            'date_naissance.before_or_equal' => 'La date de naissance ne peut pas être dans le futur.',
        ]);

        $naissance = Naissance::create($data);

        \App\Models\Notification::create([
            'titre'   => 'Nouvelle naissance enregistrée',
            'message' => $naissance->enfant_prenom . ' ' . $naissance->enfant_nom . ' — ' . \Carbon\Carbon::parse($naissance->date_naissance)->format('d/m/Y'),
            'type'    => 'naissance',
            'lu'      => false,
        ]);

        if ($request->filled('email_confirmation')) {
            try {
                \Illuminate\Support\Facades\Mail::to($request->email_confirmation)
                    ->send(new \App\Mail\NaissanceConfirmation($naissance));
            } catch (\Throwable $e) {
                // Email non bloquant
            }
        }

        return redirect()->route('naissances.create')
            ->with('success', 'Enregistrement de naissance effectué avec succès.');
    }

    public function destroy(Naissance $naissance)
    {
        $naissance->delete();
        return back()->with('success', 'Naissance supprimée avec succès.');
    }

    public function fichePdf(Naissance $naissance)
    {
        $pdf = Pdf::loadView('pdf.fiche-naissance', compact('naissance'));
        return $pdf->download('naissance-' . $naissance->id . '.pdf');
    }

    public function exportPdf()
    {
        $naissances = Naissance::orderBy('date_naissance', 'desc')->get();
        $pdf = Pdf::loadView('pdf.naissances', compact('naissances'));
        return $pdf->download('naissances-' . date('Y-m-d') . '.pdf');
    }
}