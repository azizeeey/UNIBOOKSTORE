<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI Bookstore</title>
    <link rel="icon" href="/assets/img/unibookstore.png" type="image/png">
    {{-- CDN Bootstrap & Font Awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS Kustom --}}
    <link rel="stylesheet" href="/assets/css/style.css">
    @yield('styles')
    <style>
    /* Basic Hamburger Menu Styling */
    .hamburger {
        display: none;
        background: none;
        border: none;
        color: #333;
        font-size: 24px;
        cursor: pointer;
    }

    /* Responsive Navbar */
    @media (max-width: 768px) {
        .header-container {
            justify-content: space-between;
        }
        .main-nav {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 60px; /* Adjust based on header height */
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .main-nav.is-active {
            display: flex;
        }
        .main-nav a {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #f0f0f0;
        }
        .hamburger {
            display: block;
        }
    }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="{{ url('/') }}" class="logo"><h1>📚 UNI Bookstore</h1></a>
            <button class="hamburger" id="hamburger-menu" aria-label="Toggle menu">
                <i class="fas fa-bars"></i>
            </button>
            <nav class="main-nav" id="main-nav">
                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/admin') }}" class="{{ Request::is('admin*') ? 'active' : '' }}">Admin</a>
                <a href="{{ url('/pengadaan') }}" class="{{ Request::is('pengadaan') ? 'active' : '' }}">Pengadaan</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} UNI Bookstore. All rights reserved.</p>
    </footer>
    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- JS Kustom --}}
    <script src="/assets/js/script.js" defer></script>
    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger-menu');
            if (hamburger) {
                hamburger.addEventListener('click', function() {
                    document.getElementById('main-nav').classList.toggle('is-active');
                });
            }
        });
    </script>
</body>
</html>
<!--
