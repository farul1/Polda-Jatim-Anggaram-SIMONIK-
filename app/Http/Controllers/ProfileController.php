<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $daftarKota = config('daerah.kota'); // Ambil daftar kota

        return view('profile.edit', [
            'user' => $request->user(),
            'daftarKota' => $daftarKota, // Kirim daftar kota ke view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mengisi data nama dan email yang sudah divalidasi
        $request->user()->fill($request->validated());

        // Jika user mengganti emailnya, hapus status verifikasi lama
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

         $request->user()->alamat_polsek = $request->input('alamat_polsek');

        // Tambahkan logika ini: hanya Super Admin yang bisa mengubah kota
        if ($request->has('kota')) {
            $request->user()->kota = $request->input('kota');
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
