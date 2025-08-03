<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusUpdated;
use App\Mail\StatusUpdateMail;
use App\Models\ReplyTemplate;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Default nilai
        $chartLabels = collect();
        $chartData = collect();
        $pengajuans = collect();
        $daftarKota = [];

        if ($user->isSuperAdmin()) {
            // Ambil daftar kota dari user polres
            $daftarKota = \App\Models\User::where('role', 'polres')
                ->whereNotNull('kota')
                ->pluck('kota')
                ->unique()
                ->sort()
                ->values();

            // Ambil pengajuan (filter kota jika ada)
            // Diubah namanya menjadi "laporan rencana kebutuhan anggaran" atau "laporan perwabku bulan lalu" di view
            $pengajuans = \App\Models\Pengajuan::with('user')
                ->when($request->filled('kota'), function ($query) use ($request) {
                    $query->whereHas('user', function ($q) use ($request) {
                        $q->where('kota', $request->kota);
                    });
                })
                ->latest()
                ->get();

            // Chart: polsek berdasarkan filter kota
            $polseks = \App\Models\User::where('role', 'polsek')
                ->when($request->filled('kota'), function ($query) use ($request) {
                    $query->where('kota', $request->kota);
                })
                ->get();

            $chartLabels = $polseks->pluck('name');
            // Data chart bisa menampilkan pagu awal dan sisa pagu jika sudah ditambahkan
            $chartData = $polseks->map(fn ($u) => $u->sisa_pagu);

        } elseif ($user->isAdmin()) {
            // Pengajuan hanya dari kota polres
            $pengajuans = \App\Models\Pengajuan::with('user')
                ->whereHas('user', function ($q) use ($user) {
                    $q->where('kota', $user->kota);
                })
                ->latest()
                ->get();

            // Chart: polsek di kota polres ini saja
            $polseks = \App\Models\User::where('role', 'polsek')
                ->where('kota', $user->kota)
                ->get();

            $chartLabels = $polseks->pluck('name');
            $chartData = $polseks->map(fn ($u) => $u->sisa_pagu);
        } elseif ($user->isUser()) {
            // Pengajuan hanya untuk polsek ini sendiri
            $pengajuans = $user->pengajuans()->latest()->get();
        }

        return view('admin.dashboard', [
            'pengajuans' => $pengajuans,
            'daftarKota' => $daftarKota,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            // Anda bisa tambahkan data pagu awal di sini untuk ditampilkan di view
        ]);
    }
    public function show(Pengajuan $pengajuan)
    {
        $this->authorize('view', $pengajuan);

        $templates = ReplyTemplate::all();

        // Di view 'admin.show', ubah teks "Aksi Admin" menjadi "Aksi Admin Bagren"
        return view('admin.show', compact('pengajuan', 'templates'));
    }

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        $this->authorize('update', $pengajuan);

        $request->validate([
            'status' => 'required|in:Diproses,Selesai,Ditolak',
            'reply_message' => 'nullable|string',
            'reply_image' => 'nullable|image|max:2048',
        ]);

        $userPolsek = $pengajuan->user;
        $oldStatus = $pengajuan->status;
        $newStatus = $request->status;

        // REVISI: Pagu hanya dikurangi saat status menjadi 'Selesai' untuk pertama kali.
        // Tidak ada penambahan kembali (tanda plus dihilangkan) untuk menjaga realisasi sesuai pagu awal.
        if ($newStatus === 'Selesai' && $oldStatus !== 'Selesai') {
            $userPolsek->sisa_pagu -= $pengajuan->jumlah_diajukan;
            $userPolsek->save();
        }

        $pengajuan->status = $newStatus;
        $pengajuan->reply_message = $request->reply_message;

        if ($request->hasFile('reply_image')) {
            if ($pengajuan->reply_image_path) {
                Storage::delete($pengajuan->reply_image_path);
            }
            $pengajuan->reply_image_path = $request->file('reply_image')->store('public/replies');
        }
        $pengajuan->save();

        // Kirim Notifikasi Email & Database
        Mail::to($pengajuan->user->email)->send(new \App\Mail\StatusUpdateMail($pengajuan));
        $pengajuan->user->notify(new \App\Notifications\StatusPengajuanUpdated($pengajuan));

        return redirect()->route('admin.pengajuan.show', $pengajuan)->with('success', 'Status pengajuan berhasil diperbarui.');
    }


    public function destroyReplyImage(Pengajuan $pengajuan)
    {
        $this->authorize('update', $pengajuan);

        if ($pengajuan->reply_image_path) {
            Storage::delete($pengajuan->reply_image_path);
            $pengajuan->reply_image_path = null;
            $pengajuan->save();
        }

        return redirect()->back()->with('success', 'Gambar balasan berhasil dihapus.');
    }
}
