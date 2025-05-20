<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleDataTable extends Migration {
    public function up() {
        Schema::create('module_data', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->foreignId('module_id')->constrained()->onDelete('cascade'); // Lien vers la table modules
            $table->float('value')->nullable(); // Valeur mesurée (ex: 25.5 pour température)
            $table->boolean('status')->default(true); // Statut de la mesure (réussie ou en panne)
            $table->timestamp('recorded_at'); // Date et heure de la mesure
        });
    }

    public function down() {
        Schema::dropIfExists('module_data');
    }
}