<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyConstellation - Choruscant</title>
</head>
<body>
    <h1>MyConstellation</h1>
    <p>Bienvenue dans ta constellation musicale, {{ $user->name }}.</p>

    <h2>Mes musiques</h2>

    @forelse ($user->musics as $music)
        <article>
            <h3>{{ $music->title }}</h3>

            <iframe
                width="560"
                height="315"
                src="https://www.youtube.com/embed/{{ $music->youtube_video_id }}"
                title="{{ $music->title }}"
                allowfullscreen>
            </iframe>
        </article>
    @empty
        <p>Tu n'as pas encore ajouté de musique.</p>
    @endforelse

    <a href="{{ url('/') }}">Retour à l'accueil</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>