<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discovery - Choruscant</title>
</head>
<body>
    <h1>Discovery</h1>
    <p>Bienvenue dans la constellation musicale de : {{ $user->name }}.</p>

    <h2>Musiques</h2>

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
        <p>Il n'y a pas de musiques à afficher.</p>
    @endforelse

    <a href="{{ url('/') }}">Retour à l'accueil</a>

    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    @endauth
</body>
</html>