<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>

<body>
<h1>Inscription</h1>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" required><br>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required><br>

    <label for="password_confirmation">Confirmer le mot de passe :</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required><br>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>