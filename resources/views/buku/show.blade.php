@extends('layouts.app')
@section('title', $buku->judul)
@section('content')
<section class="inner-page">
    <a href="{{ route('buku.index') }}#koleksi" class="back-link">← KEMBALI KE KOLEKSI</a>
    <div class="inner-heading"><p class="eyebrow">GET TO KNOW THE BOOK</p><h1>THE <em>BOOK DETAILS.</em></h1></div>
    <div class="detail-layout">
        <div class="detail-art"><x-book-cover :buku="$buku" :variant="$buku->id" size="large" /><span>THE BOOKSHELF / {{ str_pad((string) $buku->id, 2, '0', STR_PAD_LEFT) }}</span></div>
        <div class="detail-info"><span class="detail-label">{{ $buku->tahun_terbit }} / COLLECTION</span><h2>{{ $buku->judul }}</h2><p class="detail-author">Ditulis oleh <strong>{{ $buku->penulis }}</strong></p>
        @if ($buku->penerbit)
            <p class="detail-author">
                Diterbitkan oleh
            <strong>{{ $buku->penerbit }}</strong>
            </p>
        @endif
        <div class="detail-rule"></div><h3>TENTANG BUKU INI</h3><p class="synopsis">{{ $buku->sinopsis ?: 'Belum ada sinopsis.' }}</p>
        @auth
            <div class="detail-buttons"><a class="solid-button" href="{{ route('buku.edit', $buku) }}">Ubah Data Buku <span>→</span></a><form method="POST" action="{{ route('buku.destroy', $buku) }}" onsubmit="return confirm('Yakin hapus buku ini?');">@csrf @method('DELETE')<button type="submit" class="delete-outline">Hapus Buku</button></form></div></div>
        @endauth
    </div>
</section>
@endsection
