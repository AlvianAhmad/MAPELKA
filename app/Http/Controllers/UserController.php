<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Tampilkan Semua Pengguna
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /*
    |--------------------------------------------------------------------------
    | Tambah Pengguna Baru
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|string|in:admin,pelatih,karyawan',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return response()->json($user);
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Data Pengguna Berdasarkan ID
    |--------------------------------------------------------------------------
    */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Pengguna
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|string|in:admin,pelatih,karyawan',
        ]);

        $user->update($request->only(['name', 'email', 'role']));

        return response()->json($user);
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus Pengguna
    |--------------------------------------------------------------------------
    */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
