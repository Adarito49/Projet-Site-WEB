<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="/css/style_home.css">
    <script src="{{ asset('js/script_home.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">


</head>

<body>
    @extends('layouts.header')

<main class="main-content">
    @if (Route::has('login'))
    @auth
    <div class="search-container">
        <label for="job-search">Quoi ? </label>
        <input type="text" class="search-input" id="job-search" placeholder="Poste, métier, domaine..." name="quoi">
        
        <label for="location-search">Où ? </label>
        <input type="text" class="search-input" id="location-search" placeholder="Commune, code postal..." name="ou">   
    </div>
    <div class="content-wrapper">
        <div class="offers-list">
            <div class="no-results" style="display:none;">Aucune offre ne correspond à votre recherche.</div>
            @foreach ($offers->reverse() as $offer)
            <div class="offer-item" data-id="{{ $offer->id }}">
                <img src="{{ asset('storage/images/' . $offer->company->company_name . '.png') }}" alt="{{ $offer->company->company_name }} logo" class="company-logo">
                <div class="offer-info">
                    <h3>{{ $offer->title }}</h3>
                    <p>{{ $offer->company->company_name }}</p>
                    <p>{{ $offer->type }}</p>
                    <p>{{ $offer->date }}</p>
                    <p>{{ $offer->postal_code }} {{ $offer->city }}</p>
                </div>
                @php
                $isFavorited = $favorites->contains($offer->id);
                @endphp
                <button class="favorite-button {{ $isFavorited ? 'selected' : '' }}" data-favorited="{{ $isFavorited ? 'true' : 'false' }}" style="background: none; border: none; position: absolute; top: 10px; right: 10px; font-size: 25px; transition: all 0.3s;">
                    <i class="{{ $isFavorited ? 'fas' : 'far' }} fa-heart"></i>
                </button>
            </div>
            @endforeach
        </div>
        <div class="selected-offer">
        </div>
    </div>
    @else
        <p class="message">Veuillez vous connecter pour accéder au site.</p>
    @endauth
    @endif
</main>
    @extends('layouts.footer')
    <script>
        async function addFavorite(offerId) {
    try {
    const response = await fetch('/favorites/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ offer_id: offerId })
    });
    
    if (response.ok) {
        return true;
    } else {
        console.error('Erreur lors de l\'ajout du favori');
        return false;
    }
    } catch (error) {
    console.error('Erreur lors de l\'ajout du favori:', error);
    return false;
    }
    }
    
    async function removeFavorite(offerId) {
    try {
    const response = await fetch('/favorites/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ offer_id: offerId })
    });
    
    if (response.ok) {
        return true;
    } else {
        console.error('Erreur lors de la suppression du favori');
        return false;
    }
    } catch (error) {
    console.error('Erreur lors de la suppression du favori:', error);
    return false;
    }
    }
    
    const favoriteButtons = document.querySelectorAll('.favorite-button');
    
    favoriteButtons.forEach(button => {
    button.addEventListener('click', async (event) => {
    event.stopPropagation();
    const offerItem = button.closest('.offer-item');
    const offerId = offerItem.dataset.id;
    
    if (button.dataset.favorited === 'false') {
        const success = await addFavorite(offerId);
        if (success) {
            button.innerHTML = '<i class="fas fa-heart"></i>';
            button.dataset.favorited = 'true';
            button.classList.add('selected');
        }
    } else {
        const success = await removeFavorite(offerId);
        if (success) {
            button.innerHTML = '<i class="far fa-heart"></i>';
            button.dataset.favorited = 'false';
            button.classList.remove('selected');
        }
    }
    });
    });
    
    function updateHeartIcons() {
    favoriteButtons.forEach(button => {
    const isFavorited = button.dataset.favorited === 'true';
    button.innerHTML = `<i class="${isFavorited ? 'fas' : 'far'} fa-heart"></i>`;
    });
    }
        </script>

</body>

</html>