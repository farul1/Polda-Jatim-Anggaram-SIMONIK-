<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_ADMIN = 'polres';
    const ROLE_USER = 'polsek';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat_polsek',
        'role',
        'kota',
        'pagu_total',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'pagu_total' => 'float',
    ];

    // Role Checkers
    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }


    // Relasi ke pengajuan
    public function pengajuans()
    {
        return $this->hasMany(\App\Models\Pengajuan::class);
    }

    // Virtual Attribute: sisa pagu
    public function getSisaPaguAttribute()
    {
        $totalDisetujui = $this->pengajuans()
            ->where('status', 'Selesai')
            ->sum('jumlah_diajukan');

        return $this->pagu_total - $totalDisetujui;
    }

    public function getTotalPaguTerpakaiAttribute()
    {
        return $this->pengajuans()
            ->where('status', 'Selesai')
            ->sum('jumlah_diajukan');
    }


}
