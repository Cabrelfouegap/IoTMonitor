<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Monitoring IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Monitoring des Modules IoT</h1>
        <a href="{{ route('modules.create') }}" class="btn btn-primary mb-3">Ajouter un Module</a>

        <!-- Notification de succès -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Notification de dysfonctionnement temporaire -->
        @if(session('failure'))
            <div id="failure-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('failure') }}
            </div>
        @endif

        <div class="row">
            @foreach($modules as $module)
                <div class="col-md-4 mb-3">
                    <div class="card {{ !$module->is_active ? 'border-danger' : 'border-success' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $module->name }} ({{ ucfirst($module->type) }})</h5>
                            <p>Dernière valeur : {{ $module->data->last()?->value ?? 'N/A' }}</p>
                            <p>Statut : {{ $module->is_active ? 'Actif' : 'En panne' }}</p>
                            <p>Durée : {{ $module->created_at->diffForHumans() }}</p>
                            <p>Données : {{ $module->data->count() }}</p>
                            <canvas id="chart-{{ $module->id }}" height="150"></canvas>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // Disparition automatique de l'alerte de dysfonctionnement après 5 secondes
        @if(session('failure'))
            setTimeout(function() {
                let alert = document.getElementById('failure-alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 150); // Supprime après la transition
                }
            }, 5000); // 5 secondes
        @endif

        @foreach($modules as $module)
            new Chart(document.getElementById('chart-{{ $module->id }}'), {
                type: 'line',
                data: {
                    labels: [
                        @foreach($module->data->take(-10) as $data)
                            '{{ $data->recorded_at->format('H:i:s') }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: '{{ ucfirst($module->type) }}',
                        data: [
                            @foreach($module->data->take(-10) as $data)
                                {{ $data->value ?? 'null' }},
                            @endforeach
                        ],
                        borderColor: '{{ $module->is_active ? '#00ff00' : '#ff0000' }}',
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        @endforeach

        //rechargement de la page toutes les 10 secondes
        // setTimeout(function() {
        //     location.reload();
        // }, 10000);
    </script>
</body>
</html>