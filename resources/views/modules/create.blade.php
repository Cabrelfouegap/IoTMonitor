<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Ajouter un Nouveau Module</h1>

        <!-- Affiche un message d’erreur s’il existe (doublon ou autre) -->
        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        <!-- Affiche les erreurs de validation (champs vides, etc.) -->
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('modules.store') }}" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom du Module</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type de Mesure</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="temperature" {{ old('type') == 'temperature' ? 'selected' : '' }}>Température</option>
                    <option value="vitesse" {{ old('type') == 'vitesse' ? 'selected' : '' }}>Vitesse</option>
                    <option value="pression" {{ old('type') == 'pression' ? 'selected' : '' }}>Pression</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le Module</button>
            <a href="{{ route('modules.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>