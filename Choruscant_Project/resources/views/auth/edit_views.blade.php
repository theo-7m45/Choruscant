<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier une musique - Choruscant</title>
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
