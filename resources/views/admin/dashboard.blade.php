@extends('layout.layout')

@section('title', 'Admin Dashboard')

@section('content')

    <section class="admin-dashboard-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-12 mx-4">
                    <h2 class="text-center mb-5">Admin Dashboard</h2>
                    <div class="d-grid gap-2">
                        <a href="{{ route('users.index') }}" class="btn btn-primary py-2">Manage Users</a>
                        <a href="" class="btn btn-primary py-2">Manage Sessions</a>
                        <a href="" class="btn btn-primary py-2">Manage Exams</a>
                        <a href="" class="btn btn-primary py-2">Manage Vehicles</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
