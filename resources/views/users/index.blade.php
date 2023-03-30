@extends('layout.layout')

@section('title', 'Manage Users')

@section('content')

    <section class="manage-users-section container py-5">
        @if (count($users) > 0)

            <div class="d-flex justify-content-between mb-3">
                <h2>Manage Users
                    <span class="badge bg-primary">{{ count($users) }}</span>
                </h2>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
            </div>
            <table class="table table-striped table-hover table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
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
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td class="d-flex justify-content-around align-items-center gap-2">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">No users found.</div>
        @endif
    </section>

@endsection
