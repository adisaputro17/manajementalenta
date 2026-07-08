<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credential)) {

            $request->session()->regenerate();

            if (Auth::user()->role == 'ADMIN') {
                return redirect()->route('pegawai.index');
            }

            return redirect()->route('talent.matrix');
        }

        return back()
            ->withInput()
            ->withErrors([
                'nip' => 'NIP atau Password salah.'
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}