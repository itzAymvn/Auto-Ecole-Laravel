@extends('layout.layout')

@section('title', 'Page d\'utilisateur')

@section('content')

    <div class="container mt-3 mb-5">

        {{-- User --}}

        <div class="row">
            <div class="col-md-12">
                <h5>
                    <span>
                        <i class="fas fa-user"></i>
                        Vous visualisez l'utilisateur:
                        <span class="text-primary">{{ $user->name }}</span>
                    </span>

                    <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-primary float-end">
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
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-user"></i>
                                    Nom:
                                </strong>
                            </td>
                            <td>{{ $user->name }}</td>
                        </tr>
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
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-user-tag"></i>
                                    Type:
                                </strong>
                            </td>
                            <td>
                                @if ($user->type == 'admin')
                                    <span class="badge bg-danger">Administrateur</span>
                                @elseif($user->type == 'student')
                                    <span class="badge bg-primary">Étudiant</span>
                                @elseif($user->type == 'instructor')
                                    <span class="badge bg-success">Instructeur</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <i class="fas fa-image"></i>
                                    Image:

                                </strong>
                            </td>
                            <td>
                                @empty($user->image)
                                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                        alt="Image" width="50" height="50">
                                @else
                                    <img src="{{ asset('storage/profiles/' . $user->image) }}" alt="Image" width="50"
                                        height="50">
                                @endempty
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    Modifier l'utilisateur
                </a>
            </div>
        </div>
    </div>

@endsection
