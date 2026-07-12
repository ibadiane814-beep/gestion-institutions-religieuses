<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    public function run(): void
    {
        $institutions = [
            [
                'nom' => 'Grande Mosquée de Dakar',
                'type' => 'Mosquée',
                'adresse' => 'Allée Pape Gueye Fall, Dakar-Médina',
                'telephone' => '338215151',
                'description' => 'Principale mosquée de Dakar, construite en 1964 avec un minaret de 67m. Style architectural maroco-andalou.',
                'latitude' => 14.67778,
                'longitude' => -17.44222,
            ],
            [
                'nom' => 'Mosquée Massalikoul Djinane',
                'type' => 'Mosquée',
                'adresse' => 'Grand Dakar, Dakar',
                'telephone' => '338259090',
                'description' => 'Plus grande mosquée d\'Afrique de l\'Ouest, inaugurée en 2019. Capacité de 30 000 fidèles, 5 minarets de 80m.',
                'latitude' => 14.70111,
                'longitude' => -17.44861,
            ],
            [
                'nom' => 'Mosquée de l\'Indépendance',
                'type' => 'Mosquée',
                'adresse' => 'Place de l\'Indépendance, Dakar-Plateau',
                'telephone' => '338231212',
                'description' => 'Mosquée historique située sur la place de l\'Indépendance, en plein cœur du plateau administratif.',
                'latitude' => 14.6700,
                'longitude' => -17.4320,
            ],
            [
                'nom' => 'Mosquée Omarienne',
                'type' => 'Mosquée',
                'adresse' => 'Point E, Dakar',
                'telephone' => '338653535',
                'description' => 'Mosquée du quartier Point E, proche de l\'Université Cheikh Anta Diop. Centre spirituel important.',
                'latitude' => 14.6860,
                'longitude' => -17.4590,
            ],
            [
                'nom' => 'Mosquée de Sicap Liberté',
                'type' => 'Mosquée',
                'adresse' => 'Sicap Liberté, Dakar',
                'telephone' => '338254545',
                'description' => 'Mosquée du grand quartier résidentiel de Sicap Liberté, desservant une communauté nombreuse.',
                'latitude' => 14.6970,
                'longitude' => -17.4560,
            ],
            [
                'nom' => 'Grande Mosquée de Pikine',
                'type' => 'Mosquée',
                'adresse' => 'Pikine, Dakar',
                'telephone' => '338348484',
                'description' => 'Mosquée principale de la banlieue de Pikine, l\'une des plus fréquentées de la région dakaroise.',
                'latitude' => 14.7490,
                'longitude' => -17.3970,
            ],
            [
                'nom' => 'Cathédrale Notre-Dame des Victoires',
                'type' => 'Église',
                'adresse' => 'Boulevard de la République, Dakar-Plateau',
                'telephone' => '338214364',
                'email' => 'cathedrale.dakar@archidiocesedakar.sn',
                'description' => 'Cathédrale catholique la plus grande de Dakar, siège de l\'Archidiocèse. Construite entre 1923-1929, style néo-soudanais.',
                'latitude' => 14.6653,
                'longitude' => -17.4378,
            ],
            [
                'nom' => 'Église Saint-Charles de la Médina',
                'type' => 'Église',
                'adresse' => 'SICAP, Dakar',
                'telephone' => '338212828',
                'description' => 'Paroisse catholique dynamique du quartier SICAP, centre spirituel et communautaire important.',
                'latitude' => 14.6750,
                'longitude' => -17.4450,
            ],
            [
                'nom' => 'Église Saint-Pierre',
                'type' => 'Église',
                'adresse' => 'Rue de Thiong, Dakar-Plateau',
                'telephone' => '338232323',
                'description' => 'Église historique du Plateau, connue pour son architecture et sa communauté active.',
                'latitude' => 14.6710,
                'longitude' => -17.4470,
            ],
            [
                'nom' => 'Église Notre-Dame de la Paix',
                'type' => 'Église',
                'adresse' => 'Almadies, Dakar',
                'telephone' => '338207070',
                'description' => 'Paroisse catholique située dans le quartier des Almadies, la pointe ouest de Dakar.',
                'latitude' => 14.7420,
                'longitude' => -17.5030,
            ],
        ];

        foreach ($institutions as $inst) {
            Institution::create($inst);
        }
    }
}
