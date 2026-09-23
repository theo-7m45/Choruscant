<!doctype html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Connexion</title></head>
<body>
    <h1>Connexion</h1>
    @if ($errors->any())<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" required>
        <label for="password">Mot de passe</label><input id="password" type="password" name="password" required>
        <button type="submit">Se connecter</button>
    </form>
    <a href="{{ route('register') }}">Créer un compte</a>
</body>
</html>
