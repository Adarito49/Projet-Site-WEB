<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'offre</title>
    <link rel="stylesheet" type="text/css" href="/css/style_offer_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css%22%3E">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>

<body>
    @extends('layouts.header')

    <main class="main-content">
        <div class="container">
			<div class = "offer-box">
				<div class="company-box">
					<img src="/storage/images/{{ $offer->company->company_name }}.png" alt="{{ $offer->company->company_name }}" class="company-logo">
					<h3 class="company-name">{{ $offer->company->company_name }}</h3>
				</div>
				<div class="info">
					<p class="info-title"><strong>Résumé :</strong></p>
					<p class="info-text"><strong>Compétences :</strong> {{ $offer->skills }}</p>
					<p class="info-text"><strong>Type :</strong> {{ $offer->type }}</p>
					<p class="info-text"><strong>Durée :</strong> {{ $offer->duration }}</p>
					<p class="info-text"><strong>Salaire :</strong> {{ $offer->salary }}</p>
					<p class="info-text"><strong>Date :</strong> {{ $offer->date }}</p>
					<p class="info-text"><strong>Nombre de places :</strong> {{ $offer->number }}</p>
				</div>
			</div>	
            <div class="content">
                <h2 class="offer-title">{{ $offer->title }}</h2>
                <div class="offer-description">
                    {!! $offer->offer_description !!}
                </div>
                <div class="apply-btn-wrapper">
    <a href="{{ route('apply', ['offer_id' => $offer->id]) }}" class="apply-btn">Postuler</a>
                </div>
            </div>
        </div>
    </main>

    @extends('layouts.footer')
</body>

</html>