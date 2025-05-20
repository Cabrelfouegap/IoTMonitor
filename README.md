application de monitoring IoT développée principalement  avec (Laravel 12, Bootstrap, Chart.js, mySQL) permettant la gestion de modules (capteurs) avec génération automatique de données, visualisation via graphiques, et notifications visuelles et textuelles temporaires en cas de dysfonctionnement. Voici les étapes pour l’exécuter, et le tester.

#Fonctionnalités
- Ajout de modules via formulaire.
- Visualisation avec graphiques (Chart.js).
- Notifications visuelles (bordures rouges/vertes).
- Notification textuelle temporaire en cas de       dysfonctionnement (disparaît après 5 secondes).
- Génération aléatoire de données et pannes.

#Prérequis :
PHP (>= 8.2)
Composer (derniere version)
mySQL (installer avec XAMPP de préference)

#Installer les Dépendances
se positionner dans le dossier du projet puis lancer la commande suivante :
composer install

#creer le fichier ".en" à la racine du projet et y coller le contenu du fichier ".env.example"

#générer une clé d'application avec la commande suivante :
php artisan key:generate

#Mettez à jour .env si vos identifiants diffèrent

#Initialiser la Base de Données avec la commande :
php artisan migrate:fresh --seed  (creer la bd si necessaire)


#demarrer le serveur avec la commande :
php artisan serve

#Ajouter des modules dans la vue via le bouton "Ajouter un Module"

#Configurer le Script de Génération Automatique :
commande manuelle : php artisan modules:generate (le faire autant de fois qu'on veux générer des modules)
Automatisez avec le Planificateur de Tâches (Windows) :
-Ouvrez "Planificateur de tâches" (recherchez dans le menu Démarrer).
-cliquer sur "Créez une tâche" :
-rubrique Général :
Nom : "Laravel Scheduler".
Cochez "Exécuter avec les privilèges les plus élevés" (ou "Executer avec les autorisations maximales")
-rublique Déclencheurs :
cliquez sur Nouveau > "Planifié" > "Répéter toutes les 1 minute" > "Indéfinie".
-rubrique Actions :
cliquer sur Nouveau > "Démarrer un programme".
Programme : "C:\php\php.exe" (C:\xampp\php\php.exe si php est installé via XAMPP).
Arguments : "chemin vers le fichier artisan du projet" schedule:run > NUL 2>&1
Démarrer dans : "lien vers le projet"

cliquer sur : "Exécuter"

dans le terminale du projet taper : php artisan test