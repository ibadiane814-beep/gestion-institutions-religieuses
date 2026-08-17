<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionAdminController extends Controller
{
    public function index()
    {
        $institutions = Institution::withCount('users')->paginate(15);
        return view('admin.institutions.index', compact('institutions'));
    }

    public function create()
    {
        return view('admin.institutions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'         => 'required|string|max:255',
            'type'        => 'nullable|string|max:100',
            'adresse'     => 'nullable|string',
            'telephone'   => 'nullable|string|max:20',
            'email'       => 'nullable|email',
            'description' => 'nullable|string',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
        ]);

        Institution::create($data);
        return redirect()->route('admin.institutions.admin.index')
            ->with('success', 'Institution créée avec succès.');
    }

    public function edit(Institution $institution)
    {
        return view('admin.institutions.edit', compact('institution'));
    }

    public function update(Request $request, Institution $institution)
    {
        $data = $request->validate([
            'nom'         => 'required|string|max:255',
            'type'        => 'nullable|string|max:100',
            'adresse'     => 'nullable|string',
            'telephone'   => 'nullable|string|max:20',
            'email'       => 'nullable|email',
            'description' => 'nullable|string',
            'latitude'    => 'nullable|numeric',
            'longitude'   => 'nullable|numeric',
        ]);

        $institution->update($data);
        return redirect()->route('admin.institutions.admin.index')
            ->with('success', 'Institution mise à jour avec succès.');
    }

    public function destroy(Institution $institution)
    {
        $institution->delete();
        return back()->with('success', 'Institution supprimée.');
    }
}