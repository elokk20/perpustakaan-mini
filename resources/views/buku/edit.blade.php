@extends('layouts.app')
@section('title', 'Ubah Buku')
@section('content')
<section class="inner-page">
    <a href="{{ route('buku.index') }}#koleksi" class="back-link">← KEMBALI KE KOLEKSI</a>
    <div class="inner-heading"><p class="eyebrow">MAKE IT A LITTLE BETTER</p><h1>EDIT <em>THIS BOOK.</em></h1><p>Perbarui informasi buku <strong>{{ $buku->judul }}</strong> di bawah ini.</p></div>
    <div class="form-layout"><div class="form-surface"><div class="form-topline"><span>FORM / EDIT</span><span>* WAJIB DIISI</span></div>@include('buku._form')</div><aside class="form-aside"><x-book-cover :buku="$buku" :variant="$buku->id" size="large" /><p>Memperbaiki data juga bagian dari merawat koleksi.</p></aside></div>
</section>
@endsection
