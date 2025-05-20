📡 Application de Monitoring IoT – Laravel 12
Cette application de monitoring IoT a été développée avec Laravel 12, Bootstrap, Chart.js et MySQL.
Elle permet la gestion de modules (capteurs) avec :

Génération automatique de données (y compris des pannes simulées),

Visualisation graphique des données (via Chart.js),

Notifications visuelles et textuelles temporaires en cas de dysfonctionnement.

🚀 Fonctionnalités
➕ Ajout de modules via formulaire

📊 Visualisation en temps réel avec Chart.js

🟥🟩 Notifications visuelles (bordures rouges en cas de panne, vertes sinon)

📢 Notification textuelle temporaire (disparaît automatiquement après 5 secondes)

🔄 Génération aléatoire de données et de pannes (manuelle ou planifiée)

🔧 Prérequis
PHP ≥ 8.2

Composer (dernière version)

MySQL (idéalement installé via XAMPP)

⚙️ Installation et Configuration
1. Installer les dépendances
Dans le terminal, placez-vous à la racine du projet :    composer install

2. Configuration de l’environnement
Copier le fichier .env.example en .env :    cp .env.example .env


Générer la clé de l'application :    php artisan key:generate

Adapter le fichier .env avec vos identifiants MySQL (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

3. Initialiser la base de données :    php artisan migrate:fresh --seed

💡 Créez votre base de données au préalable si elle n'existe pas.


4. Lancer le serveur Laravel : php artisan serve

L'application sera accessible par défaut à l’adresse http://localhost:8000

🧪 Tester et utiliser l’application
Utilisez le bouton "Ajouter un Module" dans l'interface pour insérer de nouveaux capteurs.

Les données sont générées automatiquement ou via une commande artisan.

Les modules défaillants s'affichent avec une bordure rouge et une alerte textuelle temporaire.

⚙️ Génération automatique des données
#Méthode manuelle
À lancer à tout moment :    php artisan modules:generate

#Méthode automatique (Planificateur de tâches – Windows)
Ouvrir le Planificateur de tâches (depuis le menu Démarrer)

Cliquer sur "Créer une tâche"

Configuration :

Général :
Nom : Laravel Scheduler

Cocher "Exécuter avec les privilèges les plus élevés"

Déclencheurs :
Cliquer sur "Nouveau" > Type : Planifié

Répéter toutes les 1 minute indéfiniment

Actions :
Cliquer sur "Nouveau"

Programme : C:\php\php.exe (ou C:\xampp\php\php.exe selon votre installation)

Arguments : artisan schedule:run > NUL 2>&1

Démarrer dans : chemin vers votre projet

Cliquer sur "OK" puis sur "Exécuter"

✅ Lancer les tests
Dans le terminal, exécuter :    php artisan test

📌 Notes
Le système simule des capteurs et pannes pour test uniquement.
