<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyConstellation - Choruscant</title>
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
        h1 { margin-bottom: 0.5rem; }
        form { margin: 1rem 0 2rem; }
        input {
            width: min(100%, 360px);
            margin: 0.35rem 0;
            padding: 0.7rem;
            background: #111;
            border: 1px solid #555;
            border-radius: 6px;
            color: #fff;
        }
        button, a {
            color: #fff;
            font: inherit;
        }
        button, a {
            display: inline-block;
            padding: 0.65rem 1rem;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }
        button:hover, a:hover { background: #fff; color: #000; }
        article {
            margin: 1rem 0;
            padding: 1rem;
            background: #111;
            border: 1px solid #333;
            border-radius: 8px;
        }
        iframe { display: block; max-width: 100%; margin-bottom: 1rem; border: 1px solid #333; }
        article form { display: inline-block; margin: 0 0 0 0.5rem; }
    </style>
</head>
<body>
    <h1>MyConstellation</h1>
    <p>Bienvenue dans ta constellation musicale, {{ $user->name }}.</p>

        <h2>Ajouter une musique</h2>
        
    <form action="{{ route('musics.store') }}" method="POST">
        @csrf

        <input type="text" name="title" placeholder="Titre" required>

        <input
            type="text"
            name="youtube_video_id"
            placeholder="Identifiant YouTube"
            required
        >

        <button type="submit">Ajouter</button>
    </form>

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
            <a href="{{ route('musics.edit', $music) }}">
                Modifier
            </a>
            <form action="{{ route('musics.delete', $music) }}" method="POST">
                @csrf
                <button type="submit">Supprimer</button>
            </form>
        </article>
    @empty
        <p>Tu n'as pas encore ajouté de musique.</p>
    @endforelse

    <a href="{{ route('/') }}">Retour à l'accueil</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
</body>
</html>
