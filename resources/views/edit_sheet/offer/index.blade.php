<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

    <title>Modifier les offres</title>
    <link rel="stylesheet" type="text/css" href="/css/style_edit_offers.css">
</head>

<body>
    <main>
        @include('layouts.header')
        <div class="content">



            <div class="form-container">
                <div class="edit-offer-box">
                    <div class="message">Choisissez l'offre à modifier</div>
                    <form action="{{ route('offer.update') }}" method="post" id="edit-form" style="display: none;" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="offer_id" id="offer_id">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title">
                        <label for="skills">Compétences</label>
                        <input type="text" name="skills" id="skills">
                        <label for="duration">Durée</label>
                        <input type="text" name="duration" id="duration">
                        <label for="salary">Salaire</label>
                        <input type="text" name="salary" id="salary">
                        <label for="date">Date</label>
                        <input type="text" name="date" id="date">
                        <label for="number">Numéro</label>
                        <input type="text" name="number" id="number">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email">
                        <label for="offer_description">Description de l'offre</label>
                        <textarea name="offer_description" id="offer_description"></textarea>
                        <label for="postal_code">Code Postal</label>
                        <input type="text" name="postal_code" id="postal_code">
                        <label for="city">Ville</label>
                        <input type="text" name="city" id="city">
                        <button type="submit">Mettre à jour</button>
                        <button type="button" id="delete-btn">Supprimer</button>
                    </form>
                </div>
            </div>
            <div class="table-container">
                <h1>Liste des offres</h1>
                <div class="btn-container">
                    <button class="flat-btn" onclick="window.location.href='/create/offers'">Ajouter une offre</button>
                </div>
                <label for="search">Recherche par titre :</label>

                <input id="search" name="search" rows="1 "><br>

                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Durée</th>
                            <th>Date</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                        <tr>
                            <td data-id="{{ $offer->id }}" class="hide">{{ $offer->id }}</td>
                            <td data-title="{{ $offer->title }}">
                                {{ $offer->title }}
                                </td>
                        <td data-skills="{{ $offer->skills }}" class="hide">{{ $offer->skills }}</td>
                        <td data-duration="{{ $offer->duration }}">{{ $offer->duration }}</td>
                        <td data-salary="{{ $offer->salary }}" class="hide">{{ $offer->salary }}</td>
                        <td data-date="{{ $offer->date }}">{{ $offer->date }}</td>
                        <td data-number="{{ $offer->number }}" class="hide">{{ $offer->number }}</td>
                        <td data-email="{{ $offer->email }}" class="hide">{{ $offer->email }}</td>
                        <td data-offer-description="{{ $offer->offer_description }}" class="hide">{{ $offer->offer_description }}</td>
                        <td data-postal-code="{{ $offer->postal_code }}">{{ $offer->postal_code }}</td>
                        <td data-city="{{ $offer->city }}">{{ $offer->city }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</main>
@include('layouts.footer')
<script>
    document.querySelectorAll('tbody tr').forEach(function(row) {
        row.addEventListener('click', function() {
            document.getElementById('edit-form').style.display = 'grid';
            document.querySelector('.message').style.display = 'none';
            document.getElementById('offer_id').value = this.querySelector('[data-id]').getAttribute('data-id');
            document.getElementById('title').value = this.querySelector('[data-title]').getAttribute('data-title');
            document.getElementById('skills').value = this.querySelector('[data-skills]').getAttribute('data-skills');
            document.getElementById('duration').value = this.querySelector('[data-duration]').getAttribute('data-duration');
            document.getElementById('salary').value = this.querySelector('[data-salary]').getAttribute('data-salary');
            document.getElementById('date').value = this.querySelector('[data-date]').getAttribute('data-date');
            document.getElementById('number').value = this.querySelector('[data-number]').getAttribute('data-number');
            document.getElementById('email').value = this.querySelector('[data-email]').getAttribute('data-email');
            document.getElementById('offer_description').value = this.querySelector('[data-offer-description]').getAttribute('data-offer-description');
            document.getElementById('postal_code').value = this.querySelector('[data-postal-code]').getAttribute('data-postal-code');
            document.getElementById('city').value = this.querySelector('[data-city]').getAttribute('data-city');
        });
    });

    document.getElementById('delete-btn').addEventListener('click', function() {
        const offerId = document.getElementById('offer_id').value;
        if (offerId && confirm('Voulez-vous vraiment supprimer cette offre ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('offer.destroy', '') }}/" + offerId;
            form.style.display = 'none';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            const offerIdInput = document.createElement('input');
            offerIdInput.type = 'hidden';
            offerIdInput.name = 'offer_id';
            offerIdInput.value = offerId;
            form.appendChild(offerIdInput);

            document.body.appendChild(form);
            form.submit();
        }
    });

    document.getElementById('search').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            const offerTitle = row.querySelector('[data-title]').getAttribute('data-title').toLowerCase();

            if (offerTitle.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>