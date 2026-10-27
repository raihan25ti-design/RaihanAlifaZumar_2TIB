<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Menampilkan daftar semua portofolio.
     */
    public function index()
    {
        $dataPortofolio = Portofolio::all();
        return view('admin.portofolio.index', compact('dataPortofolio'));
    }

    /**
     * Menampilkan form untuk menambah portofolio baru.
     */
    public function create()
    {
        return view('admin.portofolio.create');
    }

    /**
     * Menyimpan data portofolio baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'link'        => 'nullable|url',
        ], [
            'title.required'       => 'Judul portofolio wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'link.url'             => 'Format link tidak valid (harus diawali http:// atau https://).',
        ]);

        Portofolio::create([
            'title'       => $request->title,
            'description' => $request->description,
            'link'        => $request->link,
        ]);

        return redirect()->route('portofolio.index')->with('success', 'Data portofolio berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail halaman CV/Profil portofolio.
     */
    public function show($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return view('admin.portofolio.show', compact('portofolio'));
    }

    /**
     * Menampilkan form untuk mengedit portofolio.
     */
    public function edit($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return view('admin.portofolio.edit', compact('portofolio'));
    }

    /**
     * Memperbarui data portofolio di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'link'        => 'nullable|url',
        ], [
            'title.required'       => 'Judul portofolio wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'link.url'             => 'Format link tidak valid.',
        ]);

        $portofolio = Portofolio::findOrFail($id);
        $portofolio->update([
            'title'       => $request->title,
            'description' => $request->description,
            'link'        => $request->link,
        ]);

        return redirect()->route('portofolio.index')->with('success', 'Data portofolio berhasil diperbarui!');
    }

    /**
     * Menghapus data portofolio dari database.
     */
    public function destroy($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $portofolio->delete();

        return redirect()->route('portofolio.index')->with('success', 'Data portofolio berhasil dihapus!');
    }
}