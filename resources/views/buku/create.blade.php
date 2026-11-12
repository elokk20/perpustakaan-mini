@extends('layouts.app')
@section('title', 'Tambah Buku')
@section('content')
<section class="inner-page">
    <a href="{{ route('buku.index') }}#koleksi" class="back-link">← KEMBALI KE KOLEKSI</a>
    <div class="inner-heading"><p class="eyebrow">A NEW STORY FOR THE SHELF</p><h1>ADD A <em>NEW BOOK.</em></h1><p>Isi informasi buku yang ingin dimasukkan ke Perpustakaan Mini.</p></div>
    <div class="form-layout"><div class="form-surface"><div class="form-topline"><span>FORM / 01</span><span>* WAJIB DIISI</span></div>@include('buku._form')</div><aside class="form-aside"><div class="poster-book"><small>YOUR NEXT<br>FAVORITE READ</small><strong>BOOK<br>CLUB.</strong><span>✳</span></div><p>“Satu buku, seribu cerita.”</p></aside></div>
</section>
@endsection
