<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mews\Captcha\Facades\Captcha;

//models
use App\Models\User;

class LoginController
{
    use AuthenticatesUsers;

    // Mengarahkan setelah login
    protected $redirectTo = '/dashboard';

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Mengatur nama pengguna sebagai field yang digunakan untuk login
    public function username()
    {
        return 'username';
    }

    // Memberikan pesan flash setelah logout
    protected function loggedOut(Request $request)
    {
        session()->flash('success', 'You are logged out!');
        return redirect('/');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Mengecek apakah kombinasi username dan idFaskes sesuai
        $users = User::where('username', $request->username)->first();

        //mengecek apakah data users ada di database
        if ($users == null) {
            return redirect()->back()->with('gagal', 'Users Not Found');
        }

        //mengecek password
        if (Hash::check($request->password, $users->password) == false) {
            return redirect()->back()->with('gagal', 'Username and Password Not Match');
        }

        //ketika username dan password tidak ada yang salah
        if ($users && Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed
            return redirect()->intended($this->redirectPath());
        }
    }
}
