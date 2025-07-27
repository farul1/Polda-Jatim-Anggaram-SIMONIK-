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

            /* Input Styles */
            .glass-input {
                background: rgba(255, 255, 255, 0.7);
                border: 1px solid rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(5px);
            }

            /* Password Toggle */
            .password-toggle {
                cursor: pointer;
                transition: all 0.3s ease;
            }
            .password-toggle:hover {
                transform: scale(1.1);
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

        <!-- Password Confirmation Container -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-4 py-8">
            <div class="w-full max-w-md rounded-2xl overflow-hidden animate-fade-in-up glass-card">
                <!-- Header -->
                <div class="bg-coklat-polisi/90 px-8 py-6 text-center">
                    @if(get_setting('logo_kiri'))
                        <img src="{{ Storage::url(get_setting('logo_kiri')) }}" class="h-12 mx-auto mb-2" alt="Logo">
                    @endif
                    <h2 class="text-2xl font-bold text-white/95">{{ get_setting('app_name') }}</h2>
                    @if(get_setting('app_tagline'))
                        <p class="text-sm text-yellow-300/90 mt-1">{{ get_setting('app_tagline') }}</p>
                    @endif
                </div>

                <!-- Form Content -->
                <div class="p-8 sm:p-10 bg-white/80">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Konfirmasi Password 🔒</h3>
                        <p class="text-gray-600 mt-2">Ini adalah area aman. Mohon konfirmasi password Anda untuk melanjutkan.</p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                        @csrf

                        <!-- Password Input -->
                        <div>
                            <x-input-label for="password" value="🔑 Password" class="font-medium text-gray-700"/>
                            <div class="relative">
                                <x-text-input id="password" class="glass-input block mt-1 w-full p-3 pr-10 rounded-lg"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                                <span onclick="togglePassword('password')"
                                    class="password-toggle absolute right-3 bottom-3 text-gray-600 hover:text-coklat-polisi text-xl">
                                    👁️
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full py-3 px-4 bg-kuning-polisi/90 text-coklat-polisi font-bold rounded-lg hover:bg-yellow-300/95 transition duration-300">
                            KONFIRMASI 🚀
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    @endpush
</x-guest-layout>
