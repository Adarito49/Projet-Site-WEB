<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Création d'entreprises</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" type = "text/css" href = "/css/style_create_company.css"> 
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>
<body>
	@extends('layouts.header')
	<main class="main-content">
		@if (Route::has('login'))
			@auth
		
			<div class="login-box">
			<div class="user-icon">  
				<img src="/img/entreprise/entreprise.png" alt="entreprise">
			</div>
			
			<h1>Création fiche entreprise</h1>
             <form method="post" action="{{ route('companies.store') }}" enctype="multipart/form-data">

				@csrf
                <input type="file" class="image-input" name="image" accept=".png, .jpg, .jpeg" onchange="previewImage()" id="file-input" required> 	

				  <div class="image-preview"></div>
				  <br>
				  <br>
				  
				  	@error('file-input')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<div class="user-box">
				  <input type="text" class="effect-8" id="company_name" name="company_name" required="">
				  <label for="company_name">Nom de l'entreprise :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
				
									@error('company_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<div class="user-box">
				  <input type="text" class="effect-8" name="sector" required="">
				  <label for="sector">Secteur d'activité :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
				
					@error('sector')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<div class="user-box">
				  <input type="text" class="effect-8" name="street_number" required="">
				  <label for="street_number">Numéro de rue :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
				
					@error('street_number')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<div class="user-box">
				  <input type="text" class="effect-8" name="street_name" required="">
				  <label for="street_name">Nom de rue :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
				
					@error('street_name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<div class="user-box">
				  <input type="text" class="effect-8" name="postal_code" required="">
				  <label for="postal_code">Code postal :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div> 
					@error('postal_code')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<div class="user-box">
				  <input type="text" class="effect-8" name="city" required="">
				  <label for="city">Ville :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
				
					@error('city')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				
				<div class="user-box">
				  <input type="text" class="effect-8" name="building">
				  <label for="building">Bâtiment :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
					@error('building')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				
				<div class="user-box">
				  <input type="text" class="effect-8" name="floor">
				  <label for="floor">Étage :</label>
				  <div class="focus-border">
					<i></i>
				  </div>
				</div>
					@error('floor')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror


				<!-- Champ Nombre de stagiaires -->
				<div class="user-box">
				  <input type="number" class="effect-8" name="interns_number" required="">
				  <label for="interns_number">Nombre de stagiaires :</label>
				</div>
				
					@error('interns_number')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

				<!-- Champ Confiance du pilote de promotion -->	
				<div class="user-box">
				  <select name="pilot_trust" class="pilot_trust" required="">
					<option value="" selected disabled hidden>Choisir...</option>
					<option value="0">Pas confiant</option>
					<option value="1">Assez confiant</option>
					<option value="2">Très confiant</option>
				  </select>
				  <label for="pilot_trust">Confiance du pilote de promotion :</label>
				</div>
				
				@error('pilot_trust')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				
				<input type="submit" name="" value="Créer la fiche entreprise">
			</form>
			
			<br><br><br><br><br>
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
			@else
				<p class="message">Veuillez vous connecter pour accéder au site.</p>
			@endauth
		@endif
	</main>
	@extends('layouts.footer')
</body>
<script>
function previewImage() {
  var reader = new FileReader();
  reader.onload = function() {
    var imagePreview = document.querySelector('.image-preview');
    
    imagePreview.innerHTML = '';
    
    var image = document.createElement('img');
    image.src = reader.result;
    imagePreview.appendChild(image);
  }
  reader.readAsDataURL(event.target.files[0]);
}

const input = document.querySelector('.user-box input[type="text"]');
const label = document.querySelector('.user-box label');

input.addEventListener('input', () => {
  if (input.value !== '') {
    label.classList.add('not-empty');
  } else {
    label.classList.remove('not-empty');
  }
});
</script>
</html>



