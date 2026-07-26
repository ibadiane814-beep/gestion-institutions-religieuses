<?php
namespace App\Http\Controllers;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index(Request $request)
    {
        $query = Institution::query();
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }
        $institutions = $query->paginate(12);
        $types = Institution::distinct()->pluck('type')->filter();
        return view('institutions.index', compact('institutions', 'types'));
    }
}