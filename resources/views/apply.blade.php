<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Postuler</title>
	<link rel="stylesheet" type="text/css" href="/css/style_apply.css">*
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">


</head>
@include('layouts.header')

<body>
	<main>
		<div class="container">
			<h1>Offre: {{ $offer->title }}</h1>
			<h1>Entreprise: {{ $offer->company->company_name }}</h1>
			<form method="post" action="{{ route('apply.submit', ['offer_id' => $offer->id]) }}" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="message">Message de motivation :</label>
					<textarea name="message" id="message" class="form-control" rows="5" required maxlength="500"></textarea>
				</div>
				<div class="form-group">
					<label for="cv">CV (format PDF uniquement) :</label>
					<input type="file" name="cv" id="cv" class="form-control-file" accept="application/pdf" required>
				</div>
				<button type="submit" class="btn btn-primary">Envoyer</button>
				<br>
				@if(session('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
				@endif

				@if(session('Error'))
				<div class="alert alert-danger">
					{{ session('Error') }}
				</div>
				@endif
			</form>


		</div>
	</main>
	@include('layouts.footer')
</body>

</html>