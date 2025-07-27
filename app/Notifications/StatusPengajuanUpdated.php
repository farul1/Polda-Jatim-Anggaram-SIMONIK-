<?php

namespace App\Notifications;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusPengajuanUpdated extends Notification
{
    use Queueable;

    protected $pengajuan;

    public function __construct(Pengajuan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    public function via(object $notifiable): array
    {
        // Kita ingin notifikasi ini disimpan ke database
        return ['database'];
    }

    // Mendefinisikan data yang akan disimpan di kolom 'data' pada tabel notifications
    public function toDatabase(object $notifiable): array
    {
        return [
            'pengajuan_id' => $this->pengajuan->id,
            'jumlah_diajukan' => $this->pengajuan->jumlah_diajukan,
            'status_baru' => $this->pengajuan->status,
            'message' => 'Status pengajuan Anda sebesar Rp ' . number_format($this->pengajuan->jumlah_diajukan) . ' telah diubah menjadi ' . $this->pengajuan->status,
        ];
    }
}
