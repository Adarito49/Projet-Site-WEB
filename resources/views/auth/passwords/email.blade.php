<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Reset Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type = "text/css" href = "/css/style_welcome.css"> 
	<script src="{{ asset('js/script_mail.js') }}"></script>
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>
<body>
	@extends('layouts.header')
	
	<main>
		<div class="login-box">
			<h1>Mot de passe oublié ?</h1>

			@if (session('status'))
			    <div class="alert alert-success" role="alert">
			        {{ session('status') }}
			    </div>
			@endif

			<form method="POST" action="{{ route('password.email') }}">
				@csrf

				<div class="user-box">
					<label for="email">Adresse mail</label>
					<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>

				<div class="user-box">
					<input type="submit" name="" value="Envoyer la demande" id = "send-email-button">
				</div>
			</form>
		</div>
	</main>
	@extends('layouts.footer')
</body>
</html>
