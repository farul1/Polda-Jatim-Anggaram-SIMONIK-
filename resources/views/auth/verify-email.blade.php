<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <style>
            /* Glassmorphism Effect */
            .glass-card {
                backdrop-filter: blur(16px) saturate(180%);
                -webkit-backdrop-filter: blur(16px) saturate(180%);
                background: rgba(255, 255, 255, 0.85);
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.18);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            }

            /* Animations */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out forwards;
            }

            /* Swiper Background */
            .swiper-container {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: 0;
                overflow: hidden;
            }
            .swiper-slide {
                will-change: transform;
                width: 100%;
                height: 100%;
            }
        </style>
    @endpush

    <div class="relative w-full min-h-screen">
        <!-- Background Slider -->
        <div class="swiper-container absolute inset-0 w-full h-full">
            <div class="swiper-wrapper">
                @forelse($sliders as $slide)
                    <div class="swiper-slide bg-cover bg-center" style="background-image: url('{{ Storage::url($slide->image_path) }}');"></div>
                @empty
                    <div class="swiper-slide bg-cover bg-center" style="background-image: url('{{ asset('images/default-slider.jpg') }}');"></div>
                @endforelse
            </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

        <!-- Verification Container -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-4 py-8">
            <div class="w-full max-w-md rounded-2xl overflow-hidden animate-fade-in-up glass-card">
                <!-- Header -->
                <div class="bg-coklat-polisi/90 px-8 py-6 text-center">
                    @if(get_setting('logo_kiri'))
                        <img src="{{ Storage::url(get_setting('logo_kiri')) }}" class="h-12 mx-auto mb-2" alt="Logo">
                    @endif
                    <h2 class="text-2xl font-bold text-white/95">Verifikasi Email ✉️</h2>
                    <p class="text-sm text-yellow-300/90 mt-1">sistem Informasi Monitoring IKPA</p>
                </div>

                <!-- Content -->
                <div class="p-8 sm:p-10 bg-white/80">
                    <div class="mb-4 text-sm text-gray-700">
                        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang kami kirimkan. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang baru.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                        </div>
                    @endif

                    <div class="mt-6 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-kuning-polisi/90 text-coklat-polisi font-medium rounded-lg hover:bg-yellow-300/95 transition duration-300">
                                {{ __('Kirim Ulang Email Verifikasi') }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-coklat-polisi hover:underline">
                                {{ __('Keluar') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @endpush
</x-guest-layout>
