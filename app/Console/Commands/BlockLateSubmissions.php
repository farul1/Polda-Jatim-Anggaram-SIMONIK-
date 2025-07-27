<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BlockedMail;

class BlockLateSubmissions extends Command
{
    protected $signature = 'app:block-late-submissions';
    protected $description = 'Block Polsek users who failed to submit their proposal by the deadline.';

    public function handle()
    {
        $this->info('Mulai proses pemblokiran...');

        $previousMonth = Carbon::now()->subMonth();
        $startOfPreviousMonth = $previousMonth->copy()->startOfMonth();
        $endOfPreviousMonth = $previousMonth->copy()->endOfMonth();

        $polsekUsers = User::where('role', 'polsek')->where('is_blocked', false)->get();

        foreach ($polsekUsers as $user) {
            $hasSubmitted = Pengajuan::where('user_id', $user->id)
                ->whereBetween('tanggal_pengajuan', [$startOfPreviousMonth, $endOfPreviousMonth])
                ->exists();

            if (!$hasSubmitted) {
                // Blokir user
                $user->is_blocked = true;
                $user->save();

                Mail::to($user->email)->send(new BlockedMail($user));
                $this->info("User diblokir dan notifikasi dikirim ke: {$user->email}");
            }
        }

        $this->info('Selesai memproses pemblokiran.');
        return 0;
    }
}
