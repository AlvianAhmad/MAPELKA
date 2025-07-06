<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Form Display
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | Authentication Process
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        // Validasi input form login
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);

        // Proses login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Redirect sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'pelatih') {
                return redirect()->route('pelatih.dashboard');
            } elseif ($user->role === 'karyawan') {
                return redirect()->route('karyawan.dashboard');
            }
        }

        // Jika login gagal
        return back()->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /*
    |--------------------------------------------------------------------------
    | Registration Process
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        // Validasi input form registrasi
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:karyawan,pelatih',
        ], [
            'name.required'              => 'Nama wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'email.unique'               => 'Email sudah terdaftar.',
            'password.required'          => 'Password wajib diisi.',
            'password.min'               => 'Password minimal 8 karakter.',
            'password.confirmed'         => 'Konfirmasi password tidak cocok.',
            'role.required'              => 'Role wajib dipilih.',
        ]);

        // Simpan user baru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => $request->role,
        ]);

        // Auto login setelah register
        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'karyawan') {
            return redirect()->route('karyawan.dashboard');
        } elseif ($user->role === 'pelatih') {
            return redirect()->route('pelatih.dashboard');
        }

        // Fallback jika tidak dikenali
        return redirect('/');
    }
}
