<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes des entreprises</title>
    <link rel="stylesheet" type="text/css" href="/css/style_ratings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="{{ asset('js/script_ratings.js') }}"></script>
	<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

</head>
<body>
@extends('layouts.header')
<main class="main-content">
    <div class="container">
        <h1 class="text-center my-4">Notes des entreprises</h1>
        <div class="row">
            @foreach ($companies as $company)
                <div class="col-md-4 company-container">
                    <div class="card">
                    <div class="logo-container">
                    <img src="{{ asset('storage/images/' . $company->company_name . '.png') }}" alt="{{ $company->name }} logo" class="company-logo card-img-top">
                    </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $company->company_name }}</h3>
                            <div class="d-flex align-items-center">
                                <span class="star-rating" data-rating="{{ $company->ratings->avg('rating') }}"></span>
                            </div>
                            <a href="{{ route('companies.rate', $company->id) }}" class="btn btn-primary">Evaluer cette entreprise</a>
                            </div>
                            </div>
            </div>
        @endforeach 
        <div class="test" id="pagination-container" style="position: flex; padding: 20px;">
        {{ $companies->links('vendor.pagination.custom') }}
        </div>
</main>
@extends('layouts.footer')
</body>
</html>
