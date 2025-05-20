<?php

namespace Tests\Feature;

use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase; // Pour recréer la base de données à chaque test
use Tests\TestCase;

class ModuleTest extends TestCase {
    use RefreshDatabase; // Réinitialise la base de données SQLite en mémoire

    //Teste si la page principale s'affiche correctement avec des modules.
    public function test_index_page_displays_modules() {
        // Crée un module en usine (factory) pour simuler des données
        $module = Module::factory()->create([
            'name' => 'Capteur Test',
            'type' => 'temperature',
            'is_active' => true,
            'last_seen' => now(),
        ]);

        // Simule une requête GET vers la page d'accueil
        $response = $this->get(route('modules.index'));

        // Vérifie que la réponse est OK (code 200)
        $response->assertStatus(200);

        // Vérifie que le nom du module apparaît dans la page
        $response->assertSee('Capteur Test');
        $response->assertSee('Actif');
    }


    //Teste l'ajout d'un nouveau module via le formulaire.
    public function test_store_module_successfully() {
        // Simule une requête POST avec des données valides
        $response = $this->post(route('modules.store'), [
            'name' => 'Nouveau Capteur',
            'type' => 'vitesse',
        ]);

        // Vérifie que la redirection vers la page principale fonctionne
        $response->assertRedirect(route('modules.index'));

        // Vérifie qu’un message de succès est présent dans la session
        $response->assertSessionHas('success', 'Module ajouté avec succès !');

        // Vérifie que le module a bien été ajouté dans la base de données
        $this->assertDatabaseHas('modules', [
            'name' => 'Nouveau Capteur',
            'type' => 'vitesse',
            'is_active' => true,
        ]);
    }

    /**
     * Teste la validation du formulaire (champs requis).
     */
    public function test_store_module_validation_fails() {
        // Simule une requête POST sans données
        $response = $this->from(route('modules.create'))
            ->post(route('modules.store'), []);

        // Vérifie la redirection vers la page précédente
        $response->assertStatus(302);
        $response->assertRedirect(route('modules.create')); // Ou la route appropriée

        // Vérifie que des erreurs de validation sont présentes dans la session
        $response->assertSessionHasErrors(['name', 'type']);
    }

    
}