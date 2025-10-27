{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNI Bookstore</title>
    {{-- CDN Bootstrap & Font Awesome dari header.php lama --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- CSS Kustom --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <header>
        <div class="header-container">
            {{-- Menggunakan route() untuk link yang benar --}}
            <a href="{{ url('/') }}" class="logo"><h1>📚 UNI Bookstore</h1></a>
            <nav>
                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/admin') }}" class="{{ Request::is('admin*') ? 'active' : '' }}">Admin</a>
                <a href="{{ url('/pengadaan') }}" class="{{ Request::is('pengadaan') ? 'active' : '' }}">Pengadaan</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content') {{-- Konten halaman spesifik (index/admin/pengadaan) masuk di sini --}}
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} UNI Bookstore. All rights reserved.</p>
    </footer>
    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- JS Kustom --}}
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
</body>
</html>
<!--
