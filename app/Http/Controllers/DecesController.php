<?php
namespace App\Http\Controllers;
use App\Models\Deces;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DecesController extends Controller
{
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

    public function create()
    {
        return view('deces.create');
    }

    public function destroy(Deces $dece)
    {
        $dece->delete();
        return back()->with('success', 'Décès supprimé avec succès.');
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

        Deces::create($data);
                if ($request->filled('email_confirmation')) {
            try {
                \Illuminate\Support\Facades\Mail::to($request->email_confirmation)
                    ->send(new \App\Mail\DecesNotification($dece));
            } catch (\Exception $e) {}
        }
        return redirect()->route('deces.create')
            ->with('success', 'Déclaration de décès enregistrée avec succès.');
    }
}