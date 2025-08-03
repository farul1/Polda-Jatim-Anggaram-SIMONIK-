<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi tracking-tight leading-tight">
            {{ __('Form Pengajuan Anggaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200 shadow-xl rounded-2xl p-8 sm:p-10">

                {{-- Sisa Pagu Card --}}
                <div class="mb-8 bg-gradient-to-r from-blue-100 to-blue-200 border border-blue-200 rounded-xl p-6 shadow-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-blue-800 flex items-center">
                                <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Sisa Pagu Anggaran
                            </h3>
                            <p class="text-sm text-blue-600 mt-1">Anggaran tersedia untuk diajukan periode ini</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-blue-900">
                                Rp {{ number_format(auth()->user()->sisa_pagu ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Start --}}
                <form id="form-pengajuan" method="POST" action="{{ route('polsek.pengajuan.store') }}" enctype="multipart/form-data" class="space-y-6" autocomplete="off">
                    @csrf

                    {{-- Informasi Otomatis --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-semibold text-gray-700">Nama Polsek</label>
                            <div class="mt-1 p-3 bg-gray-100 border border-gray-300 rounded-md">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                        <div>
                            <label class="block font-semibold text-gray-700">Alamat Polsek</label>
                            <div class="mt-1 p-3 bg-gray-100 border border-gray-300 rounded-md">
                                {{ Auth::user()->alamat_polsek }}
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-semibold text-gray-700">Tanggal Pengajuan</label>
                            <div class="mt-1 p-3 bg-gray-100 border border-gray-300 rounded-md">
                                {{ now()->locale('id')->isoFormat('D MMMM YYYY') }}
                            </div>
                        </div>
                    </div>

                    {{-- Jumlah Diajukan --}}
                    <div>
                        <x-input-label for="jumlah_diajukan_formatted" class="text-gray-800" :value="__('Jumlah Anggaran Diajukan (Rp)')" />
                        <x-text-input id="jumlah_diajukan_formatted" class="block mt-1 w-full" type="text" required />
                        <input type="hidden" name="jumlah_diajukan" id="jumlah_diajukan">
                        <x-input-error :messages="$errors->get('jumlah_diajukan')" class="mt-2" />
                        <p class="text-sm text-gray-500 mt-1">Masukkan angka maksimal Rp {{ number_format(auth()->user()->sisa_pagu ?? 0, 0, ',', '.') }}</p>
                    </div>

                    {{-- Upload Laporan Kebutuhan --}}
                    <div>
                        <label for="laporan_kebutuhan" class="block font-semibold text-gray-800 mb-1">
                            Laporan Rencana Kebutuhan Anggaran <span class="text-xs text-red-600 font-medium">*Wajib (PDF maks 20MB)</span>
                        </label>
                        <input id="laporan_kebutuhan" name="laporan_kebutuhan" type="file" accept="application/pdf" class="block w-full border border-gray-300 rounded-md shadow-sm" required />
                        <x-input-error :messages="$errors->get('laporan_kebutuhan')" class="mt-2" />
                    </div>

                    {{-- Upload Laporan Keuangan --}}
                    <div>
                        <label for="laporan_keuangan_lalu" class="block font-semibold text-gray-800 mb-1">
                            Laporan Perwabku Bulan Lalu <span class="text-xs text-red-600 font-medium">*Wajib (PDF maks 20MB)</span>
                        </label>
                        <input id="laporan_keuangan_lalu" name="laporan_keuangan_lalu" type="file" accept="application/pdf" class="block w-full border border-gray-300 rounded-md shadow-sm" required />
                        <x-input-error :messages="$errors->get('laporan_keuangan_lalu')" class="mt-2" />
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="pt-6 text-center">
                        @if((auth()->user()->sisa_pagu ?? 0) > 0)
                            <button type="submit" class="px-10 py-3 bg-coklat-polisi text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 focus:outline-none">
                                Submit Pengajuan
                            </button>
                        @else
                            <div class="text-red-600 font-semibold mb-4">Anda tidak memiliki sisa pagu anggaran.</div>
                            <button type="button" disabled class="px-10 py-3 bg-gray-400 text-white font-semibold rounded-lg shadow-md cursor-not-allowed">
                                Tidak Bisa Mengajukan
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JS: Cleave & File Size Check --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputElement = document.getElementById('jumlah_diajukan_formatted');
            const rawInput = document.getElementById('jumlah_diajukan');
            const sisaPagu = {{ auth()->user()->sisa_pagu ?? 0 }};

            if (inputElement) {
                const cleave = new Cleave(inputElement, {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    delimiter: '.',
                    numeralDecimalMark: ',',
                    onValueChanged: function (e) {
                        const nilai = parseInt(e.target.rawValue) || 0;
                        rawInput.value = nilai;

                        if (nilai > sisaPagu) {
                            inputElement.setCustomValidity('Jumlah melebihi sisa pagu!');
                            inputElement.reportValidity();
                            inputElement.classList.add('border-red-500');
                        } else {
                            inputElement.setCustomValidity('');
                            inputElement.classList.remove('border-red-500');
                        }
                    }
                });
            }

            // Validasi ukuran file maks 20MB
            const form = document.getElementById('form-pengajuan');
            form.addEventListener('submit', function(e) {
                const files = ['laporan_kebutuhan', 'laporan_keuangan_lalu'];
                for (const id of files) {
                    const file = document.getElementById(id).files[0];
                    if (file && file.size > 20 * 1024 * 1024) {
                        e.preventDefault();
                        alert('Ukuran file ' + id.replace('_', ' ') + ' melebihi 20MB.');
                        return;
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
