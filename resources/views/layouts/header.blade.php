<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="/css/header.css">

    @laravelPWA
</head>
<header class="header">
  <img src="/img/logo.png" alt="Logo de mon site web" class="logo">
  <nav class="nav-left">
    <ul>
      <li><a href="/">Offres d'emploi</a></li>
      <li><a href="/companies/ratings">Avis sur les entreprises</a></li>
    </ul>
  </nav>
  <nav class="nav-right">
    <ul>
      @if (Route::has('login'))
      <li>
        @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
          @csrf
          <div class="user-profile">
            <img src="{{ asset('/storage/profile_pictures/' . Auth::user()->name . '.jpg') }}" alt="{{ Auth::user()->name }}" class="profile-pic" id="profile-pic">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <img src="/img/connexion/deconnexion.png" alt="Déconnexion">
            </a>
          </div>

          <div id="dropdown-menu" style="display:none;">
            <ul>
              <li><a href="/profile">Mon profil</a></li>
              <li><a href="/favorites">Mes favoris</a></li>
              @if (Auth::user()->isAdmin())
              <li><a href="/companies-edit">Gestion des entreprises</a></li>
              <li><a href="/edit/offer">Gestion des offres</a></li>
              <li><a href="/edit/user">Gestion des utilisateurs</a></li>
              @endif
              @if (Auth::user()->isPilot())
              <li><a href="/companies-edit">Gestion des entreprises</a></li>
              <li><a href="/edit/offer">Gestion des offres</a></li>
              <li><a href="/edit/user">Gestion des utilisateurs</a></li>
              @endif
            </ul>
          </div>
        </form>
        @else
        <a href="{{ route('login') }}">
          <img src="/img/connexion/user_login.png" alt="Bouton de connexion" class="no-hover">
        </a>
        @endauth
      </li>
      @endif
    </ul>
  </nav>
  <div class="hamburger" id="hamburger-icon">
    <div class="bar"></div>
    <div class="bar"></div>
    <div class="bar"></div>
  </div>
  <ul class="hamburger-menu" id="hamburger-menu">
    <li><a href="/">Offres d'emploi</a></li>
    <li><a href="/companies/ratings">Avis sur les entreprises</a></li>
    @auth
    <li>
      <div class="user-profile">
        <img src="{{ asset('storage/profile_pictures/' . Auth::user()->name . '.jpg') }}" alt="{{ Auth::user()->name }}" class="profile-pic2" id="profile-pic2">
    </li>
    <li><a href="/profile">Mon profil</a></li>
    <li><a href="/favorites">Mes favoris</a></li>
    @if (Auth::user()->isAdmin())
    <li><a href="/companies-edit">Gestion des entreprises</a></li>
    <li><a href="/edit/offer">Gestion des offres</a></li>
    <li><a href="/edit/user">Gestion des utilisateurs</a></li>
    @endif
    @if (Auth::user()->isPilot())
    <li><a href="/companies-edit">Gestion des entreprises</a></li>
    <li><a href="/edit/offer">Gestion des offres</a></li>
    <li><a href="/edit/user">Gestion des utilisateurs</a></li>
    @endif
    <li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      <a href="#" class="deconnexion" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <img src="/img/connexion/deconnexion.png" alt="Déconnexion">
      </a>
    </li>
    @else
    <li><a href="{{ route('login') }}">Connexion</a></li>
    @endauth
  </ul>
</header><script>
  document.getElementById("profile-pic").onclick = function() {
    var dropdown = document.getElementById("dropdown-menu");
    if (dropdown.style.display === "none") {
      dropdown.style.display = "block";
    } else {
      dropdown.style.display = "none";
    }
  };

  document.getElementById("profile-pic2").onclick = function() {
    var dropdown = document.getElementById("dropdown-menu");
    if (dropdown.style.display === "none") {
      dropdown.style.display = "block";
    } else {
      dropdown.style.display = "none";
    }
  };

  window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    header.classList.toggle("small", window.scrollY > 110);
  });

  document.getElementById("hamburger-icon").onclick = function() {
    var menu = document.getElementById("hamburger-menu");
    if (menu.style.display === "block") {
      menu.style.display = "none";
    } else {
      menu.style.display = "block";
    }
    this.classList.toggle("open");
  };
</script>

</html>