<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\Models\ModuleData;
use Illuminate\Console\Command;

class GenerateModuleData extends Command
{
    /**
     * Nom et signature de la commande Artisan.
     *
     * @var string
     */
    protected $signature = 'modules:generate';

    /**
     * Description de la commande.
     *
     * @var string
     */
    protected $description = 'Génère automatiquement des états et données pour les modules IoT';

    /**
     * Exécute la commande.
     *
     * @return void
     */
    public function handle()
    {
        // Récupère tous les modules de la table "modules"
        $modules = Module::all();

        // Vérifie s’il y a des modules dans la base
        if ($modules->isEmpty()) {
            $this->info('Aucun module trouvé dans la base de données.');
            return;
        }

        // Parcourt chaque module pour générer ses données
        foreach ($modules as $module) {
            // Simule une panne aléatoire (10% de chance)
            $fails = rand(0, 100) < 10;
            $value = $fails ? null : $this->generateValue($module->type);

            // Crée une nouvelle entrée dans "module_data" pour l’historique
            ModuleData::create([
                'module_id' => $module->id,
                'value' => $value, // Null si en panne
                'status' => !$fails, // False si en panne, true sinon
                'recorded_at' => now(), // Timestamp actuel
            ]);

            // Met à jour l’état du module dans "modules"
            $module->update([
                'is_active' => !$fails,
                'last_seen' => now(),
            ]);
        }

        $this->info('Données générées avec succès pour ' . $modules->count() . ' modules.');
    }

    /**
     * Génère une valeur numérique aléatoire selon le type du module.
     *
     * @param string $type Type du module (temperature, vitesse, pression)
     * @return float
     */
    private function generateValue($type)
    {
        switch ($type) {
            case 'temperature':
                return rand(-20, 50); // Température entre -20°C et 50°C
            case 'vitesse':
                return rand(0, 120); // Vitesse entre 0 et 120 km/h
            case 'pression':
                return rand(900, 1100); // Pression entre 900 et 1100 hPa
            default:
                return rand(0, 100); // Valeur générique
        }
    }
}