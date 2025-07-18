<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Corriger les valeurs d'état existantes
        DB::table('products')->where('etat', 'TRES BON')->update(['etat' => 'tres_bon']);
        DB::table('products')->where('etat', 'BON')->update(['etat' => 'bon']);
        DB::table('products')->where('etat', 'CORRECT')->update(['etat' => 'correct']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revenir aux anciennes valeurs si nécessaire
        DB::table('products')->where('etat', 'tres_bon')->update(['etat' => 'TRES BON']);
        DB::table('products')->where('etat', 'bon')->update(['etat' => 'BON']);
        DB::table('products')->where('etat', 'correct')->update(['etat' => 'CORRECT']);
    }
};
