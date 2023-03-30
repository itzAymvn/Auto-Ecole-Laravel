@extends('layout.layout')

@section('title', 'Viewing User ID: ' . $user->id)

@section('content')

    <section class="view-user-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">Viewing User ID: {{ $user->id }}</h2>

                    @empty($user->profile)
                        <div class="d-flex justify-content-center mb-3">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                alt="User Image" class="rounded-circle" style="height: 200px; width: 200px;">
                        </div>
                    @else
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ $user->profile }}" alt="User Image" class="rounded-circle"
                                style="height: 200px; width: 200px;">
                        </div>
                    @endempty
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required
                            value="{{ $user->fullname }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required
                            value="{{ $user->username }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            value="{{ $user->email }}" disabled>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-primary py-2 flex-grow-1 me-2">Back</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info py-2 flex-grow-1 ms-2">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
