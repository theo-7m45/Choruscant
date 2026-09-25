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
            min-height: 100vh;
            position: relative; /* Nécessaire pour la barre de recherche fixée en bas */
        }

        h1, h2, p, a, button, input {
            color: #ffffff;
        }

        /* =========================
           NAVIGATION HAUT (LOGO & BOUTONS)
           ========================= */
        .top-nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 3rem; /* Espace entre les boutons et le logo */
            margin-bottom: 4rem;
        }

        .logo {
            height: 70px; 
            width: auto;
        }

        /* Boutons globaux */
        .btn {
            padding: 0.6rem 2.5rem;
            border-radius: 6px;
            font-size: 1rem;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            display: inline-block;
            transition: all 0.2s ease;
        }

        /* Bouton d'inscription (contour blanc) */
        .btn-outline {
            background: transparent;
            border: 1px solid #ffffff;
            color: #ffffff;
        }
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Bouton de connexion */
        .btn-primary {
            background: #6a329f; 
            border: 1px solid #6a329f;
            color: #ffffff;
        }
        .btn-primary:hover {
            background: #7d3eb8;
        }

        /* =========================
           BARRE DE RECHERCHE EN BAS
           ========================= */
        .search-container {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            width: 400px;
            max-width: 90%;
            z-index: 10;
        }

        .search-form {
            display: flex;
            align-items: center;
            background: #000000;
            border: 1px solid #ffffff;
            border-radius: 8px;
            padding: 0.3rem 0.5rem;
        }

        .search-input {
            background: transparent;
            border: none;
            color: #ffffff;
            flex-grow: 1;
            padding: 0.5rem;
            outline: none;
        }

        .search-input::placeholder {
            color: #aaaaaa;
        }

        .search-btn {
            background: transparent;
            border: none;
            color: #ffffff;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
       
        .search-btn svg {
            width: 20px;
            height: 20px;
            fill: #ffffff;
        }

        /* =========================
           ÉTOILES
           ========================= */
        .star-dot {
            width: 7px;
            height: 7px;
            display: inline-block;
            position: relative;
            margin: 0.25rem;
            border-radius: 50%;
            background: #ffffff;
            border: none;
            box-sizing: border-box;
            text-decoration: none;
            z-index: 1;
            transition: transform 0.2s ease;
            box-shadow: 0 0 2px rgba(255, 255, 255, 0.9);
        }

        .star-dot::before {
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
            z-index: -1;
            pointer-events: none;
        }

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

        .star-dot:hover {
            transform: scale(1.2);
        }

        .search-link {
            background: transparent;
            border: 1px solid #ffffff;
            color: #ffffff;
            text-decoration: none;
            display: inline-block;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            margin-right: 0.5rem;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .search-link:hover {
            background: #ffffff;
            color: #000000;
        }
    </style>
</head>
<body>

    <!-- Barre de navigation supérieure (Boutons + Logo) -->
    <nav class="top-nav">
        @guest
            <a href="{{ route('register') }}" class="btn btn-outline">Sign up</a>
           
            <img src="{{ asset('images/logo.png') }}" alt="Choruscant Logo" class="logo">
           
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endguest

        @auth
            <a href="{{ route('my-constellation') }}" class="btn btn-outline">MyConstellation</a>
           
            <img src="{{ asset('images/logo.png') }}" alt="Choruscant Logo" class="logo">
           
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline">Se déconnecter</button>
            </form>
        @endauth
    </nav>

    <!-- Contenu Principal -->
    <h1 style="display:none;">Choruscant</h1> <!-- Masqué visuellement mais gardé pour le SEO/Structure si besoin -->
    <p style="text-align:center; color:#aaaaaa;">Découvre et diffuse ta musique à travers tout l'univers</p>

    @auth
        <p style="text-align:center;">Bonjour {{ auth()->user()->name }}.</p>
    @endauth

    @isset($query)
        <h2>Résultats pour « {{ $query }} »</h2>
        <a href="{{ url('/') }}" class="search-link">Masquer les résultats</a>
        @if(isset($searchResults) && $searchResults->isNotEmpty())
            @foreach ($searchResults as $user)
                <a href="{{ route('discovery', $user) }}" aria-label="Voir la constellation de {{ $user->name }}" title="Voir la constellation de {{ $user->name }}" class="star-dot"></a>
            @endforeach
        @else
            <p>Aucun utilisateur trouvé pour cette recherche.</p>
        @endif
    @endisset

    <h2>L'univers</h2>
    @foreach ($users as $user)
        <a href="{{ route('discovery', $user) }}" aria-label="Voir la constellation de {{ $user->name }}" title="Voir la constellation de {{ $user->name }}" class="star-dot"></a>
    @endforeach

    <!-- Barre de recherche flottante en bas à gauche -->
    <div class="search-container">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Rechercher une constellation ..." required class="search-input">
            <button type="submit" class="search-btn">
                <!-- Icône SVG Loupe -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 144 0 1 0 0-288 144 144 144 0 1 0 0 288z"/>
                </svg>
            </button>
        </form>
    </div>

    <!-- Script des étoiles -->

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