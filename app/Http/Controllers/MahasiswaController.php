<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        return view('mahasiswa.index', [
            'mahasiswa' => Mahasiswa::orderBy('nama_mahasiswa')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('mahasiswa.create');
    }

    public function store(MahasiswaRequest $request): RedirectResponse
    {
        Mahasiswa::create($request->validated());

        return to_route('mahasiswa.index')->with('status', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->update($request->validated());

        return to_route('mahasiswa.index')->with('status', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();

        return to_route('mahasiswa.index')->with('status', 'Data mahasiswa berhasil dihapus.');
    }
}
