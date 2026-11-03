<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class UserController extends Controller
{
    /**
     * Menampilkan semua data user.
     */
    public function index()
    {
        $users = User::all(); // Terapkan User::all()
        return view('admin.user.index', compact('users')); // Tampilkan view admin.user.index
    }

    /**
     * Menampilkan form tambah user.
     */
    public function create()
    {
        return view('admin.user.create'); // Tampilkan view admin.user.create
    }

    /**
     * Menyimpan data user baru ke database[cite: 1].
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password); // Gunakan Hash::make() untuk enkripsi password[cite: 1]

        User::create($data); // Terapkan User::create($data)[cite: 1]

        return redirect()->route('user.index')->with('success', 'Data User berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit user berdasarkan ID[cite: 1].
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Terapkan User::findOrFail($id)[cite: 1]
        return view('admin.user.edit', compact('user')); // Tampilkan view admin.user.edit[cite: 1]
    }

    /**
     * Memperbarui data user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data User berhasil diperbarui!');
    }

    /**
     * Menghapus data user[cite: 1].
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Terapkan $user->delete()[cite: 1]

        return redirect()->route('user.index')->with('success', 'Data User berhasil dihapus!');
    }
}
