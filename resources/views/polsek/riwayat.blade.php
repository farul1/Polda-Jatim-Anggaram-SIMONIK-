<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight">
            {{ __('Riwayat Pengajuan Anggaran') }}
        </h2>
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
                                    <th class="px-6 py-4 text-left font-bold text-coklat-polisi uppercase tracking-wider">Jumlah</th>
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
                                        <td class="px-6 py-4 text-gray-700">
                                            Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}
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
                                                            <a href="{{ Storage::url($pengajuan->laporan_kebutuhan) }}" target="_blank"
                                                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                📎 Laporan Kebutuhan
                                                            </a>
                                                            <a href="{{ Storage::url($pengajuan->laporan_keuangan_lalu) }}" target="_blank"
                                                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                📄 Laporan Realisasi Kebutuhan bulan lalu
                                                            </a>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-6 text-center text-gray-500 italic">
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
