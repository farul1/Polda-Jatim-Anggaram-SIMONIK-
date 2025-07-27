<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-coklat-polisi tracking-tight leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                @if(Auth::user()->is_blocked)
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Akun Diblokir!</strong>
                        <span class="block sm:inline">Akun Anda diblokir sementara karena tidak melakukan pengajuan hingga batas waktu. Anda dapat mengajukan kembali pada periode berikutnya.</span>
                    </div>
                @endif

                <div class="bg-yellow-50/60 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-lg relative">

                        <div class="absolute inset-0 z-0 flex items-center justify-center opacity-10">
                            @if(get_setting('logo_kiri'))
                                <img src="{{ Storage::url(get_setting('logo_kiri')) }}" class="w-2/3 h-2/3 object-contain" alt="Watermark Logo">
                            @endif
                        </div>

                        <div class="relative z-10 p-10 flex flex-col items-center text-center text-coklat-polisi min-h-[500px]">

                            <div class="w-full mb-6">
                                <h3 class="text-2xl font-semibold">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            </div>
                            <div class="w-full border-t border-yellow-500/30 mb-6"></div>

                            <h2 class="text-3xl font-extrabold mt-4 tracking-wider">PENTING!</h2>
                            <p class="mt-4 font-bold uppercase">
                                Harap melakukan pengajuan dana sebelum tanggal 5 bulan depan!
                                Sertakan surat pengajuan dana dan juga surat pertanggung jawaban dana bulan lalu!
                            </p>
                            <div class="mt-8">
                                <h3 class="font-bold text-lg">TATA CARA PENGAJUAN DANA :</h3>
                                <div class="mt-2 text-left inline-block">
                                    <p>1. MASUK DALAM AKUN POLSEK</p>
                                    <p>2. PILIH MENU AJUKAN ANGGARAN</p>
                                    <p>3. ISI FORMULIR YANG TERSEDIA</p>
                                    <p>4. MASUKAN BERKAS YANG DIBUTUHKAN</p>
                                    <p>5. PILIH MENU RIWAYAT PENGAJUAN</p>
                                    <p>6. LIHAT STATUS</p>
                                </div>
                            </div>
                            <p class="mt-6 font-semibold">CEK STATUS SECARA BERKALA UNTUK PENGAJUAN YANG DIAJUKAN</p>
                            <br>
                            <br>
                            <div class="mt-auto pt-10 font-extrabold text-gray-300 text-5xl tracking-widest uppercase">
                                Kepolisian Negara<br>Republik Indonesia
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
