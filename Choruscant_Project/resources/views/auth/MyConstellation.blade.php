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
        .music-star {
            position: absolute;
            width: 10px;
            height: 10px;
            margin: 1.5rem;
            padding: 0;
            border: 0;
            border-radius: 50%;
            background: #fff;
            z-index: 1;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.9);
        }
        .music-star::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 55px;
            height: 55px;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            filter: blur(18px);
            pointer-events: none;
            z-index: -1;
        }
        .music-star:hover { transform: scale(1.25); }
        .music-star[aria-expanded="true"] { box-shadow: 0 0 14px #fff; }
        article[hidden] { display: none; }
        .music-field {
            position: relative;
            width: 100%;
            min-height: 260px;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <h1>MyConstellation</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

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
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
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

    <script>
        const musicField = document.createElement('div');
        const musicStars = [];

        document.querySelectorAll('article').forEach((article) => {
            const star = document.createElement('button');
            star.type = 'button';
            star.className = 'music-star';
            star.setAttribute('aria-expanded', 'false');
            star.setAttribute('aria-label', 'Afficher la musique');
            article.hidden = true;
            musicStars.push(star);

            star.addEventListener('click', () => {
                const isOpen = !article.hidden;
                article.hidden = isOpen;
                star.setAttribute('aria-expanded', String(!isOpen));
            });
        });

        if (musicStars.length) {
            const spacing = 75;
            let fieldHeight = Math.max(260, Math.ceil(Math.sqrt(musicStars.length)) * 100);
            const positions = [];

            musicField.className = 'music-field';
            musicField.style.height = fieldHeight + 'px';
            document.querySelector('article').before(musicField);
            musicStars.forEach((star) => musicField.append(star));

            musicStars.forEach((star) => {
                let position;

                do {
                    position = {
                        x: spacing / 2 + Math.random() * (musicField.clientWidth - spacing),
                        y: spacing / 2 + Math.random() * (fieldHeight - spacing)
                    };

                    if (positions.every((other) => Math.hypot(position.x - other.x, position.y - other.y) >= spacing)) {
                        break;
                    }

                    fieldHeight += 100;
                    musicField.style.height = fieldHeight + 'px';
                } while (true);

                positions.push(position);
                star.style.left = position.x + 'px';
                star.style.top = position.y + 'px';
            });
        }
    </script>
</body>
</html>
