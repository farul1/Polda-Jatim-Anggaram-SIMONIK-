<x-app-layout>
    <!-- Tambah z-index pada header -->
    <x-slot name="header" class="relative z-50">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight">
                {{ __('Riwayat Pengajuan Anggaran') }}
            </h2>
            <div class="bg-yellow-50 border border-yellow-100 px-4 py-2 rounded-lg shadow-sm">
                <p class="text-xs text-yellow-600 font-medium">Sisa Pagu Tersedia</p>
                <p class="text-lg font-bold text-coklat-polisi">
                    Rp {{ number_format(auth()->user()->sisa_pagu, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm border border-kuning-polisi/30 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-8">

                    @if(session('success'))
                        <div class="mb-5 p-4 rounded-xl bg-green-100 text-green-800 font-medium shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300 text-sm">
                            <thead class="bg-kuning-polisi/20">
                                <tr>
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">Tanggal Masuk</th>
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">Jumlah Diajukan</th>
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">Sisa Pagu</th>
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pengajuans as $pengajuan)
                                    <tr class="hover:bg-yellow-50/50 transition duration-200 ease-in-out">
                                        <td class="px-6 py-4 text-gray-900 font-semibold">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-gray-700">
                                            {{ \Carbon\Carbon::parse($pengajuan->created_at)->isoFormat('DD MMMM YYYY') }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-700 font-medium">
                                            Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $sisaPagu = $pengajuan->sisa_pagu_saat_ini ?? auth()->user()->sisa_pagu;
                                                $paguTotal = auth()->user()->pagu_total;
                                                $percentage = $paguTotal > 0 ? ($sisaPagu / $paguTotal) * 100 : 0;
                                                $color = $percentage > 75 ? 'bg-green-500' :
                                                        ($percentage > 50 ? 'bg-blue-500' :
                                                        ($percentage > 25 ? 'bg-yellow-500' : 'bg-red-500'));
                                            @endphp
                                            <div class="flex items-center gap-2">
                                                <div class="w-24 bg-gray-200 rounded-full h-2 overflow-hidden">
                                                    <div class="h-2 {{ $color }}" style="width: {{ $percentage }}%"></div>
                                                </div>
                                                <span class="text-xs text-gray-600">
                                                    Rp {{ number_format($sisaPagu, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span @class([
                                                'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold',
                                                'bg-yellow-100 text-yellow-800' => $pengajuan->status == 'Diproses',
                                                'bg-green-100 text-green-800' => $pengajuan->status == 'Selesai',
                                                'bg-red-100 text-red-800' => $pengajuan->status == 'Ditolak',
                                            ])>
                                                {{ $pengajuan->status }}
                                            </span>
                                        </td>
                                       <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div x-data="{ open: false, trigger: null }" class="relative inline-block text-left">
                                                <button @click="open = !open; trigger = $el"
                                                    class="px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                                    Aksi
                                                    <svg class="w-5 h-5 inline-block ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>

                                                <template x-teleport="body">
                                                    <div
                                                        x-show="open"
                                                        @click.outside="open = false"
                                                        x-transition
                                                        x-ref="dropdown"
                                                        class="absolute z-50 mt-2 w-56 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg"
                                                        :style="`position: fixed; top: ${trigger?.getBoundingClientRect().bottom + window.scrollY}px; left: ${trigger?.getBoundingClientRect().left}px`"
                                                    >
                                                        <div class="py-1">
                                                            <a href="{{ route('polsek.pengajuan.show', $pengajuan->id) }}"
                                                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                🔍 Lihat Detail
                                                            </a>
                                                            @if($pengajuan->laporan_kebutuhan)
                                                            <a href="{{ Storage::url($pengajuan->laporan_kebutuhan) }}" target="_blank"
                                                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                📎 Laporan Kebutuhan
                                                            </a>
                                                            @endif
                                                            @if($pengajuan->laporan_keuangan_lalu)
                                                            <a href="{{ Storage::url($pengajuan->laporan_keuangan_lalu) }}" target="_blank"
                                                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                📄 Laporan Realisasi bulan lalu
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-6 text-center text-gray-500 italic">
                                            Anda belum pernah mengajukan anggaran.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
