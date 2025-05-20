<?php

namespace Tests\Unit;

use App\Console\Commands\GenerateModuleData;
use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class GenerateModuleDataTest extends TestCase
{
    use RefreshDatabase;

    public function test_generate_module_data_command()
    {
        // Crée un module avec la factory
        Module::factory()->create([
            'name' => 'Capteur Temp',
            'type' => 'temperature',
            'is_active' => true,
        ]);

        Artisan::call('modules:generate');

        $this->assertDatabaseCount('module_data', 1);
        $data = \App\Models\ModuleData::first();
        $this->assertNotNull($data);
        if ($data->value !== null) {
            $this->assertTrue($data->value >= -20 && $data->value <= 50);
        }
    }

    public function test_generate_data_for_multiple_modules()
    {
        // Crée 3 modules
        Module::factory()->count(3)->create(['type' => 'vitesse']);

        Artisan::call('modules:generate');

        $this->assertDatabaseCount('module_data', 3);
    }
}