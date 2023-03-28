<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style_register.css"> 
    <script src="{{ asset('js/script_register.js') }}"></script>
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">


</head>
<body>
	@extends('layouts.header')
    <main>
        <div class="login-box">
            <div class="user-icon">
                <img src="/img/connexion/utilisateur.png" alt="personnage">
            </div>
            <h1>S'inscrire</h1>
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
				
				<input id="profile_picture" type="file" accept=".jpeg, .jpg, .png" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" value="{{ old('profile_picture') }}" autocomplete="profile_picture" onchange="previewImage()" required>
				<div class="image-preview">
				</div>
					@error('profile_picture')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

                <div class="user-box">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <label for="name">Nom</label>
 
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="user-box">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="email">Adresse mail</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="user-box">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <label for="password">Mot de passe</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="user-box">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <label for="password-confirm">Confirmer le mot de passe</label>
                </div>

                <div class="user-box">
                    <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="tel">
                    <label for="phone_number">Numéro de téléphone</label>

                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
				
				<div class="user-box">
					<input id="center" type="text" class="form-control @error('center') is-invalid @enderror" name="center" value="{{ old('center') }}" required autocomplete="center">
					<label for="center">Centre</label>

					@error('center')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="user-box">
					<input id="promotion" type="text" class="form-control @error('promotion') is-invalid @enderror" name="promotion" value="{{ old('promotion') }}" required autocomplete="promotion">
					<label for="promotion">Promotion</label>

					@error('promotion')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="user-box">
					<select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
						<option value="etudiant">{{ __('Etudiant') }}</option>
						<option value="admin">{{ __('Admin') }}</option>
						<option value="pilot">{{ __('Pilote') }}</option>
					</select>
					<label for="role">Rôle</label>

					@error('role')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

                <input type="submit" name="incrire" value="S'inscrire">
            </form>
			
			@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}
				</div>
			@endif

			@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{ session('error') }}
				</div>
			@endif
        </div>
    </main>
	@extends('layouts.footer')

</body>

</html>