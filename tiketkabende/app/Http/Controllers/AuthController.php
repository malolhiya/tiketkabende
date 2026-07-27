<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'phone' => 'required',

            'password' => 'required|min:6'

        ],[
            'email.unique' => 'Email sudah terdaftar.'
        ]);

        User::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'password' => Hash::make($request->password),

            'role' => 'user'

        ]);

        return redirect('/login')
                ->with('success',
                'Registrasi berhasil, silakan login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = [

            'email' => $request->email,

            'password' => $request->password

        ];

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            // Arahkan sesuai role: admin ke dashboard admin, user biasa ke dashboard user
            if(Auth::user()->role === 'admin')
            {
                return redirect('/dashboard-admin')
                        ->with('success', 'Login berhasil');
            }

            return redirect('/dashboard-user')
                    ->with('success',
                    'Login berhasil');
        }

        return back()
                ->with('error',
                'Email atau Password salah');
    }

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

public function cekEmail(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if(!$user)
    {
        return back()->with('error','Email tidak ditemukan');
    }

    return view('reset-password', [
        'email' => $request->email
    ]);
}

public function simpanPasswordBaru(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed'
    ]);

    $user = User::where('email', $request->email)->first();

    if(!$user)
    {
        return back()->with('error','Email tidak ditemukan');
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect('/login')
            ->with('success','Password berhasil diubah');
}
}