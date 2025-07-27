<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function create(): View
    {
        $sliders = Slider::orderBy('order')->get();
        return view('auth.register', compact('sliders'));
    }

    /**
     * Menangani permintaan registrasi yang masuk.
     */
    public function store(Request $request): RedirectResponse
    {
        // Cek jumlah user. Jika 0, maka ini user superadmin.
        if (User::count() === 0) {
            $userRole = User::ROLE_SUPERADMIN;
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
                'alamat_polsek' => ['nullable', 'string', 'max:1000'],
                'kota' => ['nullable', 'string', 'max:255'],
            ]);
        } else {
            $userRole = User::ROLE_USER;
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
                'alamat_polsek' => ['required', 'string', 'max:1000'],
                'kota' => ['required', 'string', 'max:255'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat_polsek' => $request->alamat_polsek,
            'kota' => $request->kota,
            'password' => Hash::make($request->password),
            'role' => $userRole,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
