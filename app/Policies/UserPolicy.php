<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function create(User $user): bool
    {
        // Hanya Super Admin dan Admin Polres yang bisa membuat user
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    public function update(User $user, User $model): bool
    {
        // Super Admin bisa edit siapa saja kecuali dirinya sendiri
        if ($user->isSuperAdmin()) {
            return $user->id !== $model->id;
        }

        // Admin Polres hanya bisa edit Polsek di kotanya
        if ($user->isAdmin()) {
            return $model->isUser() && $user->kota === $model->kota;
        }

        return false;
    }

    public function delete(User $user, User $model): bool
    {
        // Hanya Super Admin yang bisa hapus, dan tidak bisa hapus diri sendiri
        return $user->isSuperAdmin() && $user->id !== $model->id;
    }

    public function viewAny(User $user): bool
    {
        // Super Admin dan Admin Polres bisa lihat daftar user
        return $user->isSuperAdmin() || $user->isAdmin();
    }

    public function view(User $user, User $model): bool
    {
        // Super Admin bisa lihat semua
        if ($user->isSuperAdmin()) {
            return true;
        }

        // Admin Polres hanya bisa lihat Polsek di kotanya
        if ($user->isAdmin()) {
            return $model->isUser() && $user->kota === $model->kota;
        }

        return false;
    }

    public function restore(User $user, User $model): bool
    {
        // Hanya Super Admin yang bisa me-restore
        return $user->isSuperAdmin();
    }

    public function forceDelete(User $user, User $model): bool
    {
        // Super Admin bisa force delete kecuali dirinya sendiri
        return $user->isSuperAdmin() && $user->id !== $model->id;
    }
}
