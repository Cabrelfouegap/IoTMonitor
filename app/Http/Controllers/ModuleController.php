<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller {
    // Affiche la page principale avec tous les modules
    public function index(Request $request) {
        $modules = Module::with('data')->get(); // Charge les modules et leurs données
        
        // Vérifie si un module est en panne
        $failedModules = $modules->filter(function ($module) {
            return !$module->is_active;
        });

        if ($failedModules->isNotEmpty()) {
            $message = $failedModules->count() > 1
                ? "Attention : " . $failedModules->count() . " modules sont en panne !"
                : "Attention : Le module '" . $failedModules->first()->name . "' est en panne !";
            $request->session()->flash('failure', $message);
        }
        
        return view('modules.index', compact('modules'));
    }

    // Affiche le formulaire pour ajouter un module
    public function create() {
        return view('modules.create');
    }

    // Enregistrement d'un nouveau module
    public function store(Request $request) {
        // Valide les données entrantes
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:temperature,vitesse,pression'
        ]);

        // Vérifie si un module avec le même nom et type existe déjà
        $existingModule = Module::where('name', $request->name)
            ->where('type', $request->type)
            ->first();

        if ($existingModule) {
            // Si un module existe, renvoie une notification d’erreur et revient au formulaire
            return redirect()->route('modules.create')
                ->withInput() // Conserve les données saisies
                ->with('error', 'Un module avec ce nom et ce type existe déjà dans la base de données !');
        }

        // Si aucun doublon, crée le nouveau module
        Module::create([
            'name' => $request->name,
            'type' => $request->type,
            'is_active' => true,
            'last_seen' => now(),
        ]);

        // Redirige vers la page principale avec un message de succès
        return redirect()->route('modules.index')
            ->with('success', 'Module ajouté avec succès !');
    }
}