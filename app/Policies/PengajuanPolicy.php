<?php

namespace App\Policies;

use App\Models\Pengajuan;
use App\Models\User;

class PengajuanPolicy
{
    /**
     * Izinkan Super Admin melakukan apa saja.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        return null;
    }

    /**
     * Menentukan apakah user bisa melihat daftar pengajuan.
     * (Tidak dipakai karena logika ada di controller)
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    /**
     * Menentukan apakah admin bisa melihat detail pengajuan.
     */
    public function view(User $user, Pengajuan $pengajuan): bool
    {
        // Admin hanya boleh lihat pengajuan dari Polsek di kotanya.
        return $user->kota === $pengajuan->user->kota;
    }

    /**
     * Menentukan apakah admin bisa mengubah status pengajuan.
     */
    public function update(User $user, Pengajuan $pengajuan): bool
    {
         // Admin hanya boleh ubah status pengajuan dari Polsek di kotanya.
        return $user->kota === $pengajuan->user->kota;
    }
}
