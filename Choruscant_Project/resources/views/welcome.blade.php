<!doctype html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Choruscant</title></head>
<body>
    <h1>Choruscant</h1>
    <p>Découvrez et partagez votre musique.</p>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Rechercher un utilisateur" required>
        <button type="submit">Rechercher</button>
    </form>

    @isset($query)
        <h2>Résultats pour « {{ $query }} »</h2>
    @else
        <h2>Cherche un utilisateurs</h2>
    @endisset

    @forelse ($users as $user)
        <article>
            <h3>{{ $user->name }}</h3>
            <a href="{{ route('Discovery', $user) }}">Visiter cette constellation</a>
        </article>
    @empty
        <p>Aucun utilisateur à découvrir.</p>
    @endforelse

    @guest
        <a href="{{ route('login') }}">Se connecter</a>
        <a href="{{ route('register') }}">Créer un compte</a>
    @endguest

    @auth
        <p>Bonjour {{ auth()->user()->name }}.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
        <a href="{{ route('MyConstellation') }}">MyConstellation</a>
    @endauth
</body>
</html>
