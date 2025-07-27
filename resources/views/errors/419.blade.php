<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-fixed bg-center bg-cover px-6 py-20" style="background-image: url('{{ asset(get_setting('background_image')) ?? '' }}');">
        <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl max-w-2xl w-full p-10 text-center border border-gray-200">
            <div class="text-[120px] font-black text-kuning-polisi drop-shadow-lg leading-none">
                419
            </div>
            <h1 class="mt-4 text-4xl md:text-5xl font-bold text-coklat-polisi tracking-wide">
                Sesi Telah Habis
            </h1>
            <p class="mt-6 text-lg text-gray-700 leading-relaxed">
                Maaf, sesi Anda telah habis. Silakan login kembali untuk melanjutkan.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-coklat-polisi text-white font-semibold rounded-lg hover:bg-black transition duration-300 shadow-md">
                    Login Kembali
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
