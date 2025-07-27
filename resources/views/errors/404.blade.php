<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-fixed bg-center bg-cover px-6 py-20" style="background-image: url('{{ asset(get_setting('background_image')) ?? '' }}');">
        <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl max-w-2xl w-full p-10 text-center border border-gray-200">
            <div class="text-[120px] font-black text-kuning-polisi drop-shadow-lg leading-none">
                404
            </div>
            <h1 class="mt-4 text-4xl md:text-5xl font-bold text-coklat-polisi tracking-wide">
                Halaman Tidak Ditemukan
            </h1>
            <p class="mt-6 text-lg text-gray-700 leading-relaxed">
                Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-coklat-polisi text-white font-semibold rounded-lg hover:bg-black transition duration-300 shadow-md">
                    Kembali ke Dashboard
                </a>
                <a href="javascript:history.back()" class="px-6 py-3 border border-gray-400 text-gray-700 font-semibold rounded-lg hover:bg-gray-100 transition duration-300">
                    Kembali ke Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
