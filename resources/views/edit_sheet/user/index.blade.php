<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

    <title>Modifier les utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="/css/style_edit_offers.css">
</head>

<body>
    <main>
        @include('layouts.header')
        <div class="content">

            <div class="form-container">
                <div class="edit-offer-box">
                    <div class="message">Choisissez l'utilisateur à modifier</div>
                    <form action="{{ route('user.update') }}" method="post" id="edit-form" style="display: none;" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" id="user_id">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email">
                        <label for="phone_number">Numéro de téléphone</label>
                        <input type="text" name="phone_number" id="phone_number">
                        <label for="center">Centre</label>
                        <input type="text" name="center" id="center">
                        <label for="promotion">Promotion</label>
                        <input type="text" name="promotion" id="promotion">
                        @if (auth()->user() && auth()->user()->isAdmin())
                        <label for="role">Rôle</label>
                        <input type="text" name="role" id="role">
                        @endif
                        <button type="submit">Mettre à jour</button>
                        <button type="button" id="delete-btn">Supprimer</button>
                    </form>
                </div>
            </div>
            <div class="table-container">
                <h1>Liste des utilisateurs</h1>
                <div class="btn-container">
                    <button class="flat-btn" onclick="window.location.href='/register'">Ajouter un utilisateur</button>
                </div>
                <label for="search">Recherche par nom :</label>

                <input id="search" name="search" rows="1 "><br>

                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Numéro de téléphone</th>
                            <th>Centre</th>
                            <th>Promotion</th>
                            @if (auth()->user() && auth()->user()->isAdmin())
                            <th>Rôle</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td data-id="{{ $user->id }}" class="hide">{{ $user->id }}</td>
                            <td>
                            <img src="{{ asset('/storage/profile_pictures/' .$user->name . '.jpg') }}" alt="{{ Auth::user()->name }}" class="profile-pic" id="profile-pic">
                            </td>
                            <td data-name="{{ $user->name }}">
                                {{ $user->name }}
                            </td>
                            <td data-email="{{ $user->email }}">{{ $user->email }}</td>
                            <td data-phone-number="{{ $user->phone_number }}">{{ $user->phone_number }}</td>
                            <td data-center="{{ $user->center }}">{{ $user->center }}</td>
                            <td data-promotion="{{ $user->promotion }}">{{ $user->promotion }}</td>
                            @if (auth()->user() && auth()->user()->isAdmin())
                            <td data-role="{{ $user->role }}">{{ $user->role }}</td>
                            @endif
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
            document.getElementById('user_id').value = this.querySelector('[data-id]').getAttribute('data-id');
            document.getElementById('email').value = this.querySelector('[data-email]').getAttribute('data-email');
            document.getElementById('phone_number').value = this.querySelector('[data-phone-number]').getAttribute('data-phone-number');
            document.getElementById('center').value = this.querySelector('[data-center]').getAttribute('data-center');
            document.getElementById('promotion').value = this.querySelector('[data-promotion]').getAttribute('data-promotion');
            document.getElementById('role').value = this.querySelector('[data-role]').getAttribute('data-role');
        });
    });

    document.getElementById('delete-btn').addEventListener('click', function() {
        const userId = document.getElementById('user_id').value;
        if (userId && confirm('Voulez-vous vraiment supprimer cet utilisateur ?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('user.destroy', '') }}/" + userId;
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

            const userIdInput = document.createElement('input');
            userIdInput.type = 'hidden';
            userIdInput.name = 'user_id';
            userIdInput.value = userId;
            form.appendChild(userIdInput);

            document.body.appendChild(form);
            form.submit();
        }
    });

    document.getElementById('search').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            const userName = row.querySelector('[data-name]').getAttribute('data-name').toLowerCase();

            if (userName.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>  