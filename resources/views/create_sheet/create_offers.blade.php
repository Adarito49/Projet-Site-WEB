<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Création d'offres</title>
	<link rel="stylesheet" type="text/css" href="/css/style_create_offers.css">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

	<script src="https://cdn.tiny.cloud/1/mt0j14ixn3bhl92rzcqsn0bmdo7tr5bh89kpb24lmfx7w26y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

			<h1>Création d'offre</h1>
			<form method="POST" action="{{ route('offer.store') }}" enctype="multipart/form-data" onsubmit="return validateForm();">
				@csrf
				<div class="user-box">
					<input type="text" class="effect-8" name="title" required="">
					<label for="title">Intitulé d'offre* :</label>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="user-box">
					<input type="text" class="effect-8" name="skills" required="">
					<label for="skills">Compétences* :</label>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="select-container2">
					<label for="type">Contrat* :</label>
					<input type="text" id="type-input" name="type" placeholder="Stage ou alternance" list="type" required="">
					<datalist id="type">
						<option value="Alternance">
						<option value="Stage">
					</datalist>
				</div>

				<div class="select-container">
					<img id="company-logo-preview" src="" alt="Logo entreprise">
					<input type="text" id="company-name-input" name="company_name" placeholder="Recherchez une entreprise..." list="company-names" required="">
					<datalist id="company-names">
						@foreach(App\Models\Company::pluck('company_name') as $company_name)
						<option value="{{ $company_name }}">
							@endforeach
					</datalist>
				</div>

				<div class="user-box">
					<input type="text" class="effect-8" name="duration" required="">
					<label for="duration">Durée du stage* </label>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="user-box">
					<input type="text" class="effect-8" name="salary" required="">
					<label for="salary">Base de rémunération* </label>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="user-box">
					<input type="text" class="effect-8" name="date" required="">
					<label for="date">Date de début* </label>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="user-box">
					<input type="number" name="number" required="">
					<label for="number">Nombre de places* </label>
				</div>

				<div class="user-box">
					<input type="email" class="effect-8" name="email" required="">
					<label for="email">Adresse mail de l'entreprise* </label>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="user-box">
					<label for="postal_code">Code postal* </label>
					<input type="text" class="effect-8" id="postal_code" name="postal_code" placeholder="Sélectionnez un code postal" required>
					<div class="focus-border">
						<i></i>
					</div>
				</div>

				<div class="user-box">
					<label for="city">Ville* </label>
					<select id="city" name="city" required>
						<option value="" disabled selected>Sélectionnez une ville</option>
					</select>
				</div>

				<div class="user-box">
					<textarea id="offer_description" name="offer_description"></textarea>
					<label for="offer_description">Description de l'offre* </label>
				</div>

				<input type="submit" name="" value="Créer l'offre">
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
	tinymce.init({
		selector: '#offer_description',
		plugins: 'link',
		menubar: true,
		branding: false,
		setup: function(editor) {
			var maxChars = 2500;

			editor.on('keyup', function(e) {
				var content = editor.getContent();
				var len = tinymce.trim(content).length;

				if (len > maxChars) {
					editor.setContent(content.substring(0, maxChars));
					alert('La limite de caractères a été atteinte.');
				}
			});
		}
	});

	function validateForm() {
		var input = document.getElementById("company-name-input");
		var datalist = document.getElementById("company-names");
		var options = datalist.getElementsByTagName("option");
		var isValid = false;
		for (var i = 0; i < options.length; i++) {
			if (input.value === options[i].value) {
				isValid = true;
				break;
			}
		}
		if (!isValid) {
			alert("Veuillez sélectionner une entreprise valide dans la liste.");
			return false;
		}
		return true;
	}


	var typeInput = document.getElementById("type-input");
	var typeList = document.getElementById("type");

	typeInput.addEventListener("input", function(event) {
		var inputValue = event.target.value;
		var optionFound = false;

		for (var i = 0; i < typeList.options.length; i++) {
			var option = typeList.options[i];
			if (inputValue.toLowerCase() === option.value.toLowerCase()) {
				optionFound = true;
				break;
			}
		}

		if (!optionFound) {
			typeInput.setCustomValidity("Veuillez choisir un type de contrat valide");
		} else {
			typeInput.setCustomValidity("");
		}
	});

	const input = document.getElementById("company-name-input");
	const preview = document.getElementById("company-logo-preview");


	const defaultImageUrl = "{{ asset('storage/images/default.png') }}";
	preview.src = defaultImageUrl;

	input.addEventListener("input", (event) => {
		const companyName = event.target.value;
		const logoUrl = "{{ asset('storage/images/') }}/" + companyName + ".png";
		const img = new Image();
		img.onload = function() {
			preview.src = logoUrl;
		};
		img.onerror = function() {
			preview.src = defaultImageUrl;
		};
		img.src = logoUrl;
	});

	async function fetchCities(postalCode) {
		const response = await fetch(`https://api-adresse.data.gouv.fr/search/?q=${postalCode}&type=municipality&autocomplete=0`);
		const data = await response.json();
		return data.features.map(feature => feature.properties.city);
	}

	document.getElementById("postal_code").addEventListener("input", async (event) => {
		const postalCode = event.target.value;
		if (postalCode.length === 5) {
			const cities = await fetchCities(postalCode);
			const citiesSelect = document.getElementById("city");
			citiesSelect.innerHTML = '<option value="" disabled selected>Sélectionnez une ville</option>';

			cities.forEach(city => {
				const option = document.createElement("option");
				option.value = city;
				option.textContent = city;
				citiesSelect.appendChild(option);
			});
		}
	});

	document.getElementById("city").addEventListener("change", async (event) => {
		const city = event.target.value;
		const postalCode = document.getElementById("postal_code").value;

		if (city && postalCode.length === 5) {
			const streets = await fetchStreets(postalCode, city);
			const streetsDatalist = document.getElementById("street_names");
			streetsDatalist.innerHTML = '';

			streets.forEach(street => {
				const option = document.createElement("option");
				option.value = street;
				streetsDatalist.appendChild(option);
			});
		}
	});
</script>

</html>