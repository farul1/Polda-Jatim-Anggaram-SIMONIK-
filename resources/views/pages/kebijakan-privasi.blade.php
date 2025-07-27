<x-guest-layout>
    <div class="py-12" style="background-image: url('{{ asset(get_setting('background_image')) ?? '' }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-lg shadow-2xl sm:rounded-2xl overflow-hidden">
                <div class="p-8 md:p-12">
                    <h1 class="text-4xl font-extrabold text-coklat-polisi tracking-tight">Kebijakan Privasi</h1>
                    <p class="mt-2 text-base text-gray-500">
                        Terakhir diperbarui: <strong>{{ get_setting('privacy_policy_last_updated') ?? now()->isoFormat('DD MMMM YYYY') }}</strong>
                    </p>

                    <div class="mt-6 border-t border-gray-300"></div>

                    {{-- Tampilkan Konten --}}
                    <div class="prose prose-lg max-w-none mt-8 text-gray-700">
                        {!! get_setting('privacy_policy_content') !!}
                    </div>

                    {{-- Tombol Kembali --}}
                    <div class="mt-8 pt-8 border-t border-gray-300">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-semibold text-coklat-polisi hover:underline">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
