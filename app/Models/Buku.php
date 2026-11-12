<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    // PRD menggunakan nama tabel 'buku', bukan 'bukus'.
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'penulis',
        'tahun_terbit',
        'sinopsis',
        'penerbit',
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
    ];
}
