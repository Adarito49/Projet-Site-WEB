<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mes Favoris</title>
    <link rel="stylesheet" type="text/css" href="/css/style_favorites.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>

<body>
    @extends('layouts.header')
    <main class="container main-content">
    @if (Route::has('login'))
    @auth
    <h1 class="text-center my-4">Mes Favoris</h1>
    <div class="row offers-list">
        <div class="no-results" style="display:none;">Aucune offre ne correspond à votre recherche.</div>
        @foreach ($favorites as $favorite)
        <div class="col-md-4">
            <a href="offers/{{ $favorite->id }}" target="_blank" style="text-decoration:none; color:inherit;">
                <div class="card offer-item" data-id="{{ $favorite->id }}">
                    <div class="logo-container">
                        <img src="{{ asset('storage/images/' . $favorite->company->company_name . '.png') }}" alt="{{ $favorite->company->company_name }} logo" class="company-logo">
                    </div>
                    <div class="card-body">
                        <div class="card-title-box">
                            <h2 class="card-title">{{ $favorite->title }}</h2>
                        </div>
                        <p id="company-underline">{{ $favorite->company->company_name }}</p>
                        <p>Type : {{ $favorite->type }}</p>
                        <p>Publication : {{ $favorite->date }}</p>
                        <p>Lieu : {{ $favorite->postal_code }} {{ $favorite->city }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <p class="message">Veuillez vous connecter pour accéder au site.</p>
    @endauth
    @endif
</main>
    @extends('layouts.footer')

</body>

</html>