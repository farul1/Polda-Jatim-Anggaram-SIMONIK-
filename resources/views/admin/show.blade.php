<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-polisi leading-tight">
            {{ __('Detail Pengajuan dari ' . $pengajuan->user->name) }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-4 sm:px-6 lg:px-8">

            {{-- KOLOM KIRI: INFORMASI PENGAJUAN --}}
            <div class="md:col-span-2 bg-white/80 backdrop-blur-sm shadow-md rounded-lg p-6 space-y-6">
                <div>
                    <h3 class="text-xl font-semibold text-coklat-polisi border-b pb-3">Informasi Pengajuan</h3>
                    <div class="mt-4 text-gray-700 space-y-2">
                        <p><strong>Nama Polsek:</strong> {{ $pengajuan->user->name }}</p>
                        <p><strong>Alamat:</strong> {{ $pengajuan->user->alamat_polsek }}</p>
                        <p><strong>Tanggal Diajukan:</strong> {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->isoFormat('DD MMMM YYYY') }}</p>
                        <p><strong>Jumlah Diajukan:</strong> Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}</p>
                        <p><strong>Status Saat Ini:</strong>
                            @php
                                $statusColor = match($pengajuan->status) {
                                    'Diproses' => 'bg-yellow-100 text-yellow-800',
                                    'Selesai' => 'bg-green-100 text-green-800',
                                    'Ditolak' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800'
                                };
                            @endphp
                            <span class="px-2 py-1 text-sm font-semibold rounded {{ $statusColor }}">
                                {{ $pengajuan->status }}
                            </span>
                        </p>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-coklat-polisi border-b pb-3">Dokumen Terlampir</h3>
                    <div class="flex flex-col md:flex-row gap-4 mt-3">
                        <a href="{{ Storage::url($pengajuan->laporan_kebutuhan) }}" target="_blank"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                            📄 Laporan rencana kebutuhan anggaran
                        </a>
                        <a href="{{ Storage::url($pengajuan->laporan_keuangan_lalu) }}" target="_blank"
                            class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition">
                            📊 Laporan Realisasi Kebutuhan bulan lalu
                        </a>
                    </div>
                </div>

                @if($pengajuan->reply_message || $pengajuan->reply_image_path)
                <div>
                    <h3 class="text-xl font-semibold text-coklat-polisi border-b pb-3">Balasan Admin</h3>
                    <div class="space-y-4 mt-3">
                        @if($pengajuan->reply_message)
                            <div class="bg-gray-100 border-l-4 border-coklat-polisi p-4 rounded-md italic">
                                "{{ $pengajuan->reply_message }}"
                            </div>
                        @endif
                        @if($pengajuan->reply_image_path)
                            <div>
                                <img src="{{ Storage::url($pengajuan->reply_image_path) }}" alt="Gambar Balasan" class="rounded-md shadow-md max-w-sm">

                                <form action="{{ route('admin.pengajuan.deleteReplyImage', $pengajuan->id) }}" method="POST"
                                      class="mt-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-sm hover:underline">
                                        🗑 Hapus Gambar
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            {{-- KOLOM KANAN: FORM AKSI ADMIN --}}
            <div class="bg-white/80 backdrop-blur-sm shadow-md rounded-lg p-6 space-y-6">
                <h3 class="text-xl font-semibold text-coklat-polisi border-b pb-3">Admin BAGREN (Bagian Perencanaan)</h3>

                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-md text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.pengajuan.updateStatus', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Ubah Status</label>
                        <select name="status" id="status"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-coklat-polisi focus:border-coklat-polisi">
                            <option value="Diproses" @selected($pengajuan->status == 'Diproses')>Diproses</option>
                            <option value="Selesai" @selected($pengajuan->status == 'Selesai')>Selesai</option>
                            <option value="Ditolak" @selected($pengajuan->status == 'Ditolak')>Ditolak</option>
                        </select>
                    </div>

                    <div class="border-t border-gray-300 pt-4">
                        <h4 class="font-semibold text-gray-800">Kirim Balasan (Opsional)</h4>

                        <label for="template_reply" class="text-sm text-gray-600 block mt-2">Gunakan Template Pesan:</label>
                        <select id="template_reply" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="">-- Pilih Template dari Admin --</option>
                            @foreach($templates as $template)
                                <option value="{{ $template->message }}">{{ $template->message }}</option>
                            @endforeach
                        </select>

                        <label for="reply_message" class="text-sm text-gray-600 block mt-4">Atau Tulis Pesan Kustom:</label>
                        <textarea name="reply_message" id="reply_message" rows="4"
                                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm p-2 text-sm focus:ring-coklat-polisi focus:border-coklat-polisi"></textarea>

                        <label for="reply_image" class="text-sm text-gray-600 block mt-4">Lampirkan Gambar (Opsional):</label>
                        <input type="file" name="reply_image" id="reply_image"
                               class="block w-full mt-1 text-sm p-2 border border-gray-300 rounded-md shadow-sm" />
                    </div>

                    <div class="flex justify-end pt-4">
                        <x-primary-button>Perbarui Status & Kirim</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('template_reply').addEventListener('change', function() {
            if (this.value) {
                document.getElementById('reply_message').value = this.value;
            }
        });
    </script>
    @endpush
</x-app-layout>
