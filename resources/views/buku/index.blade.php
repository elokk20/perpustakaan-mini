@extends('layouts.app')
@section('title', 'Koleksi Buku')

@section('content')
<section class="hero" aria-labelledby="hero-title">
    <div class="hero-copy">
        <p class="eyebrow"><span class="tiny-sun">✳</span> Baca. Temukan. Simpan ceritanya.</p>
        <h1 id="hero-title">WHAT <em>BOOK</em><br>ARE YOU<br>LOOKING <em>FOR?</em></h1>
        <p class="hero-description">Koleksi buku penuh cerita, dari penulis yang kamu suka. Cari, jelajahi, dan kelola semuanya dalam satu tempat.</p>
        <a class="split-button" href="#koleksi"><span>Jelajahi Koleksi</span><strong aria-hidden="true">→</strong></a>
        <div class="hero-note"><span class="avatar-stack" aria-hidden="true"><i>↗</i><i>✳</i><i>✿</i></span><p>Koleksi yang selalu<br>punya cerita baru.</p></div>
    </div>
    <div class="hero-art" aria-hidden="true">
        <div class="art-book book-one"><small>SEBUAH CERITA<br>UNTUK DIKENANG</small><b>JENDELA<br>DUNIA</b><span class="abstract-eye">◉</span><small>EDISI PILIHAN</small></div>
        <div class="art-book book-two"><small>CURATED COLLECTION</small><b>BOOKS<br>& IDEAS</b><span class="abstract-spark">✳</span><small>READ MORE. DISCOVER MORE.</small></div>
        <div class="star-badge"><strong>100%</strong><span>Stories</span></div>
        <div class="art-caption">OUR COLLECTION <span>↗</span></div>
    </div>
</section>
<div class="color-stairs" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>

<section class="collection-section" id="koleksi" aria-labelledby="collection-title">
    <div class="section-pretitle"><span>01 / THE BOOKSHELF</span><span>PERPUSTAKAAN MINI — EST. 2026</span></div>
    <div class="collection-head">
        <div><p class="eyebrow">A LITTLE LIBRARY, A LOT OF STORIES</p><h2 id="collection-title">OUR <em>BOOK</em> COLLECTION</h2></div>
        <p class="collection-intro">Temukan bacaan yang menarik. Semua buku dapat dilihat, ditambahkan, diedit, dan dihapus.</p>
    </div>
    <div class="collection-layout">
        <aside class="collection-sidebar">
            <h3>EXPLORE <em>MORE</em></h3>
            <p>Ingin mencari buku tertentu? Coba cari berdasarkan judul atau nama penulis.</p>
            <div class="side-links" aria-label="Contoh pencarian cepat">
                <a href="{{ route('buku.index') }}#koleksi" class="{{ $cari === '' ? 'active' : '' }}">Semua Buku <span>↗</span></a>
                <a href="{{ route('buku.index', ['cari' => 'Ahmad']) }}#koleksi">Penulis: Ahmad <span>↗</span></a>
                <a href="{{ route('buku.index', ['cari' => 'Bumi']) }}#koleksi">Judul: Bumi <span>↗</span></a>
                <a href="{{ route('buku.index', ['cari' => 'Pulang']) }}#koleksi">Judul: Pulang <span>↗</span></a>
            </div>
            <div class="sidebar-note"><span>✳</span><b>EVERY BOOK<br>HAS A STORY.</b><p>Tambahkan buku baru agar koleksinya semakin beragam.</p></div>
        </aside>
        <div class="catalog-panel">
            <form action="{{ route('buku.index') }}#koleksi" method="GET" class="search-bar" role="search">
                <label for="cari" class="sr-only">Cari buku berdasarkan judul atau penulis</label>
                <input id="cari" name="cari" type="search" value="{{ $cari }}" placeholder="Cari judul atau penulis..." />
                <button type="submit">Cari <span aria-hidden="true">→</span></button>
            </form>
            <div class="catalog-subheader"><span>{{ $bukus->total() }} BUKU DITEMUKAN</span><span>5 BUKU / HALAMAN</span></div>
            @if ($bukus->count())
                <div class="books-grid">
                    @foreach ($bukus as $buku)
                    <article class="book-item">
                        <a class="book-image-link" href="{{ route('buku.show', $buku) }}" aria-label="Lihat detail {{ $buku->judul }}">
                            <x-book-cover :buku="$buku" :variant="$buku->id" />
                        </a>
                        <div class="book-meta">
                            <span class="book-year">{{ $buku->tahun_terbit }}</span>
                            <h3><a href="{{ route('buku.show', $buku) }}">{{ $buku->judul }}</a></h3>
                            <p>{{ $buku->penulis }}</p>
                            @if ($buku->penerbit)
                                <p>Penerbit: {{ $buku->penerbit }}</p>
                            @endif
                            <div class="book-actions">
                                <a href="{{ route('buku.show', $buku) }}">Detail ↗</a>
                                @auth
                                    <a href="{{ route('buku.edit', $buku) }}">Ubah</a>
                                    <form action="{{ route('buku.destroy', $buku) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Hapus</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="catalog-pagination">{{ $bukus->fragment('koleksi')->onEachSide(1)->links() }}</div>
            @else
                <div class="empty-books"><span>✳</span><h3>{{ $cari !== '' ? 'BUKU TIDAK DITEMUKAN' : 'BELUM ADA BUKU' }}</h3><p>{{ $cari !== '' ? 'Coba kata kunci lain atau tampilkan semua buku.' : 'Mulai koleksimu dengan menambahkan satu buku.' }}</p><a href="{{ $cari !== '' ? route('buku.index') . '#koleksi' : route('buku.create') }}">{{ $cari !== '' ? 'Lihat Semua Buku' : 'Tambah Buku' }} →</a></div>
            @endif
        </div>
    </div>
</section>
<section class="bottom-promo">
    <div><p>YOUR NEXT CHAPTER STARTS HERE</p><h2>THE BEST STORIES<br>ARE <em>YET TO COME.</em></h2></div>
    <a class="split-button" href="{{ route('buku.create') }}"><span>Tambah Buku</span><strong>→</strong></a>
    <div class="promo-orbit" aria-hidden="true">✳</div>
</section>
@endsection
