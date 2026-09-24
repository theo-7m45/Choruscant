<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Choruscant</title>
    <style>
        body {
            background: #000000;
            color: #ffffff;
            font-family: sans-serif;
            margin: 0;
            padding: 2rem;
        }

        h1, h2, p, a, button, input {
            color: #ffffff;
        }

        input {
            background: #111111;
            border: 1px solid #333333;
            color: #ffffff;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
        }

        button {
            background: #111111;
            border: 1px solid #333333;
            color: #ffffff;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            cursor: pointer;
        }

        .star-dot {
            width: 7px;
            height: 7px;
            display: inline-block;
            margin: 0.25rem;
            border-radius: 50%;
            background: #ffffff;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .star-dot:hover {
            transform: scale(1.2);
        }

        .search-link {
            color: #ffffff;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <h1>Choruscant</h1>
    <p>Découvrez et partagez votre musique.</p>
    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Rechercher un utilisateur" required>
        <button type="submit">Rechercher</button>
    </form>

    @isset($query)
        <h2>Résultats pour « {{ $query }} »</h2>
        <a href="{{ url('/') }}" class="search-link">Masquer les résultats</a>
        @if(isset($searchResults) && $searchResults->isNotEmpty())
            @foreach ($searchResults as $user)
                <a
                    href="{{ route('discovery', $user) }}"
                    aria-label="Voir la constellation de {{ $user->name }}"
                    title="Voir la constellation de {{ $user->name }}"
                    class="star-dot"
                ></a>
            @endforeach
        @else
            <p>Aucun utilisateur trouvé pour cette recherche.</p>
        @endif
    @endisset

    <h2>L'univers</h2>
    @foreach ($users as $user)
        <a
            href="{{ route('discovery', $user) }}"
            aria-label="Voir la constellation de {{ $user->name }}"
            title="Voir la constellation de {{ $user->name }}"
            class="star-dot"
        ></a>
    @endforeach

    @guest
        <a href="{{ route('login') }}">Se connecter</a>
        <a href="{{ route('register') }}">Créer un compte</a>
    @endguest

    @auth
        <p>Bonjour {{ auth()->user()->name }}.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
        <a href="{{ route('my-constellation') }}">MyConstellation</a>
    @endauth

    <script>
        document.querySelectorAll('.star-dot').forEach((dot, index) => {
            const baseSize = 4 + (index % 4);
            const randomSize = baseSize + Math.random() * 2;
            const glow = 5 + Math.random() * 5;
            const minOpacity = 0.7;
            const maxOpacity = 1;

            dot.style.width = randomSize + 'px';
            dot.style.height = randomSize + 'px';
            dot.style.opacity = maxOpacity.toFixed(2);
            dot.style.boxShadow = '0 0 ' + glow + 'px rgba(255, 255, 255, ' + maxOpacity + ')';

            const flickerSpeed = 80 + index * 15;
            const flickerDuration = 500;
            const pauseDuration = 1500;

            const startFlicker = () => {
                const flickerStartedAt = Date.now();

                const flicker = () => {
                    if (Date.now() - flickerStartedAt >= flickerDuration) {
                        dot.style.opacity = maxOpacity.toFixed(2);
                        dot.style.boxShadow = '0 0 ' + glow + 'px rgba(255, 255, 255, ' + maxOpacity + ')';
                        setTimeout(startFlicker, pauseDuration);
                        return;
                    }

                    const opacity = minOpacity + Math.random() * (maxOpacity - minOpacity);
                    dot.style.opacity = opacity.toFixed(2);
                    dot.style.boxShadow = '0 0 ' + glow + 'px rgba(255, 255, 255, ' + opacity + ')';
                    setTimeout(flicker, flickerSpeed);
                };

                flicker();
            };

            setTimeout(startFlicker, index * 100);
        });
    </script>
</body>
</html>
