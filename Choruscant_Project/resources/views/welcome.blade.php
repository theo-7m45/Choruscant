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
        <a href="{{ url('/') }}">Masquer les résultats</a>
        @if(isset($searchResults) && $searchResults->isNotEmpty())
            @foreach ($searchResults as $user)
                <a
                    href="{{ route('discovery', $user) }}"
                    aria-label="Voir la constellation de {{ $user->name }}"
                    title="Voir la constellation de {{ $user->name }}"
                    style="font-size: 2rem; text-decoration: none; display: inline-block; margin: 0.5rem;"
                >
                    ★
                </a>
            @endforeach
        @else
            <p>Aucun utilisateur trouvé pour cette recherche.</p>
        @endif
    @endisset

    <h2>L'univers</h2>
    @foreach ($users as $user)
        <a
            href="{{ route('discovery', $user) }}"
            aria-label="Voir la constellation de {{ $user->name }}"
            title="Voir la constellation de {{ $user->name }}"
            style="font-size: 2rem; text-decoration: none; display: inline-block; margin: 0.5rem;"
        >
            ★
        </a>
    @endforeach

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
        <a href="{{ route('my-constellation') }}">MyConstellation</a>
    @endauth
</body>
</html>
