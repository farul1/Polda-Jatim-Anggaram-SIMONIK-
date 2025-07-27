<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel yang terhubung dengan model ini.
     * @var string
     */
    protected $table = 'pengajuan';

    /**
     * Kolom-kolom yang boleh diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tanggal_pengajuan',
        'laporan_kebutuhan',
        'laporan_keuangan_lalu',
        'jumlah_diajukan',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
