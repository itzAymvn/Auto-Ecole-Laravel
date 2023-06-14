@extends('layout.admin')

@section('title', 'Gérer les dépenses')

@section('content')
    <main class="d-flex justify-content-between flex-row">

        <section class="manage-users-section w-100">

            <x-alerts></x-alerts>

            <!-- Modal (Filtering) -->
            <div class="modal fade" id="filters_modal" tabindex="-1" role="dialog" aria-labelledby="filters_modal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-filter me-2"></i>
                                <span class="fw-bold">Filtrer les dépenses</span>
                            </h5>
                            <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('spendings.index') }}" method="GET" id="filters_form">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type de paiement:</label>
                                    <select class="form-select" name="type" id="type">
                                        <option value="">Tous</option>
                                        <option value="salary">Salaire</option>
                                        <option value="other">Autre</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="user_name" class="form-label">Nom d'utilisateur:</label>
                                    <input type="text" class="form-control" name="user_name" id="user_name">
                                </div>

                                <div class="mb-3">
                                    <label for="sort_by_date" class="form-label">Trier par date:</label>
                                    <select class="form-select" name="sort_by_date" id="sort_by_date">
                                        <option value="desc">Décroissant</option>
                                        <option value="asc">Croissant</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="date" class="form-label">Date:</label>
                                    <input type="date" class="form-control" name="date" id="date">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times me-2"></i>
                                <span class="fw-bold">Fermer</span>
                            </button>
                            <button type="submit" class="btn btn-primary" form="filters_form">
                                <i class="fas fa-filter me-2"></i>
                                <span class="fw-bold">Filtrer</span>
                            </button>
                            <a href="{{ route('spendings.index') }}" class="btn btn-danger">
                                <i class="fas fa-sync me-2"></i>
                                <span class="fw-bold">Réinitialiser</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-3 bg-light p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h5>
                        <i class="fas fa-money-check-alt me-2"></i>
                        Liste des dépenses
                    </h5>
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                        <button type="button" class="btn btn-primary d-flex align-items-center shadow-sm"
                            data-toggle="modal" data-target="#filters_modal" title="Filter">
                            <i class="fas fa-filter me-2"></i>
                        </button>
                        @if (request()->has('user_id'))
                            <a href="{{ route('spendings.create', ['user_id' => request()->user_id]) }}"
                                class="btn btn-primary d-flex align-items-center shadow-sm" title="Ajouter une dépense">
                                <i class="fa-solid fa-circle-plus me-2"></i>
                            </a>
                        @else
                            <a href="{{ route('spendings.create') }}"
                                class="btn btn-primary d-flex align-items-center shadow-sm" title="Ajouter une dépense">
                                <i class="fa-solid fa-circle-plus me-2"></i>
                            </a>
                        @endif
                    </div>

                </div>
            </div>
            @if ($spendings->count() > 0)
                <div class="table-responsive table-responsive-md">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="col">ID</th>
                                <th class="col">Type</th>
                                <th class="col">Utilisateur</th>
                                <th class="col">Montant</th>
                                <th class="col">Description</th>
                                <th class="col">Date de création</th>
                                <th class="col">Date de mise à jour</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spendings as $spending)
                                <tr>
                                    <td>{{ $spending->id }}</td>
                                    <td>{{ $spending->type }}</td>
                                    @if (isset($spending->user))
                                        <td>
                                            <a href="{{ route('users.show', $spending->user->id) }}">
                                                {{ $spending->user->name }}
                                            </a>
                                        </td>
                                    @else
                                        <td>-</td>
                                    @endif
                                    <td>{{ $spending->amount }}</td>
                                    <td>{{ $spending->description }}</td>
                                    <td>{{ $spending->created_at }}</td>
                                    <td>{{ $spending->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun dépense n'a été trouvé.
                </div>
            @endif
        </section>
    </main>

@endsection
