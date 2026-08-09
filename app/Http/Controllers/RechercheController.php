<?php
namespace App\Http\Controllers;
use App\Models\Institution;
use App\Models\Mariage;
use App\Models\Deces;
use App\Models\Naissance;
use Illuminate\Http\Request;

class RechercheController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $institutions = Institution::where('nom', 'like', "%$q%")->orWhere('adresse', 'like', "%$q%")->get();
        $mariages = Mariage::where('conjoint1_nom', 'like', "%$q%")->orWhere('conjoint1_prenom', 'like', "%$q%")->orWhere('conjoint2_nom', 'like', "%$q%")->orWhere('conjoint2_prenom', 'like', "%$q%")->get();
        $deces = Deces::where('defunt_nom', 'like', "%$q%")->orWhere('defunt_prenom', 'like', "%$q%")->get();
        $naissances = Naissance::where('enfant_nom', 'like', "%$q%")->orWhere('enfant_prenom', 'like', "%$q%")->get();
        return view('recherche.index', compact('q', 'institutions', 'mariages', 'deces', 'naissances'));
    }
}