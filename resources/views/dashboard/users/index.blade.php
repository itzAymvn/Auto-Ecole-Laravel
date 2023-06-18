@extends('layout.admin')

@section('title', 'Gérer les utilisateurs')

@section('content')
    <main>

        <section class="manage-users-section w-100">

            <x-alerts></x-alerts>

            <!-- Modal (Filtering) -->
            <div class="modal fade" id="filters_modal" tabindex="-1" role="dialog" aria-labelledby="filters_modal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Menu de filtrage des utilisateurs</h5>
                            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="GET" action="{{ route('users.index') }}" id="filters_form">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Rechercher par nom</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Rechercher un utilisateur"
                                            name="search" value="{{ request()->query('search') }}">
                                        <button class="btn btn-primary" id="search-btn" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Filtrer par type</label>
                                    <select class="form-select" name="type">
                                        <option value="" selected>Tous les types</option>
                                        <option value="admin" {{ request()->query('type') == 'admin' ? 'selected' : '' }}>
                                            Administrateur
                                        </option>
                                        <option value="instructor"
                                            {{ request()->query('type') == 'instructor' ? 'selected' : '' }}>
                                            Instructeur
                                        </option>
                                        <option value="student"
                                            {{ request()->query('type') == 'student' ? 'selected' : '' }}>
                                            Étudiant
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="period" class="form-label">Filtrer par période</label>
                                    <select class="form-select" name="period">
                                        <option value="" selected>Toutes les périodes</option>
                                        <option value="today"
                                            {{ request()->query('period') == 'today' ? 'selected' : '' }}>Aujourd'hui
                                        </option>
                                        <option value="week" {{ request()->query('period') == 'week' ? 'selected' : '' }}>
                                            Cette semaine</option>
                                        <option value="month"
                                            {{ request()->query('period') == 'month' ? 'selected' : '' }}>Ce mois-ci
                                        </option>
                                        <option value="year" {{ request()->query('period') == 'year' ? 'selected' : '' }}>
                                            Cette année</option>
                                        <option value="per_month"
                                            {{ request()->query('period') == 'per_month' ? 'selected' : '' }}>Par mois
                                        </option>
                                        <option value="per_year"
                                            {{ request()->query('period') == 'per_year' ? 'selected' : '' }}>Par an
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="month" class="form-label">Filtrer par mois</label>
                                    <select class="form-select" name="month">
                                        <option value="" selected>Tous les mois</option>
                                        <option value="1" {{ request()->query('month') == '1' ? 'selected' : '' }}>
                                            Janvier</option>
                                        <option value="2" {{ request()->query('month') == '2' ? 'selected' : '' }}>
                                            Février</option>
                                        <option value="3" {{ request()->query('month') == '3' ? 'selected' : '' }}>
                                            Mars</option>
                                        <option value="4" {{ request()->query('month') == '4' ? 'selected' : '' }}>
                                            Avril</option>
                                        <option value="5" {{ request()->query('month') == '5' ? 'selected' : '' }}>
                                            Mai</option>
                                        <option value="6" {{ request()->query('month') == '6' ? 'selected' : '' }}>
                                            Juin</option>
                                        <option value="7" {{ request()->query('month') == '7' ? 'selected' : '' }}>
                                            Juillet</option>
                                        <option value="8" {{ request()->query('month') == '8' ? 'selected' : '' }}>
                                            Août</option>
                                        <option value="9" {{ request()->query('month') == '9' ? 'selected' : '' }}>
                                            Septembre</option>
                                        <option value="10" {{ request()->query('month') == '10' ? 'selected' : '' }}>
                                            Octobre</option>
                                        <option value="11" {{ request()->query('month') == '11' ? 'selected' : '' }}>
                                            Novembre</option>
                                        <option value="12" {{ request()->query('month') == '12' ? 'selected' : '' }}>
                                            Décembre</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="year" class="form-label">Filtrer par année</label>
                                    <select class="form-select" name="year">
                                        <option value="" selected>Toutes les années</option>
                                        @for ($i = 2018; $i <= date('Y'); $i++)
                                            <option value="{{ $i }}"
                                                {{ request()->query('year') == $i ? 'selected' : '' }}>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>


                            </form>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="filters_form">
                                <i class="fas fa-filter me-2"></i>
                                <span class="fw-bold">Filtrer</span>
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger">
                                <i class="fas fa-sync me-2"></i>
                                <span class="fw-bold">Réinitialiser</span>
                            </a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times me-2"></i>
                                <span class="fw-bold">Fermer</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="my-3 bg-light p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h5>
                        <i class="fas fa-users me-2"></i>
                        Gérer les utilisateurs ({{ $users->total() }})
                    </h5>
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">

                        <button type="button" class="btn btn-primary d-flex align-items-center shadow-sm"
                            data-toggle="modal" data-target="#filters_modal">
                            <i class="fas fa-filter me-2"></i>
                        </button>
                        <a href="{{ route('users.create') }}"
                            class="btn btn-primary d-flex align-items-center shadow-sm">
                            <i class="fa-solid fa-circle-plus me-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @if (count($users) > 0)
                <div class="table-responsive table-responsive-md">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Nom Complet</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telephone</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Type</th>
                                <th scope="col">Créé à</th>
                                <th scope="col">Modifié à</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    @empty($user->image)
                                        <td><img src="{{ asset('images/default-user.jpg') }}" alt="Image" width="50"
                                                height="50">
                                        </td>
                                    @else
                                        <td><img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Image"
                                                width="50" height="50">
                                        @endempty
                                    <td class="align-middle">
                                        <a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a>
                                    </td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->phone }}</td>
                                    <td class="align-middle">{{ $user->address }}</td>
                                    <td class="align-middle text-capitalize">{{ $user->type }}</td>
                                    <td class="align-middle">{{ $user->created_at }}</td>
                                    <td class="align-middle">{{ $user->updated_at }}</td>
                                    <td class="d-flex justify-content-around align-items-center flex-wrap">
                                        <a href="{{ route('users.show', $user->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @can('edit-users')
                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('delete-users')
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan

                                        @if ($user->type == 'student')
                                            @can('create-payments')
                                                <a href="{{ route('payments.create', ['user_id' => $user->id]) }}">
                                                    <i
                                                        class="fas
                                            fa-money-bill-wave"></i>
                                                </a>
                                            @endcan
                                        @elseif ($user->type == 'instructor' || $user->type == 'admin')
                                            @can('create-spendings')
                                                <a href="{{ route('spendings.create', ['user_id' => $user->id]) }}">
                                                    <i
                                                        class="fas
                                            fa-money-bill-wave"></i>
                                                </a>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $users->appends(request()->input())->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun utilisateur n'a été trouvé
                </div>

                @can('create-users')
                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
                            <i class="fa-solid fa-circle-plus me-2"></i>
                            Ajouter un utilisateur
                        </a>
                    </div>
                @endcan
            @endif
        </section>
    </main>

@endsection
