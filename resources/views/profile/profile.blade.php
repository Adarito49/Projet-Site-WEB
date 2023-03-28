<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon profil</title>
    <link rel="stylesheet" type="text/css" href="/css/style_profile.css">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>

<body> 
@extends('layouts.header')
    <main>
        <div class="container">
            <img src="{{ asset('/storage/profile_pictures/' . $user->name . '.jpg') }}" alt="Photo de profil" class="profile-picture">
            <h1>Mon profil</h1>

            <div class="row">
                <div class="col-md-6">
                    <h2>Informations personnelles</h2>
                    <p>Nom : <strong>{{ $user->name }}</strong></p>
                    <p>Email : <strong>{{ $user->email }}</strong></p>
                    <p>Numéro de téléphone : <strong>{{ $user->phone_number }}</strong></p>
                    <p>Centre : <strong>{{ $user->center }}</strong></p>
                    <p>Promotion : <strong>{{ $user->promotion }}</strong></p>
                </div>
                <div class="col-md-6">
                    <h2>Offres auxquelles j'ai postulé</h2>
                    <ul>
                    @foreach($appliedOffers as $offer)
                        <div class="offer-card">
                            <h3>{{ $offer->title }} ({{ $offer->company->company_name }})</h3>
                            <p>Type d'offre : {{ $offer->type }}</p>
                            <img src="{{ asset('/storage/images/' . $offer->company->company_name . '.png') }}" alt="Logo de l'entreprise" class="company-logo">
                            <p>Postulé le : {{ $offer->created_at->format('m/Y') }}</p>
                        </div>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br>        <br>        <br>        <br>        <br>
    </main>
    @extends('layouts.footer')
</body>
</html>
