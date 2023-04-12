@extends('layout.layout')

@section('title', 'Viewing User ID: ' . $user->id)

@section('content')

    <div class="container mt-3 mb-5">

        {{-- User --}}

        <div class="row">
            <div class="col-md-12">
                <h1>
                    <span>
                        Viewing User: <span class="text-primary">{{ $user->name }}</span>
                    </span>

                    <a href="{{ route('users.index') }}" class="btn btn-primary float-end">Retour</a>
                </h1>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nom:</strong></td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>Addresse email:</strong></td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td><strong>Telephone:</strong></td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td><strong>Addresse:</strong></td>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date de naissance:</strong></td>
                            <td>{{ $user->birthdate }}</td>
                        </tr>
                        <tr>
                            <td><strong>Type:</strong></td>
                            <td>{{ $user->type }}</td>
                        </tr>
                        <tr>
                            <td><strong>Image:</strong></td>
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
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Modifier l'utilisateur</a>
            </div>
        </div>
    </div>

@endsection
