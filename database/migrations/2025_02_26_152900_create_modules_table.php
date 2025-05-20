<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration {
    public function up() {
        Schema::create('modules', function (Blueprint $table) {
            $table->id(); // Clé primaire du module auto-incrémentée
            $table->string('name'); // Nom du module
            $table->string('type'); // Type de mesure
            $table->boolean('is_active')->default(true); // État actuel
            $table->timestamp('last_seen')->nullable(); // Dernière activité
            $table->timestamps(); // date de creation et de modification
        });
    }

    public function down() {
        Schema::dropIfExists('modules');
    }
}