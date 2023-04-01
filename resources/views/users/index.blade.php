@extends('layout.layout')

@section('title', 'Manage Users')

@section('content')
    <main class="d-flex justify-content-between flex-column">
        @include('users.panel')
        <section class="manage-users-section container py-5">
            @if (count($users) > 0)
                <div class="d-flex justify-content-between mb-3">
                    <h2>Gérer les utilisateurs
                        <span class="badge bg-primary">{{ count($users) }}</span>
                    </h2>
                    <a href="{{ route('users.create') }}" class="btn btn-primary d-flex align-items-center">
                        Ajouter un utilisateur
                    </a>
                </div>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Nom Complet</th>
                            <th scope="col">Nom d'utilisateur</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type</th>
                            <th scope="col">Créé à</th>
                            <th scope="col">Modifié à</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                @empty($user->profile)
                                    <td><img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            alt="Image" width="50" height="50">
                                    </td>
                                @else
                                    <td><img src="{{ $user->profile }}" alt="Image" width="50" height="50"></td>
                                @endempty
                                <td class="align-middle">{{ $user->fullname }}</td>
                                <td class="align-middle">{{ $user->username }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->type }}</td>
                                <td class="align-middle">{{ $user->created_at }}</td>
                                <td class="align-middle">{{ $user->updated_at }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('users.show', $user->id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('users.destroy', $user->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info">
                    <h2 class="text-center">Aucun utilisateur trouvé</h2>
                </div>
            @endif
        </section>
    </main>

@endsection
