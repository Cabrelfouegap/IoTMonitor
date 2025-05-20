<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word . ' Capteur',
            'type' => $this->faker->randomElement(['temperature', 'vitesse', 'pression']),
            'is_active' => true,
            'last_seen' => now(),
        ];
    }
}