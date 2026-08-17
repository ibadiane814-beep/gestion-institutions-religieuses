<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('institution')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $institutions = Institution::orderBy('nom')->get();
        return view('admin.users.create', compact('institutions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'            => 'required|string|max:255',
            'email'          => 'required|email|unique:utilisateurs,email',
            'password'       => 'required|min:6|confirmed',
            'role'           => 'required|in:admin,responsable,citoyen',
            'institution_id' => 'nullable|exists:institutions,id',
            'telephone'      => 'nullable|string|max:20',
        ]);

        $data['password'] = Hash::make($data['password']);
        if ($data['role'] !== 'responsable') {
            $data['institution_id'] = null;
        }

        User::create($data);
        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        $institutions = Institution::orderBy('nom')->get();
        return view('admin.users.edit', compact('user', 'institutions'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nom'            => 'required|string|max:255',
            'email'          => 'required|email|unique:utilisateurs,email,' . $user->id,
            'role'           => 'required|in:admin,responsable,citoyen',
            'institution_id' => 'nullable|exists:institutions,id',
            'telephone'      => 'nullable|string|max:20',
        ]);

        if ($data['role'] !== 'responsable') {
            $data['institution_id'] = null;
        }

        $user->update($data);
        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé.');
    }
}