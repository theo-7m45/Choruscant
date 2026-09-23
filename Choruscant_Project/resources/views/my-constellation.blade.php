<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyConstellation - Choruscant</title>
</head>
<body>
    <h1>MyConstellation</h1>
    <p>Bienvenue dans ta constellation musicale, {{ auth()->user()->name }}.</p>
    <a href="{{ url('/') }}">Retour à l'accueil</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>