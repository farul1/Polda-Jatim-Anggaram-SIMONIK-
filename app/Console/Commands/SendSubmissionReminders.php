<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail; // Kita akan buat ini nanti

class SendSubmissionReminders extends Command
{
    protected $signature = 'app:send-submission-reminders';
    protected $description = 'Send reminder emails to Polsek who have not submitted their budget proposal for the previous month.';

    public function handle()
    {
        $this->info('Mulai mengirim email pengingat...');

        $previousMonth = Carbon::now()->subMonth();
        $startOfPreviousMonth = $previousMonth->copy()->startOfMonth();
        $endOfPreviousMonth = $previousMonth->copy()->endOfMonth();

        $polsekUsers = User::where('role', 'polsek')->where('is_blocked', false)->get();

        foreach ($polsekUsers as $user) {
            $hasSubmitted = Pengajuan::where('user_id', $user->id)
                ->whereBetween('tanggal_pengajuan', [$startOfPreviousMonth, $endOfPreviousMonth])
                ->exists();

            if (!$hasSubmitted) {
                Mail::to($user->email)->send(new ReminderMail($user));
                $this->info("Email pengingat dikirim ke: {$user->email}");
            }
        }

        $this->info('Selesai mengirim email pengingat.');
        return 0;
    }
}
