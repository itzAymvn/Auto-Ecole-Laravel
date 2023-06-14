@extends('layout.admin')

@section('title', 'Page d\'utilisateur')

@section('content')

    <div class="mb-5">
        
        <x-alerts></x-alerts>

        <div class="row">
            <div class="col-md-12">
                <h5
                    class="text-center my-3 bg-light p-3 rounded-3 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <span>
                        <i class="fas fa-user"></i>
                        Vous visualisez l'utilisateur:
                        <span class="text-primary">{{ $user->name }}</span>
                    </span>

                    <a href="{{ route('users.index') }}" class="btn btn-primary float-end">
                        <i class="fas fa-arrow-left"></i>
                        Retour
                    </a>
                </h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-id-card"></i>
                                    ID:
                                </strong>
                            </td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <div class="d-flex justify-content-start align-items-center my-3">
                            <div>
                                @empty($user->image)
                                    <img src="{{ asset('images/default-user.jpg') }}" alt="{{ $user->name }}" height="80"
                                        class="rounded-circle">
                                @else
                                    <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="{{ $user->name }}"
                                        height="80" class="rounded-circle">
                                @endempty
                            </div>
                            <div class="ms-3">
                                <h5 class="text-capitalize">{{ $user->name }}</h5>
                                <p class="text-capitalize">
                                    @if ($user->type == 'admin')
                                        <span class="badge bg-danger">Administrateur</span>
                                    @elseif($user->type == 'student')
                                        <span class="badge bg-primary">Étudiant</span>
                                    @elseif($user->type == 'instructor')
                                        <span class="badge bg-success">Instructeur</span>
                                    @endif
                                </p>
                            </div>

                        </div>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-envelope"></i>
                                    Addresse email:
                                </strong>
                            </td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-phone"></i>
                                    Téléphone:
                                </strong>
                            </td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Adresse:
                                </strong>
                            </td>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-calendar-alt"></i>
                                    Date de naissance:
                                </strong>
                            </td>
                            <td>{{ $user->birthdate }}</td>
                        </tr>
                    </tbody>
                </table>

                @can('edit-users')
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Modifier l'utilisateur
                    </a>
                @endcan

                @can('delete-users')
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Supprimer l'utilisateur
                        </button>
                    </form>
                @endcan
                @if ($user->type == 'student')
                    @can('create-payments')
                        <a href="{{ route('payments.create', ['user_id' => $user->id]) }}" class="btn btn-success">
                            <i class="fas fa-money-bill"></i>
                            Ajouter un paiement
                        </a>
                    @endcan
                @elseif ($user->type == 'instructor' || $user->type == 'admin')
                    @can('create-spendings')
                        <a href="{{ route('spendings.create', ['user_id' => $user->id]) }}" class="btn btn-warning">
                            <i class="fas fa-money-bill"></i>
                            Ajouter une dépense
                        </a>
                    @endcan
                @endif
            </div>
            {{-- More data section --}}

            @if ($user->type != 'admin')
                <section class="py-5">
                    <div class="d-flex justify-content-between mb-3">
                        <h5>
                            <i class="fas fa-info-circle"></i>
                            <span>
                                Voir plus d'informations
                            </span>
                        </h5>
                    </div>
                    <div id="moredata">
                        <ul class="list-group">
                            @can('view-exams')
                                <li class="list-group-item">
                                    <a href="{{ route('exams.index', ['user_id' => $user->id]) }}"
                                        class="d-flex align-items-center">
                                        <i class="fa-solid fa-car"></i>
                                        <span class="ms-2">
                                            Les examens
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @if ($user->type == 'student')
                                @can('view-payments')
                                    <li class="list-group-item">
                                        <a href="{{ route('payments.index', ['user_id' => $user->id]) }}"
                                            class="d-flex align-items-center">
                                            <i class="fa-solid fa-money-bill"></i>
                                            <span class="ms-2">
                                                Les paiements
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            @elseif($user->type == 'instructor')
                                @can('view-spendings')
                                    <li class="list-group-item">
                                        <a href="{{ route('spendings.index', ['user_id' => $user->id]) }}"
                                            class="d-flex align-items-center">
                                            <i class="fa-solid fa-money-bill"></i>
                                            <span class="ms-2">
                                                Les dépenses
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </div>
                </section>
            @endif
        </div>
    </div>

@endsection
