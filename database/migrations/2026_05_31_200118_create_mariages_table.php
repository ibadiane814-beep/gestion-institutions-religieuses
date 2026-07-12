<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mariages', function (Blueprint $table) {
            $table->id();
            $table->string('conjoint1_nom');
            $table->string('conjoint1_prenom');
            $table->string('conjoint2_nom');
            $table->string('conjoint2_prenom');
            $table->date('date_mariage');
            $table->string('lieu')->nullable();
            $table->string('officiant')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mariages');
    }
};
