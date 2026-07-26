<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Deces;
use App\Models\Institution;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'utilisateurs' => User::count(),
            'institutions' => Institution::count(),
            'mariages' => Mariage::count(),
            'deces' => Deces::count(),
            'naissances' => Naissance::count(),
            'notifications_non_lues' => Notification::where('lu', false)->count(),
        ];

        $derniers_mariages = Mariage::latest()->take(5)->get();
        $derniers_deces = Deces::latest()->take(5)->get();
        $dernieres_naissances = Naissance::latest()->take(5)->get();

        // Stats mensuelles pour les graphiques
        $annee = date('Y');
        $stats_mensuelles = [
            'mariages'   => $this->statsParMois(Mariage::class, 'date_mariage', $annee),
            'deces'      => $this->statsParMois(Deces::class, 'date_deces', $annee),
            'naissances' => $this->statsParMois(Naissance::class, 'date_naissance', $annee),
        ];

        return view('admin.dashboard', compact(
            'stats',
            'derniers_mariages',
            'derniers_deces',
            'dernieres_naissances',
            'stats_mensuelles'
        ));
    }

    private function statsParMois($model, $colonne, $annee)
    {
        $data = array_fill(0, 12, 0);
        $results = $model::selectRaw('MONTH(' . $colonne . ') as mois, COUNT(*) as total')
            ->whereYear($colonne, $annee)
            ->groupBy('mois')
            ->get();
        foreach ($results as $r) {
            $data[$r->mois - 1] = $r->total;
        }
        return $data;
    }
}