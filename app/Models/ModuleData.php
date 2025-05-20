<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleData extends Model {
    protected $fillable = ['module_id', 'value', 'status', 'recorded_at']; // Champs modifiables

    public $timestamps = false; // Désactiver les timestamps

    protected $casts = [
        'recorded_at' => 'datetime', // Convertit recorded_at en Carbon
    ];

    // Relation inverse avec le module
    public function module() {
        return $this->belongsTo(Module::class);
    }
}