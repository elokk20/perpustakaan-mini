<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['judul' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'tahun_terbit' => 2005,
             'sinopsis' => 'Kisah persahabatan dan perjuangan anak-anak Belitung dalam meraih pendidikan dan cita-cita.'],
            ['judul' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'tahun_terbit' => 1980,
             'sinopsis' => 'Kisah Minke dan pergulatannya dengan cinta, pendidikan, serta ketidakadilan pada masa kolonial.'],
            ['judul' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'tahun_terbit' => 2009,
             'sinopsis' => 'Perjalanan enam sahabat di sebuah pesantren yang percaya pada kekuatan mimpi dan kerja keras.'],
            ['judul' => 'Ronggeng Dukuh Paruk', 'penulis' => 'Ahmad Tohari', 'tahun_terbit' => 1982,
             'sinopsis' => 'Kehidupan Srintil dan masyarakat Dukuh Paruk di tengah tradisi dan perubahan sosial.'],
            ['judul' => 'Cantik Itu Luka', 'penulis' => 'Eka Kurniawan', 'tahun_terbit' => 2002,
             'sinopsis' => 'Sebuah kisah lintas generasi yang memadukan sejarah, keluarga, dan realisme magis.'],
            ['judul' => 'Pulang', 'penulis' => 'Leila S. Chudori', 'tahun_terbit' => 2012,
             'sinopsis' => 'Cerita tentang keluarga, persahabatan, identitas, dan kerinduan terhadap tanah air.'],
        ];

        foreach ($books as $book) {
            Buku::firstOrCreate(['judul' => $book['judul']], $book);
        }
    }
}
