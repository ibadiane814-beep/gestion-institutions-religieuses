<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DecesController extends Controller
{
    public function index(Request $request)
    {
        $query = Deces::orderBy('date_deces', 'desc');
        if ($request->filled('mois')) {
            $query->whereMonth('date_deces', $request->mois);
        }
        if ($request->filled('annee')) {
            $query->whereYear('date_deces', $request->annee);
        }
        $deces = $query->paginate(10);
        return view('admin.deces.index', compact('deces'));
    }

    public function create()
    {
        return view('deces.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'defunt_nom'    => 'required|string|max:255',
            'defunt_prenom' => 'required|string|max:255',
            'date_deces'    => 'required|date|before_or_equal:today',
            'lieu'          => 'nullable|string|max:255',
            'cause'         => 'nullable|string',
        ], [
            'date_deces.before_or_equal' => 'La date du décès ne peut pas être dans le futur.',
        ]);

        $dece = Deces::create($data);

        \App\Models\Notification::create([
            'titre'   => 'Nouveau décès enregistré',
            'message' => $dece->defunt_prenom . ' ' . $dece->defunt_nom . ' — ' . \Carbon\Carbon::parse($dece->date_deces)->format('d/m/Y'),
            'type'    => 'deces',
            'lu'      => false,
        ]);

        if ($request->filled('email_confirmation')) {
            try {
                \Illuminate\Support\Facades\Mail::to($request->email_confirmation)
                    ->send(new \App\Mail\DecesNotification($dece));
            } catch (\Throwable $e) {
                // Email non bloquant
            }
        }

        return redirect()->route('deces.create')
            ->with('success', 'Déclaration de décès enregistrée avec succès.');
    }

    public function destroy(Deces $dece)
    {
        $dece->delete();
        return back()->with('success', 'Décès supprimé avec succès.');
    }

    public function fichePdf(Deces $dece)
    {
        $pdf = Pdf::loadView('pdf.fiche-deces', compact('dece'));
        return $pdf->download('deces-' . $dece->id . '.pdf');
    }

    public function exportPdf()
    {
        $deces = Deces::orderBy('date_deces', 'desc')->get();
        $pdf = Pdf::loadView('pdf.deces', compact('deces'));
        return $pdf->download('deces-' . date('Y-m-d') . '.pdf');
    }
}