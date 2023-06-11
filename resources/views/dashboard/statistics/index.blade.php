@extends('layout.admin')

@section('title', 'Statistiques')

@section('content')
    <div class="-fluid my-xl-4 my-lg-4 my-md-3 my-sm-2 my-1">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title">Utilisateurs créés au fil du temps</h3>
                <div class="card-tools">
                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-users"></i>
                        Gérer les utilisateurs
                    </a>
                </div>
            </div>
            <div class="card-body">
                <canvas id="usersChart"></canvas>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const usersData = @json($users);
        const months = usersData.map(user => user.month);
        const counts = usersData.map(user => user.count);

        const ctx = document.getElementById('usersChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: months,
                datasets: [{
                    label: 'Nombre d\'utilisateurs',
                    data: counts,
                    fill: false,
                    borderColor: '#007BFF',
                    borderWidth: 2
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: true
                        }
                    },
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Utilisateurs créés au fil du temps'
                    },
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endpush
