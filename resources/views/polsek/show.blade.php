<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight">
            {{ __('Detail Pengajuan Anggaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm border border-kuning-polisi/30 shadow-xl rounded-2xl p-6 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    {{-- Kolom Kiri --}}
                    <div>
                        <h3 class="text-xl font-semibold text-coklat-polisi border-b pb-3 mb-4">Informasi Pengajuan</h3>
                        <div class="space-y-3 text-gray-700">
                            <p><span class="font-medium">Tanggal Diajukan:</span> {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->isoFormat('DD MMMM YYYY') }}</p>
                            <p><span class="font-medium">Jumlah Diajukan:</span> Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}</p>
                            <p>
                                <span class="font-medium">Status Saat Ini:</span>
                                <span class="
                                    inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                    @if($pengajuan->status == 'Diproses') bg-yellow-100 text-yellow-800
                                    @elseif($pengajuan->status == 'Selesai') bg-green-100 text-green-800
                                    @elseif($pengajuan->status == 'Ditolak') bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ $pengajuan->status }}
                                </span>

                            </p>
                        </div>

                        <h4 class="text-lg font-semibold mt-8 mb-2 text-coklat-polisi">Dokumen Terlampir</h4>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ Storage::url($pengajuan->laporan_kebutuhan) }}" target="_blank"
                               class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg shadow transition">
                                📎 Laporan Kebutuhan
                            </a>
                            <a href="{{ Storage::url($pengajuan->laporan_keuangan_lalu) }}" target="_blank"
                               class="inline-block px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg shadow transition">
                                📄 Laporan Realisasi Kebutuhan bulan lalu
                            </a>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div>
                        <h3 class="text-xl font-semibold text-coklat-polisi border-b pb-3 mb-4">Balasan dari Admin</h3>
                        @if($pengajuan->reply_message || $pengajuan->reply_image_path)
                            <div class="space-y-4">
                                @if($pengajuan->reply_message)
                                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-md shadow-sm italic text-gray-800">
                                        "{{ $pengajuan->reply_message }}"
                                    </div>
                                @endif

                                @if($pengajuan->reply_image_path)
                                    <div>
                                        <p class="font-medium text-gray-700 mb-2">Gambar Lampiran:</p>
                                        <img src="{{ Storage::url($pengajuan->reply_image_path) }}" alt="Gambar Balasan"
                                             class="rounded-lg shadow-md max-w-full border border-gray-200">
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum ada balasan dari admin.</p>
                        @endif
                    </div>
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-10">
                    <a href="{{ route('polsek.pengajuan.riwayat') }}"
                       class="inline-flex items-center text-sm text-gray-600 hover:text-coklat-polisi transition font-medium">
                        &larr; Kembali ke Riwayat Pengajuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
