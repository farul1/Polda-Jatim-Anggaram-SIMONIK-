<x-mail::message>
# Pengingat Pengajuan Anggaran

Yth. Bapak/Ibu {{ $user->name }},

Kami mengingatkan bahwa Anda belum melakukan pengajuan anggaran untuk periode bulan lalu.
Harap segera melakukan pengajuan sebelum tanggal 5 untuk menghindari pemblokiran akun sementara.

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
