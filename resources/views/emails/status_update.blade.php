<x-mail::message>
# Pemberitahuan Status Pengajuan Anggaran

Dengan Hormat,

Dengan ini kami sampaikan pembaruan status untuk pengajuan anggaran dari unit **{{ $pengajuan->user->name }}**.

**Detail Pengajuan:**
- **Tanggal Diajukan:** {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d F Y') }}
- **Jumlah:** Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}
- **Status Baru:** **{{ $pengajuan->status }}**

@if($pengajuan->reply_message)
**Pesan dari Admin:**
<x-mail::panel>
{{ $pengajuan->reply_message }}
</x-mail::panel>
@endif

@if($pengajuan->reply_image_path)
**Lampiran Gambar dari Admin:**<br>
<img src="{{ asset(Storage::url($pengajuan->reply_image_path)) }}" alt="Gambar Balasan" style="max-width: 100%;">
@endif

Anda dapat melihat detail dan riwayat lengkap pengajuan dengan menekan tombol di bawah ini.

<x-mail::button :url="route('polsek.pengajuan.riwayat')">
Lihat Riwayat Pengajuan
</x-mail::button>

Terima kasih atas perhatian Anda.

Hormat kami,<br>
Admin Polres - {{ config('app.name') }}
</x-mail::message>