<?php

namespace App\Http\Controllers\Polsek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PengajuanController extends Controller
{
    // Beranda Polsek
    public function index()
    {
        return view('polsek.beranda');
    }

    // Detail pengajuan tertentu
    public function show(Pengajuan $pengajuan)
    {
        // Pastikan hanya pemilik yang bisa mengakses pengajuannya
        if (auth()->id() !== $pengajuan->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        return view('polsek.show', compact('pengajuan'));
    }

    // Form pengajuan baru
    public function create()
    {
        if (auth()->user()->is_blocked) {
            return redirect()->route('polsek.beranda')->with('error', 'Akun Anda diblokir sementara dan tidak dapat mengajukan anggaran bulan ini.');
        }

        return view('polsek.create');
    }

    // Simpan pengajuan baru
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_diajukan' => 'required|integer|min:1000|max:' . (auth()->user()->sisa_pagu ?? 0),
            'laporan_kebutuhan' => 'required|file|mimes:pdf|max:5120', // max 5MB
            'laporan_keuangan_lalu' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        $user = auth()->user();
        $jumlahDiajukan = $request->jumlah_diajukan;

        // Gunakan sisa_pagu accessor
        if ($jumlahDiajukan > $user->sisa_pagu) {
            return back()->withInput()->withErrors([
                'jumlah_diajukan' => 'Jumlah yang diajukan melebihi sisa pagu anggaran Anda.',
            ]);
        }

        // Simpan file ke public disk dan hanya ambil path relatif
        $pathKebutuhan = $request->file('laporan_kebutuhan')->store('laporan_kebutuhan', 'public');
        $pathKeuanganLalu = $request->file('laporan_keuangan_lalu')->store('Laporan_Realisasi_Kebutuhan_bulan_lalu', 'public');

        if (!$pathKebutuhan || !$pathKeuanganLalu) {
            return back()->with('error', 'Gagal mengunggah dokumen. Silakan coba lagi.');
        }

        Pengajuan::create([
            'user_id' => $user->id,
            'tanggal_pengajuan' => now(),
            'jumlah_diajukan' => $jumlahDiajukan,
            'laporan_kebutuhan' => $pathKebutuhan,
            'laporan_keuangan_lalu' => $pathKeuanganLalu,
            'status' => 'Diproses',
        ]);

        return redirect()->route('polsek.pengajuan.riwayat')->with('success', 'Pengajuan anggaran berhasil dikirim!');
    }


    // Riwayat pengajuan user
    public function riwayat()
    {
        $pengajuans = Pengajuan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('polsek.riwayat', compact('pengajuans'));
    }
}
