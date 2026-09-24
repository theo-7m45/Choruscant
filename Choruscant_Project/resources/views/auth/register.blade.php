<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un compte</title>
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            padding: 2rem;
            display: grid;
            place-content: center;
            background: #000;
            color: #fff;
            font-family: sans-serif;
        }
        h1 { margin: 0 0 1.5rem; text-align: center; }
        form {
            width: min(100%, 420px);
            display: grid;
            gap: 0.7rem;
            padding: 1.5rem;
            background: #111;
            border: 1px solid #333;
            border-radius: 8px;
        }
        label { margin-top: 0.35rem; }
        input {
            width: 100%;
            padding: 0.7rem;
            background: #000;
            border: 1px solid #555;
            border-radius: 6px;
            color: #fff;
        }
        button, a {
            color: #fff;
            font: inherit;
        }
        button {
            margin-top: 0.5rem;
            padding: 0.7rem 1rem;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover { background: #fff; color: #000; }
        body > a { display: block; margin-top: 1rem; text-align: center; }
        li { color: #ffb4b4; margin-bottom: 0.35rem; }
    </style>
</head>
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
