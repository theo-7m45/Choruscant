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

/* =========================
   ÉTOILE
   ========================= */

.star-dot {
    width: 7px;
    height: 7px;
    display: inline-block;
    position: relative;
    margin: 0.25rem;
    border-radius: 50%;

    /* Centre blanc parfaitement net */
    background: #ffffff;

    border: none;
    box-sizing: border-box;
    text-decoration: none;

    /* Important : permet aux halos de dépasser */
    z-index: 1;

    transition: transform 0.2s ease;

    /* Très légère lueur autour du point */
    box-shadow:
        0 0 2px rgba(255, 255, 255, 0.9);
}

/* =========================
   GRAND HALO DIFFUS
   ========================= */

.star-dot::before {
    content: '';
    position: absolute;

    top: 50%;
    left: 50%;

    width: 55px;
    height: 55px;

    transform: translate(-50%, -50%);

    border-radius: 50%;

    /* Intensité du grand halo */
    background: rgba(255, 255, 255, 0.12);

    /* Plus le blur est grand, plus le halo est doux */
    filter: blur(18px);

    z-index: -1;

    pointer-events: none;
}

/* =========================
   PETIT HALO AUTOUR DU POINT
   ========================= */

.star-dot::after {
    content: '';
    position: absolute;

    top: 50%;
    left: 50%;

    width: 18px;
    height: 18px;

    transform: translate(-50%, -50%);

    border-radius: 50%;

    background: rgba(255, 255, 255, 0.20);

    filter: blur(5px);

    z-index: -1;

    pointer-events: none;
}

/* =========================
   HOVER
   ========================= */

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
    <p>Découvre et diffuse ta musique à travers tout l'univers</p>
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
        document.querySelectorAll('.star-dot').forEach((star, index) => {
            if (index % 3 !== 0) {
                return;
            }

            const size = 5 + (index % 4) + Math.random() * 2;
            const repeatCount = 3 + Math.floor(Math.random() * 5);
            let count = 0;

            star.style.width = size + 'px';
            star.style.height = size + 'px';

            const flicker = () => {
                if (count >= repeatCount) {
                    star.style.width = size + 'px';
                    star.style.height = size + 'px';
                    star.style.opacity = '1';
                    count = 0;
                    setTimeout(flicker, 3000 + Math.random() * 3000);
                    return;
                }

                const opacity = 0.7 + Math.random() * 0.3;
                const flickerSize = size * (0.55 + opacity * 0.45);

                star.style.width = flickerSize + 'px';
                star.style.height = flickerSize + 'px';
                star.style.opacity = opacity.toFixed(2);
                count++;
                setTimeout(flicker, 180 + Math.random() * 120);
            };

            setTimeout(flicker, index * 350 + Math.random() * 800);
        });

        const universeTitle = [...document.querySelectorAll('h2')]
            .find((title) => title.textContent.trim() === "L'univers");

        if (universeTitle) {
            const universeStars = [];
            let nextElement = universeTitle.nextElementSibling;

            while (nextElement?.matches('.star-dot')) {
                universeStars.push(nextElement);
                nextElement = nextElement.nextElementSibling;
            }

            if (universeStars.length) {
                const field = document.createElement('div');
                const spacing = 75;
                let fieldHeight = Math.max(260, Math.ceil(Math.sqrt(universeStars.length)) * 100);
                const positions = [];

                field.style.position = 'relative';
                field.style.width = '100%';
                field.style.height = fieldHeight + 'px';
                field.style.margin = '1rem 0';
                universeTitle.after(field);

                universeStars.forEach((star) => field.append(star));

                universeStars.forEach((star) => {
                    let position;

                    do {
                        position = {
                            x: spacing / 2 + Math.random() * (field.clientWidth - spacing),
                            y: spacing / 2 + Math.random() * (fieldHeight - spacing)
                        };

                        if (positions.every((other) => {
                            const distance = Math.hypot(position.x - other.x, position.y - other.y);
                            return distance >= spacing;
                        })) {
                            break;
                        }

                        fieldHeight += 100;
                        field.style.height = fieldHeight + 'px';
                    } while (true);

                    positions.push(position);
                    star.style.position = 'absolute';
                    star.style.margin = '0';
                    star.style.left = position.x + 'px';
                    star.style.top = position.y + 'px';
                });
            }
        }
    </script>
</body>
</html>
