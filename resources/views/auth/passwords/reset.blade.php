<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Reset Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type = "text/css" href = "/css/style_welcome.css"> 
	<script src="{{ asset('js/script_reset.js') }}"></script>
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>
<body>

@extends('layouts.header')	
	<main id="main-mdp-reset">
		<div class="login-box" id = "login-box-mdp">
			<div class="user-icon">
				<img src="/img/connexion/utilisateur.png" alt="personnage">
			</div>
			<h1 id = "mdp-title">Changement de mot de passe</h1>
			<form method="POST" action="{{ route('password.update') }}" class = "form-mdp">
				@csrf
				<input type="hidden" name="token" value="{{ $token }}">

				<div class="user-box">
					<label for="email">Adresse mail</label>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="user-box">
					<label for="password">Nouveau mot de passe</label>
					<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
					@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="user-box">
					<label for="password-confirm">Confirmer mot de passe </label>
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
				</div>

				<div class="user-box">
				<input type="submit" name="" id = "mdp-reset-button" value="Réinitialiser le mot de passe">
				</div>
			</form>
		</div>
	</main>
	@extends('layouts.footer')
</body>

</html>
