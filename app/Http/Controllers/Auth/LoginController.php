<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Pastikan viewnya ada di resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required', // Bisa email atau NISN
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->username,
            'password' => $request->password
        ];

        // Cek apakah login sebagai admin (pakai email)
        $user = User::where('email', $request->username)->first();

        if ($user && $user->role === 'admin') {
            if (Auth::attempt($credentials)) {
                return redirect()->route('admin.dashboard');
            } else {
                return back()->with('error', 'Password salah untuk Admin.');
            }
        }

        // Cek apakah login sebagai siswa (pakai NISN)
        $user = User::where('nisn', $request->username)->where('role', 'siswa')->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('siswa.dashboard_siswa');
            } else {
                return back()->with('error', 'Password salah untuk Siswa.');
            }
        }

        return back()->with('error', 'Akun tidak ditemukan.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}


