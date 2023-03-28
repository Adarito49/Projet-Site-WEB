<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mentions légales</title>
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<link rel="manifest" href="{{ route('laravelpwa.manifest') }}">

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
    body {
        font-family: sans-serif;
    background: rgb(174, 175, 176);
    background: linear-gradient(0deg, rgba(174, 175, 176, 1) 0%, rgba(241, 241, 241, 1) 94%);
    background-size: cover;
}
main {
    margin-top: 100px;
    position: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-top: 110px;
}

#update {
    color: grey;
}

ul {
    padding-left: 20px;
}

li {
    margin-bottom: 5px;
}

hr {
    border: 1px solid rgb(251, 226, 22);
}

@keyframes link-hover {
    0% {
        color: black;
        text-decoration: underline;
    }

    33% {
        color: grey;
        text-decoration: underline;
    }

    66% {
        color: grey;
        text-decoration: none;
    }
}

a:active {
    color: rgb(251, 226, 22);
    text-decoration: none;
}
    </style>
</head>
<body>

    @extends('layouts.header')
    <main>
        <div class = "editor">
            <h1>Éditeur du site "cesi-stages.fr" : Société&nbspCESI&nbspSTAGES</h1>
            <p id = "update">Date de mise à jour : Mars 2023</p>
            <ul>
                <li>SAS au capital de 1 €</li>
                <li>Siège social : 264 Boulevard Godard, 33300 Bordeaux</li>
                <li>N° de téléphone : <a href = "tel:+33644629412">06 44 62 94 12</a></li>
            </ul>
            <p>Vous pouvez contacter cesi-stages.fr par mail <a href = "mailto:cesi.stages.assistance@cesi.fr">cesi.stages.assistance@cesi.fr</a></p>
            <p>Directeur de publication : Adar&nbspTEKIN,&nbspDirecteur&nbspGénéral</p>
            <p>Date de création du site : Mars 2023</p>
        </div>
        <hr>
        <div class="host">
            <h1>Hébergeur du site "cesi-stages.fr" : IONOS&nbspSARL</h1>
            <ul>
                <li>SARL au capital de 100.000 €</li>
                <li>Immatriculé au Registre nationale des entreprises sous le numéro 431 303 775</li>
                <li>Siège social : 7 Place de la Gare, 57200 Sarreguemines</li>
                <li>Téléphone : <a href = "tel:+33890109250">08 90 10 92 50</a></li>
            </ul>
        </div>
    </main>
    @extends('layouts.footer')
</body>