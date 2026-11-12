@php $editing = isset($buku); @endphp
<form class="book-form" method="POST" action="{{ $editing ? route('buku.update', $buku) : route('buku.store') }}">
    @csrf
    @if ($editing) @method('PUT') @endif
    <div class="field-group">
        <label for="judul">Judul Buku <span>*</span></label>
        <input id="judul" name="judul" type="text" maxlength="255" required value="{{ old('judul', $buku->judul ?? '') }}" placeholder="Contoh: Laskar Pelangi" class="@error('judul') invalid @enderror">
        @error('judul')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field-group">
        <label for="penulis">Nama Penulis <span>*</span></label>
        <input id="penulis" name="penulis" type="text" maxlength="255" required value="{{ old('penulis', $buku->penulis ?? '') }}" placeholder="Contoh: Andrea Hirata" class="@error('penulis') invalid @enderror">
        @error('penulis')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="field-group">
        <label for="tahun_terbit">Tahun Terbit <span>*</span></label>
        <input id="tahun_terbit" name="tahun_terbit" type="number" min="1000" max="{{ date('Y') }}" required value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}" placeholder="Contoh: 2005" class="@error('tahun_terbit') invalid @enderror">
        @error('tahun_terbit')<p class="field-error">{{ $message }}</p>@enderror
    </div>

    <div class="field-group">
        <label for="penerbit">
            Penerbit <small>(opsional)</small>
        </label>

        <input
            id="penerbit"
            name="penerbit"
            type="text"
            maxlength="255"
            value="{{ old('penerbit', $buku->penerbit ?? '') }}"
            placeholder="Contoh: Gramedia Pustaka Utama"
            class="@error('penerbit') invalid @enderror">

        @error('penerbit')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>
    <div class="field-group">
        <label for="sinopsis">Sinopsis <small>(opsional)</small></label>
        <textarea id="sinopsis" name="sinopsis" rows="6" placeholder="Tulis ringkasan ceritanya di sini..." class="@error('sinopsis') invalid @enderror">{{ old('sinopsis', $buku->sinopsis ?? '') }}</textarea>
        @error('sinopsis')<p class="field-error">{{ $message }}</p>@enderror
    </div>
    <div class="form-buttons"><button class="solid-button" type="submit">{{ $editing ? 'Simpan Perubahan' : 'Simpan Buku' }} <span>→</span></button><a href="{{ route('buku.index') }}#koleksi" class="text-button">Batal</a></div>
</form>
