@props(['buku', 'variant' => 1, 'size' => 'standard'])
@php
    $color = (($variant - 1) % 6) + 1;
@endphp
<div {{ $attributes->class(['book-cover', 'cover-v' . $color, 'cover-' . $size]) }} aria-label="Ilustrasi sampul buku {{ $buku->judul }}">
    <div class="cover-mark" aria-hidden="true"><span></span><span></span></div>
    <div class="cover-name">{{ $buku->judul }}</div>
    <div class="cover-line" aria-hidden="true"></div>
    <div class="cover-writer">{{ $buku->penulis }}</div>
</div>
