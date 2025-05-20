<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model {
    use HasFactory;
    protected $fillable = ['name', 'type', 'is_active', 'last_seen']; 

    // Relation avec les données historiques
    public function data() {
        return $this->hasMany(ModuleData::class);
    }
}