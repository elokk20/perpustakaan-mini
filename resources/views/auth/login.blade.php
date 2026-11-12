@extends('layouts.app')

@section('title', 'Masuk — RuangFT.')

@section('content')
<section class="inner-page auth-page">
    <a href="{{ route('buku.index') }}#koleksi" class="back-link">← KEMBALI KE KOLEKSI</a>

    <div class="inner-heading auth-heading">
        <p class="eyebrow">WELCOME BACK TO THE SHELF</p>
        <h1>HELLO, <em>READER.</em></h1>
        <p>Masuk untuk menambah, memperbarui, dan mengelola buku di RuangFT.</p>
    </div>

    <div class="auth-layout">
        <div class="form-surface auth-form-surface">
            <div class="form-topline">
                <span>AKUN / MASUK</span>
                <span>RUANGFT.</span>
            </div>

            <form class="book-form" action="{{ route('login.authenticate') }}" method="POST">
                @csrf

                <div class="field-group">
                    <label for="email">Email <span>*</span></label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        autofocus
                        placeholder="nama@contoh.com"
                        class="@error('email') invalid @enderror"
                    >
                    @error('email')
                        <p class="field-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password">Kata Sandi <span>*</span></label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        required
                        placeholder="Masukkan kata sandi"
                        class="@error('password') invalid @enderror"
                    >
                    @error('password')
                        <p class="field-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <label class="auth-remember" for="remember">
                    <input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya di perangkat ini
                </label>

                <button class="solid-button auth-submit" type="submit">
                    Masuk ke RuangFT. <span aria-hidden="true">→</span>
                </button>
            </form>

            <p class="auth-help">Belum memiliki akun? Hubungi pengelola RuangFT. untuk dibuatkan akun.</p>
        </div>

        <aside class="auth-poster" aria-label="Tentang RuangFT.">
            <span class="auth-poster-kicker">FAKULTAS TEKNIK · UNIVERSITAS HASANUDDIN</span>
            <strong>READ.<br>LEARN.<br><em>GROW.</em></strong>
            <span class="auth-poster-star" aria-hidden="true">✳</span>
            <p>Ruang literasi, inspirasi teknik.</p>
        </aside>
    </div>
</section>
@endsection
