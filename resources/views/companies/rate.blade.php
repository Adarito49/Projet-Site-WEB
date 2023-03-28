<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noter l'entreprise</title>
    <link rel="stylesheet" type="text/css" href="/css/style_rate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/script_rate.js') }}"></script>
	<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">


</head>
<body>
@extends('layouts.header')
    <main>
    <div class="container">
        <h1>Noter l'entreprise : {{ $company->company_name }}</h1>
        <div class="card">
            <div class="logo-container">
                <img src="{{ asset('storage/images/' . $company->company_name . '.png') }}" alt="{{ $company->name }} logo" class="company-logo card-img-top">
            </div>
            <div class="card-body">
                <form id="rating-form" action="{{ route('rate') }}" method="post">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <input type="hidden" name="rating" id="rating" value="0">
                    <div class="rating-container">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="rating-star far fa-star" data-rating="{{ $i }}"></i>
                        @endfor
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn">Noter</button>
                    </div>
                </form>
                <div class="feedback">Votre note a été enregistrée avec succès. Redirection dans <span id="countdown">5</span> secondes.</div>
            </div>

        </div>
    </div>
				<br><br><br>
</main>
@extends('layouts.footer')

</body>
</html>
