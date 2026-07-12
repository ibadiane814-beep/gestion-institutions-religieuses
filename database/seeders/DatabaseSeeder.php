<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nom' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'telephone' => '701234567',
        ]);

        User::create([
            'nom' => 'Moussa Diallo',
            'email' => 'moussa@example.com',
            'password' => bcrypt('password'),
            'role' => 'responsable',
            'telephone' => '701234568',
        ]);

        $this->call(InstitutionSeeder::class);
    }
}
