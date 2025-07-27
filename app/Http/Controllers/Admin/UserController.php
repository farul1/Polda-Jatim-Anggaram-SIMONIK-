<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $query = User::withSum('pengajuans', 'jumlah_diajukan');

        if ($admin->isAdmin()) {
            $query->where('kota', $admin->kota)->where('role', User::ROLE_USER);
        } elseif ($admin->isSuperAdmin()) {
            $query->where('id', '!=', $admin->id);
        }

        $users = $query->latest()->paginate(10); // ✅ pakai paginate!
        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        $this->authorize('create', User::class);
        $daftarKota = config('daerah.kota');
        return view('admin.users.create', compact('daftarKota'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => [auth()->user()->isSuperAdmin() ? 'required' : 'nullable', 'in:superadmin,polres,polsek'],
            'kota' => [auth()->user()->isSuperAdmin() || auth()->user()->isAdmin() ? 'required' : 'nullable', 'string'],
            'pagu_total' => ['required', 'numeric', 'min:0'],
            'alamat_polsek' => ['nullable', 'string'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat_polsek' => $request->alamat_polsek,
            'password' => Hash::make($request->password),
            'pagu_total' => $request->pagu_total,
        ];

        if (auth()->user()->isSuperAdmin()) {
            $data['role'] = $request->role;
            $data['kota'] = $request->kota;
        } else {
            $data['role'] = User::ROLE_USER;
            $data['kota'] = auth()->user()->kota;
        }

        User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $daftarKota = config('daerah.kota');
        return view('admin.users.edit', compact('user', 'daftarKota'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => [auth()->user()->isSuperAdmin() ? 'required' : 'nullable', 'in:superadmin,polres,polsek'],
            'kota' => [auth()->user()->isSuperAdmin() || auth()->user()->isAdmin() ? 'required' : 'nullable', 'string'],
             'pagu_total' => 'required|integer|min:0',
            'alamat_polsek' => ['nullable', 'string'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat_polsek' => $request->alamat_polsek,
            'pagu_total' => $request->pagu_total,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if (auth()->user()->isSuperAdmin()) {
            $data['role'] = $request->role;
            $data['kota'] = $request->kota;
        } elseif (auth()->user()->isAdmin()) {
            $data['kota'] = $request->kota;
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}





