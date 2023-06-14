@extends('layout.admin')

@section('title', 'Statistiques')

@section('content')

    <div class="container-fluid my-4">
        <!-- Filters -->
        <div class="bg-light p-3 rounded">

            <h4 class="mb-4">
                <i class="fa-solid fa-filter"></i>
                Filtres
            </h4>
            <form action="{{ route('statistics.index') }}">
                <div class="row">
                    <div class="col-md-6">
                        <label for="monthFilter" class="form-label">
                            <i class="fa-solid fa-calendar"></i>
                            Selectionner le mois:
                        </label>
                        <select id="monthFilter" class="form-select" name="month">
                            <option value="all">All</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == request()->month ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                            @endfor

                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="yearFilter" class="form-label">
                            <i class="fa-solid fa-calendar"></i>
                            Selectionner l'année:
                        </label>
                        <select id="yearFilter" class="form-select" name="year">
                            <option value="all">All</option>
                            @for ($i = 2018; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == request()->year ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="submit" class="btn btn-primary rounded">
                            <i class="fa-solid fa-search"></i>
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid my-4">
        <div class="row gap-4 gap-md-0">
            <div class="col-md-6">
                <a href="{{ route('payments.index') }}">
                    <div class="bg-primary p-4 text-white rounded">
                        <h3 class="mb-3">
                            <i class="fa-solid fa-money-bill"></i>
                            Paiements
                        </h3>
                        <h2 class="counter" data-end="{{ $payments->sum('sum') }}">
                        </h2>
                        <span class="text-dark">MAD</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('spendings.index', ['type' => 'other']) }}">
                    <div class="bg-danger p-4 text-white rounded">
                        <h3 class="mb-3">
                            <i class="fa-solid fa-money-bill"></i>
                            Dépenses
                        </h3>
                        <h2 class="counter" data-end="{{ $charges->sum('sum') }}"></h2>
                        <span class="text-dark">MAD</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid my-4">
        <div class="row gap-4 gap-md-0">
            <div class="col-md-6">
                <a href="{{ route('spendings.index', ['type' => 'salary']) }}">
                    <div class="bg-success p-4 text-white rounded">
                        <h3 class="mb-3">
                            <i class="fa-solid fa-money-bill"></i>
                            Salaires
                        </h3>
                        <h2 class="counter" data-end="{{ $salary->sum('sum') }}"></h2>
                        <span class="text-dark">MAD</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <div class="bg-info p-4 text-white rounded">
                    <h3 class="mb-3">
                        <i class="fa-solid fa-money-bill"></i>
                        Bénéfices
                    </h3>
                    <h2 class="counter {{ $earnings > 0 ? 'text-dark' : 'text-danger' }}" data-end="{{ $earnings }}">
                    </h2>
                    <span class="text-dark font-bold">MAD</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-4">
        <div class="bg-light p-4 rounded">
            <h4 class="mb-4">
                <i class="fa-solid fa-users"></i>
                Utilisateurs créés au fil du temps
            </h4>
            <div class="row">
                <div class="col">
                    <canvas id="usersChart"></canvas>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // The function that animates the numbers
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                const formattedValue = new Intl.NumberFormat('en-US').format(value);
                element.textContent = formattedValue;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animating the numbers of (payments, charges, salary, earnings)
        const counters = document.querySelectorAll('.counter');
        counters.forEach((counter) => {
            const endValue = parseInt(counter.getAttribute('data-end'));
            animateValue(counter, 0, endValue, 1000);
        });

        // Users chart
        const usersData = @json($users);
        const months = usersData.map(user => user.month);
        const counts = usersData.map(user => user.count);
        const usersCount = usersData.reduce((acc, user) => acc + user.count, 0);
        const ctx = document.getElementById('usersChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
            data: {
                labels: months,
                datasets: [{
                    label: 'Nombre d\'utilisateurs',
                    data: counts,
                    fill: true,
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
                        text: usersCount > 0 ? usersCount > 1 ? `${usersCount} utilisateurs créés au fil du temps` :
                            `${usersCount} utilisateur créé au fil du temps` : 'Aucun utilisateur créé'
                    },
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endpush
