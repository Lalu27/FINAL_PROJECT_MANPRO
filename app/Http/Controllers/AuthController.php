<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Property; // 🌟 WAJIB IMPORT MODEL PROPERTY DI ATAS SINI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * 🌟 TAMBAHAN UTAMA: Menampilkan halaman depan (Landing Page) publik StayFind
     * Maksimal hanya mengambil 8 kost terbaru yang telah diverifikasi admin
     */
    public function land()
    {
        $properties = Property::where('is_approved_by_admin', 1)
                              ->latest()
                              ->take(8)
                              ->get();

        // Mengembalikan tampilan halaman utama sambil melempar variabel data kost riil
        return view('public.home', compact('properties'));
    }

    /**
     * Menampilkan halaman form login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Memproses data autentikasi login pengguna
     */
    public function login(Request $request)
    {
        // 1. Validasi Input form login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Upayakan proses login ke sistem
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'owner') {
                return redirect()->route('owner.dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->intended(route('mahasiswa.dashboard'));
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Menampilkan halaman form registrasi
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Memproses data pendaftaran akun baru StayFind
     */
    public function register(Request $request)
    {
        // 1. Validasi Input Form secara ketat
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:mahasiswa,owner'],
            'foto_ktp_dokumen' => [$request->role === 'owner' ? 'required' : 'nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $pathKtp = null;

        // 2. Jika perannya adalah Owner dan mengunggah dokumen KTP, simpan berkasnya
        if ($request->role === 'owner' && $request->hasFile('foto_ktp_dokumen')) {
            $pathKtp = $request->file('foto_ktp_dokumen')->store('ktp_documents', 'public');
        }

        // 3. Buat entitas data User baru di database
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => $request->role,
            'foto_ktp_dokumen' => $pathKtp,
        ]);

        // 4. Otomatis login-kan user yang baru saja mendaftar
        Auth::login($user);

        $request->session()->regenerate();

        // 5. Alihkan ke dashboard masing-masing secara dinamis sesuai role yang dipilih
        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard')->with('success', 'Akun Owner berhasil dibuat! Silakan tunggu verifikasi admin.');
        }

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Akun berhasil didaftarkan!');
    }

    /**
     * Mengeluarkan pengguna dari sesi aplikasi (Logout)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('public.home');
    }
}