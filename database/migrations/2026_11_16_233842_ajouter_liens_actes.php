<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $tables = ['mariages', 'deces', 'naissances'];

    public function up(): void
    {
        foreach ($this->tables as $nom) {
            Schema::table($nom, function (Blueprint $table) use ($nom) {
                if (!Schema::hasColumn($nom, 'institution_id')) {
                    $table->foreignId('institution_id')->nullable()->constrained('institutions')->nullOnDelete();
                }
                if (!Schema::hasColumn($nom, 'enregistre_par')) {
                    $table->foreignId('enregistre_par')->nullable()->constrained('utilisateurs')->nullOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $nom) {
            Schema::table($nom, function (Blueprint $table) use ($nom) {
                if (Schema::hasColumn($nom, 'institution_id')) {
                    $table->dropConstrainedForeignId('institution_id');
                }
                if (Schema::hasColumn($nom, 'enregistre_par')) {
                    $table->dropConstrainedForeignId('enregistre_par');
                }
            });
        }
    }
};