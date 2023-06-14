@extends('layout.layout')

@section('title', 'Accès interdit')

@section('content')
    <section class="container-xxl py-6 text-center">
        <h1 class="display-4">
            <i class="fa-solid fa-exclamation-circle"></i>
            403 
            <i class="fa-solid fa-exclamation-circle"></i>
        </h1>
        <h2 class="mb-4">L'accès à cette page est interdit</h2>
        <p>Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
        <a href="{{ route('main') }}" class="btn btn-primary mt-4">
            <i class="fa-solid fa-house"></i>
            Retourner à l'accueil
        </a>
    </section>
@endsection
