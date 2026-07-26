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

        Mariage::create($data);
        return redirect()->route('mariages.create')
            ->with('success', 'Demande de mariage enregistrée avec succès.');
    }
}