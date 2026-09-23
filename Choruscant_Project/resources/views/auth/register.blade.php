<!doctype html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Créer un compte</title></head>
<body>
    <h1>Créer un compte</h1>
    @if ($errors->any())<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>@endif
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Nom</label><input id="name" type="text" name="name" value="{{ old('name') }}" required>
        <label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email') }}" required>
        <label for="password">Mot de passe</label><input id="password" type="password" name="password" required>
        <label for="password_confirmation">Confirmer le mot de passe</label><input id="password_confirmation" type="password" name="password_confirmation" required>
        <button type="submit">S'inscrire</button>
    </form>
    <a href="{{ route('login') }}">Se connecter</a>
</body>
</html>
