@extends('layout.layout')

@section('title', 'Page non trouvée')

@section('content')
    <section class="container-xxl py-6 text-center">
        <h1 class="display-4">
            <i class="fa-solid fa-exclamation-circle"></i>
            404 
            <i class="fa-solid fa-exclamation-circle"></i>
        </h1>
        <h2 class="mb-4">La page que vous recherchez n'existe pas</h2>
        <p>Vous pouvez retourner à la page d'accueil en cliquant sur le bouton ci-dessous.</p>
        <a href="{{ route('main') }}" class="btn btn-primary mt-4">
            <i class="fa-solid fa-house"></i>
            Retourner à l'accueil
        </a>
    </section>
@endsection
