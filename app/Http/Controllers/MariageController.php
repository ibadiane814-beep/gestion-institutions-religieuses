<?php
namespace App\Http\Controllers;
use App\Models\Mariage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MariageController extends Controller
{
    public function index(Request $request)
    {
        $query = Mariage::orderBy('date_mariage', 'desc');
        if ($request->filled('mois')) {
            $query->whereMonth('date_mariage', $request->mois);
        }
        if ($request->filled('annee')) {
            $query->whereYear('date_mariage', $request->annee);
        }
        $mariages = $query->paginate(10);
        return view('admin.mariages.index', compact('mariages'));
    }

    public function create()
    {
        return view('mariages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'conjoint1_nom'    => 'required|string|max:255',
            'conjoint1_prenom' => 'required|string|max:255',
            'conjoint2_nom'    => 'required|string|max:255',
            'conjoint2_prenom' => 'required|string|max:255',
            'date_mariage'     => 'required|date|before_or_equal:today',
            'lieu'             => 'nullable|string|max:255',
            'officiant'        => 'nullable|string|max:255',
        ], [
            'date_mariage.before_or_equal' => 'La date du mariage ne peut pas être dans le futur.',
        ]);

        $mariage = Mariage::create($data);

        // Notification automatique
        \App\Models\Notification::create([
            'titre'   => 'Nouveau mariage enregistré',
            'message' => $mariage->conjoint1_prenom . ' ' . $mariage->conjoint1_nom . ' & ' . $mariage->conjoint2_prenom . ' ' . $mariage->conjoint2_nom . ' — ' .\Carbon\Carbon::parse($mariage->date_mariage)->format('d/m/Y'),
            'type'    => 'mariage',
            'lu'      => false,
        ]);

        // Email optionnel
        if ($request->filled('email_confirmation')) {
            try {
                \Illuminate\Support\Facades\Mail::to($request->email_confirmation)
                    ->send(new \App\Mail\MariageConfirmation($mariage));
            } catch (\Exception $e) {
                // Email non bloquant
            }
        }

        return redirect()->route('mariages.create')
            ->with('success', 'Demande de mariage enregistrée avec succès.');
    }

    public function destroy(Mariage $mariage)
    {
        $mariage->delete();
        return back()->with('success', 'Mariage supprimé avec succès.');
    }

    public function fichePdf(Mariage $mariage)
    {
        $pdf = Pdf::loadView('pdf.fiche-mariage', compact('mariage'));
        return $pdf->download('mariage-' . $mariage->id . '.pdf');
    }

    public function exportPdf()
    {
        $mariages = Mariage::orderBy('date_mariage', 'desc')->get();
        $pdf = Pdf::loadView('pdf.mariages', compact('mariages'));
        return $pdf->download('mariages-' . date('Y-m-d') . '.pdf');
    }
}