<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function index(Request $request): View
    {
        $cari = trim((string) $request->query('cari', ''));

        $bukus = Buku::query()
            ->when($cari !== '', function ($query) use ($cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('judul', 'like', '%' . $cari . '%')
                      ->orWhere('penulis', 'like', '%' . $cari . '%');
                });
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(5)
            ->withQueryString();

        return view('buku.index', compact('bukus', 'cari'));
    }

    public function create(): View
    {
        return view('buku.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Buku::create($this->validateBook($request));

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku): View
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku): View
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $buku->update($this->validateBook($request));

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
    private function validateBook(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['required', 'string', 'max:255'],
            'tahun_terbit' => ['required', 'integer', 'min:1000', 'max:' . date('Y')],
            'penerbit' => ['nullable', 'string', 'max:255'],
            'sinopsis' => ['nullable', 'string'],
        ], [
            'judul.required' => 'Judul buku wajib diisi.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka bulat.',
            'tahun_terbit.min' => 'Tahun terbit minimal tahun 1000.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun sekarang.',

            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute tidak boleh melebihi :max karakter.',
        ], [
            'judul' => 'Judul buku',
            'penulis' => 'Nama penulis',
            'tahun_terbit' => 'Tahun terbit',
            'penerbit' => 'Penerbit',
            'sinopsis' => 'Sinopsis',
        ]);
    }
}
