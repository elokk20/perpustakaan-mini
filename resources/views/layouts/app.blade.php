<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Perpustakaan Mini: kelola dan temukan koleksi buku favoritmu.">
    <title>@yield('title', 'Perpustakaan Mini') - RuangFT.</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="site-shell">
    <header class="site-header">
        <a class="logo" href="{{ route('buku.index') }}" aria-label="RuangFT. — beranda">Ruang<span>FT.</span></a>

        <nav class="main-nav" aria-label="Navigasi utama">
            <a href="{{ route('buku.index') }}" class="{{ request()->routeIs('buku.index') ? 'is-current' : '' }}">Beranda</a>
            <a href="{{ route('buku.index') }}#koleksi">Koleksi</a>
            @auth
                <a href="{{ route('buku.create') }}" class="{{ request()->routeIs('buku.create') ? 'is-current' : '' }}">Tambah Buku</a>
            @endauth
        </nav>

        <div class="nav-auth">
            @auth
                <span class="nav-auth-user" title="{{ auth()->user()->name }}">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-logout-button">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-auth-link">Masuk</a>
            @endauth
        </div>
    </header>

        @if (session('success'))
            <div class="flash-notice" role="status">
                <span class="flash-dot" aria-hidden="true"></span>
                {{ session('success') }}
            </div>
        @endif

        <main>
            @yield('content')
        </main>

        <footer class="site-footer">
            <div class="footer-ribbon" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
            <div class="footer-inner">
                <a class="logo" href="{{ route('buku.index') }}">Ruang<span>FT.</span></a>
                <p>RuangFT. - Ruang Literasi Fakultas Teknik Universitas Hasanuddin.</p>
                <a href="{{ route('buku.index') }}#koleksi">Kembali ke koleksi ↑</a>
            </div>
        </footer>
    </div>
</body>
</html>
