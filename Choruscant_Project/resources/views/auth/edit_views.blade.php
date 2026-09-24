<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier une musique - Choruscant</title>
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
            width: min(100%, 520px);
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
        button, a {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.65rem 1rem;
            background: transparent;
            border: 1px solid #fff;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
        }
        button:hover, a:hover { background: #fff; color: #000; }
        li { color: #ffb4b4; margin-bottom: 0.35rem; }
    </style>
</head>
<body>
    <h1>Modifier une musique</h1>

    <form action="{{ route('musics.update', $music) }}" method="POST">
        @csrf

        <label for="title">Titre</label>
        <input id="title" type="text" name="title" value="{{ old('title', $music->title) }}" required>

        <label for="youtube_video_id">Identifiant YouTube</label>
        <input id="youtube_video_id" type="text" name="youtube_video_id" value="{{ old('youtube_video_id', $music->youtube_video_id) }}" required>

        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <button type="submit">Enregistrer</button>
    </form>

    <a href="{{ route('MyConstellation') }}">Annuler</a>
</body>
</html>
