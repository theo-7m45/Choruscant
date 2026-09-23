<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>