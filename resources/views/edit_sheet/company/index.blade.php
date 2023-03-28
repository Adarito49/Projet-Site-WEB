<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les entreprises</title>
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

    <link rel="stylesheet" type="text/css" href="/css/style_edit_company.css">
</head>

<body>
    <main>
        @include('layouts.header')
        <div class="content">
            <div class="form-container">
                <div class="edit-company-box">
                    <div class="message">Choisissez l'entreprise à modifier</div>
                    <form action="{{ route('company.update') }}" method="post" id="edit-form" style="display: none;" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="company_id" id="company_id">
                        <label for="sector">Secteur</label>
                        <input type="text" name="sector" id="sector">
                        <label for="street_number">Numéro de rue</label>
                        <input type="text" name="street_number" id="street_number">
                        <label for="street_name">Nom de rue</label>
                        <input type="text" name="street_name" id="street_name">
                        <label for="postal_code">Code Postal</label>
                        <input type="text" name="postal_code" id="postal_code">
                        <label for="city">Ville</label>
                        <input type="text" name="city" id="city">
                        <label for="building">Bâtiment</label>
                        <input type="text" name="building" id="building">
                        <label for="floor">Etage</label>
                        <input type="text" name="floor" id="floor">
                        <label for="interns_number">Nombre de stagiaires</label>
                        <input type="number" name="interns_number" id="interns_number">
                        <label for="pilot_trust">Confiance du pilote</label>
                        <input type="text" name="pilot_trust" id="pilot_trust">
                        <button type="submit">Mettre à jour</button>
                        <button type="button" id="delete-btn">Supprimer</button>
                    </form>
                </div>
            </div>
            <div class="table-container">
                <h1>Liste des entreprises</h1>
                <div class="btn-container">
                <button class="flat-btn" onclick="window.location.href='/create/company'">Ajouter une entreprise</button>
    </div>
                <label for="search">Recherche par nom :</label>

                <input id="search" name="search" rows="1 "><br>

                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Nom de l'entreprise</th>
                            <th>Secteur d'activité</th>
                            <th>Code Postal</th>
                            <th>Ville</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                        <tr>
                            <td data-id="{{ $company->id }}" class="hide">{{ $company->id }}</td>
                            <td data-id="Logo">
                            <img src="{{ asset('storage/images/' . $company->company_name . '.png') }}" alt="{{ $company->company_name }} logo" style="width: 50px; height: 50px;">
                            </td>
                            <td data-company-name="{{ $company->company_name }}">
                                {{ $company->company_name }}
                            </td>
                            <td data-sector="{{ $company->sector }}">{{ $company->sector }}</td>
                            <td data-street-number="{{ $company->street_number }}" class="hide">{{ $company->street_number }}</td>
                            <td data-street-name="{{ $company->street_name }}" class="hide">{{ $company->street_name }}</td>
                            <td data-postal-code="{{ $company->postal_code }}" >{{ $company->postal_code }}</td>
                            <td data-city="{{ $company->city }}">{{ $company->city }}</td>
                            <td data-building="{{ $company->building }}" class="hide">{{ $company->building }}</td>
                            <td data-floor="{{ $company->floor }}" class="hide">{{ $company->floor }}</td>
                            <td data-interns-number="{{ $company->interns_number }}" class="hide">{{ $company->interns_number }}</td>
                            <td data-pilot-trust="{{ $company->pilot_trust }}"class="hide">{{ $company->pilot_trust }}</td>
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
                document.getElementById('company_id').value = this.querySelector('[data-id]').getAttribute('data-id');
                document.getElementById('sector').value = this.querySelector('[data-sector]').getAttribute('data-sector');
                document.getElementById('street_number').value = this.querySelector('[data-street-number]').getAttribute('data-street-number');
                document.getElementById('street_name').value = this.querySelector('[data-street-name]').getAttribute('data-street-name');
                document.getElementById('postal_code').value = this.querySelector('[data-postal-code]').getAttribute('data-postal-code');
                document.getElementById('city').value = this.querySelector('[data-city]').getAttribute('data-city');
                document.getElementById('building').value = this.querySelector('[data-building]').getAttribute('data-building');
                document.getElementById('floor').value = this.querySelector('[data-floor]').getAttribute('data-floor');
                document.getElementById('interns_number').value = this.querySelector('[data-interns-number]').getAttribute('data-interns-number');
                document.getElementById('pilot_trust').value = this.querySelector('[data-pilot-trust]').getAttribute('data-pilot-trust');

            });
        });


        document.getElementById('delete-btn').addEventListener('click', function() {
            const companyId = document.getElementById('company_id').value;
            if (companyId && confirm('Voulez-vous vraiment supprimer cette entreprise ?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('company.destroy', '') }}/" + companyId;
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

                const companyIdInput = document.createElement('input');
                companyIdInput.type = 'hidden';
                companyIdInput.name = 'company_id';
                companyIdInput.value = companyId;
                form.appendChild(companyIdInput);

                document.body.appendChild(form);
                form.submit();
            }
        });

        document.getElementById('search').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(function(row) {
                const companyName = row.querySelector('[data-company-name]').getAttribute('data-company-name').toLowerCase();

                if (companyName.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>