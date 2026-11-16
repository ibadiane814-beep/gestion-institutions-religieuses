<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('naissances', function (Blueprint $table) {
            $table->string('pere_prenom')->nullable()->after('date_naissance');
            $table->string('mere_prenom')->nullable()->after('pere_prenom');
        });

        DB::statement('UPDATE naissances SET pere_prenom = pere_nom');

        Schema::table('naissances', function (Blueprint $table) {
            $table->dropColumn('pere_nom');
        });
    }

    public function down(): void
    {
        Schema::table('naissances', function (Blueprint $table) {
            $table->string('pere_nom')->nullable()->after('date_naissance');
        });

        DB::statement('UPDATE naissances SET pere_nom = pere_prenom');

        Schema::table('naissances', function (Blueprint $table) {
            $table->dropColumn(['pere_prenom', 'mere_prenom']);
        });
    }
};