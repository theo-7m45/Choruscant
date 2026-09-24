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
        .music-star {
            position: relative;
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
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
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

    <script>
        document.querySelectorAll('article').forEach((article) => {
            const star = document.createElement('button');
            star.type = 'button';
            star.className = 'music-star';
            star.setAttribute('aria-expanded', 'false');
            star.setAttribute('aria-label', 'Afficher la musique');
            article.hidden = true;
            article.parentNode.insertBefore(star, article);

            star.addEventListener('click', () => {
                const isOpen = !article.hidden;
                article.hidden = isOpen;
                star.setAttribute('aria-expanded', String(!isOpen));
            });
        });
    </script>
</body>
</html>