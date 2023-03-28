<!DOCTYPE html>
<html lang = "fr">
<head>
	<meta charset="UTF-8">
	<title>Page de connexion</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type = "text/css" href = "/css/style_welcome.css">
	<script src="{{ asset('js/script_login.js') }}"></script>
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

	<script>
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/sw.js')
      .then((sw) => {
        // registration worked
        console.log('Enregistrement réussi');
      }).catch((error) => {
        // registration failed
        console.log('Erreur : ' + error);
      });
    }
  	</script>
</head>
<body>

	@extends('layouts.header')
	<main>
		<div class="login-box">
			<div class="user-icon">
				<img src="/img/connexion/utilisateur.png" alt="personnage">
			</div>
			<h1 class = "strong-message">Connectez-vous</h1>
			<form method="POST" action="{{ route('login') }}">
					@csrf
					
				<div class="user-box">
						  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required="" id="email">
						  <label for="email">Adresse mail</label>
						  <br> 
				</div>
				
				<div class="user-box">
					<input type="password" class="form-control @error('email') is-invalid @enderror" name="password" required="">
					<label>Mot de passe</label>
				</div>
				
										  @error('email')
							<span class="invalid-feedback" role="alert">
							  <strong>L'email ou le mot de passe est incorrect</strong>
							</span>
						  @enderror
				
				<input type="submit" name="connexion" value="Connexion">
					<br><br>
				
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
			</form>
		</div>
			<p class="register-link"><strong>Vous n’avez pas encore de compte ?</strong> <br>Renseignez vous auprès de votre pilote de formation.</p>
	</main>
	@extends('layouts.footer')

</body>
</html>



