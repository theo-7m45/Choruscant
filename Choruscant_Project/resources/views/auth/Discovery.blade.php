<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discovery - Choruscant</title>
    <style>
        * { box-sizing: border-box; }
        body {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem;
            background: #000;
            color: #fff;
            font-family: sans-serif;
        }
        h1, h2, h3 { color: #fff; }
        a, button {
            display: inline-block;
            padding: 0.65rem 1rem;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 6px;
            color: #fff;
            font: inherit;
            text-decoration: none;
            cursor: pointer;
        }
        a:hover, button:hover { background: #fff; color: #000; }
        article {
            margin: 1rem 0;
            padding: 1rem;
            background: #111;
            border: 1px solid #333;
            border-radius: 8px;
        }
        iframe { display: block; max-width: 100%; margin-bottom: 1rem; border: 1px solid #333; }
        form { margin-top: 1rem; }
    </style>
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