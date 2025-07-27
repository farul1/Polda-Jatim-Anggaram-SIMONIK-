<x-guest-layout>
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <style>
            /* Futuristic color palette */
            :root {
                --tech-blue: #0ea5e9;
                --tech-dark: #0f172a;
                --tech-accent: #3b82f6;
                --tech-neon: #00f7ff;
                --tech-glass: rgba(255, 255, 255, 0.08);
            }

            /* Futuristic animations */
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }

            @keyframes pulse-glow {
                0%, 100% { box-shadow: 0 0 10px var(--tech-neon); }
                50% { box-shadow: 0 0 20px var(--tech-neon); }
            }

            @keyframes scanline {
                0% { background-position: 0 -100vh; }
                100% { background-position: 0 100vh; }
            }

            .animate-section {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.6s ease-out, transform 0.6s ease-out;
            }

            .animate-section.animated {
                opacity: 1;
                transform: translateY(0);
            }

            /* Futuristic background with scanlines */
            .tech-background {
                position: relative;
                background: var(--tech-dark);
                overflow: hidden;
            }

            .tech-background::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background:
                    linear-gradient(
                        rgba(14, 165, 233, 0.1) 1px,
                        transparent 1px
                    );
                background-size: 100% 4px;
                animation: scanline 4s linear infinite;
                pointer-events: none;
                z-index: 1;
            }

            /* Swiper styles with futuristic effects */
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
                background-size: cover;
                background-position: center;
                position: relative;
            }

            .swiper-slide::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(
                    to bottom,
                    rgba(15, 23, 42, 0.8) 0%,
                    rgba(15, 23, 42, 0.9) 100%
                );
            }

            .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* Futuristic glass panel */
            .tech-glass {
                backdrop-filter: blur(16px) saturate(180%);
                -webkit-backdrop-filter: blur(16px) saturate(180%);
                background: rgba(15, 23, 42, 0.7);
                border-radius: 16px;
                border: 1px solid rgba(59, 130, 246, 0.2);
                box-shadow:
                    0 8px 32px 0 rgba(31, 38, 135, 0.15),
                    0 0 0 1px rgba(255, 255, 255, 0.05);
                position: relative;
                overflow: hidden;
            }

            .tech-glass::before {
                content: "";
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: linear-gradient(
                    to bottom right,
                    rgba(59, 130, 246, 0.1) 0%,
                    rgba(59, 130, 246, 0) 50%,
                    rgba(59, 130, 246, 0.1) 100%
                );
                transform: rotate(30deg);
                z-index: 0;
            }

            /* Futuristic input fields */
            .tech-input {
                background: rgba(15, 23, 42, 0.5);
                border: 1px solid rgba(59, 130, 246, 0.3);
                color: white;
                border-radius: 8px;
                padding: 12px 16px;
                font-size: 14px;
                transition: all 0.3s ease;
                position: relative;
                z-index: 1;
            }

            .tech-input:focus {
                outline: none;
                border-color: var(--tech-neon);
                box-shadow: 0 0 0 2px rgba(0, 247, 255, 0.2);
                background: rgba(15, 23, 42, 0.7);
            }

            .tech-input::placeholder {
                color: rgba(255, 255, 255, 0.5);
            }

            /* Futuristic button */
            .tech-button {
                background: linear-gradient(135deg, var(--tech-accent) 0%, var(--tech-blue) 100%);
                color: white;
                border: none;
                border-radius: 8px;
                padding: 14px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1px;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                z-index: 1;
            }

            .tech-button:hover {
                transform: translateY(-2px);
                box-shadow:
                    0 5px 15px rgba(59, 130, 246, 0.4),
                    0 0 10px rgba(0, 247, 255, 0.2);
            }

            .tech-button::before {
                content: "";
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent
                );
                transition: all 0.5s ease;
                z-index: -1;
            }

            .tech-button:hover::before {
                left: 100%;
            }

            /* Eye toggle animations */
            .eye-toggle {
                transition: all 0.3s ease;
                cursor: pointer;
                color: rgba(255, 255, 255, 0.7);
            }

            .eye-toggle:hover {
                color: var(--tech-neon);
                transform: scale(1.1);
            }

            /* Checkbox style */
            .tech-checkbox {
                appearance: none;
                width: 18px;
                height: 18px;
                border: 1px solid rgba(59, 130, 246, 0.5);
                border-radius: 4px;
                background: rgba(15, 23, 42, 0.5);
                cursor: pointer;
                position: relative;
                transition: all 0.2s ease;
            }

            .tech-checkbox:checked {
                background: var(--tech-accent);
                border-color: var(--tech-accent);
            }

            .tech-checkbox:checked::after {
                content: "✓";
                position: absolute;
                color: white;
                font-size: 12px;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }

            /* Link styles */
            .tech-link {
                color: var(--tech-blue);
                transition: all 0.3s ease;
                position: relative;
                display: inline-block;
            }

            .tech-link:hover {
                color: var(--tech-neon);
            }

            .tech-link::after {
                content: "";
                position: absolute;
                bottom: -2px;
                left: 0;
                width: 0;
                height: 1px;
                background: var(--tech-neon);
                transition: width 0.3s ease;
            }

            .tech-link:hover::after {
                width: 100%;
            }

            /* Header styles */
            .tech-header {
                background: linear-gradient(135deg, rgba(14, 165, 233, 0.2) 0%, rgba(15, 23, 42, 0.8) 100%);
                border-bottom: 1px solid rgba(59, 130, 246, 0.3);
                position: relative;
                overflow: hidden;
            }

            .tech-header::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, var(--tech-neon), transparent);
                box-shadow: 0 0 10px var(--tech-neon);
            }

            /* Logo animation */
            .tech-logo {
                filter: drop-shadow(0 0 5px rgba(14, 165, 233, 0.5));
                transition: all 0.5s ease;
            }

            .tech-logo:hover {
                filter: drop-shadow(0 0 10px rgba(0, 247, 255, 0.7));
                transform: scale(1.05);
            }

            /* Floating elements */
            .float-animation {
                animation: float 6s ease-in-out infinite;
            }

            /* Glowing elements */
            .glow-effect {
                transition: all 0.3s ease;
            }

            .glow-effect:hover {
                box-shadow: 0 0 15px rgba(0, 247, 255, 0.5);
            }

            /* Digital font for headings */
            @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&display=swap');

            .digital-font {
                font-family: 'Orbitron', sans-serif;
                letter-spacing: 1px;
            }

            /* Responsive adjustments */
            @media (max-width: 640px) {
                .tech-glass {
                    border-radius: 0;
                    border-left: none;
                    border-right: none;
                }
            }
        </style>
    @endpush

    <div class="relative w-full min-h-screen tech-background">
        <!-- Hero Slider -->
        <div class="swiper-container absolute inset-0 w-full h-full">
            <div class="swiper-wrapper">
                @forelse($sliders as $slide)
                    <div class="swiper-slide">
                        <img src="{{ Storage::url($slide->image_path) }}"
                            class="w-full h-full object-cover"
                            alt="Slider Image">
                    </div>
                @empty
                    <div class="swiper-slide">
                        <img src="{{ asset('images/default-slider.jpg') }}"
                            class="w-full h-full object-cover"
                            alt="Default Slider">
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Grid overlay for tech effect -->
        <div class="absolute inset-0 opacity-20" style="
            background-image:
                linear-gradient(rgba(14, 165, 233, 0.2) 1px, transparent 1px),
                linear-gradient(90deg, rgba(14, 165, 233, 0.2) 1px, transparent 1px);
            background-size: 40px 40px;
        "></div>

        <!-- Glowing particles -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-2 h-2 rounded-full bg-blue-400 opacity-70 animate-pulse"></div>
            <div class="absolute top-1/3 right-1/3 w-1 h-1 rounded-full bg-cyan-400 opacity-70 animate-pulse" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-3 h-3 rounded-full bg-blue-500 opacity-50 animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 right-1/4 w-1 h-1 rounded-full bg-cyan-300 opacity-70 animate-pulse" style="animation-delay: 1.5s;"></div>
        </div>

        <!-- Login Form Container -->
        <div class="relative z-10 flex items-center justify-center min-h-screen px-4 sm:px-0">
            <div class="w-full max-w-md overflow-hidden animate-section tech-glass float-animation">
                <!-- Header with tech effect -->
                <div class="tech-header px-8 py-6 text-center">
                    @if(get_setting('logo_kiri'))
                        <img src="{{ Storage::url(get_setting('logo_kiri')) }}"
                             class="h-12 mx-auto mb-2 tech-logo"
                             alt="Logo">
                    @endif
                    <h2 class="text-2xl font-bold text-white digital-font tracking-wider">
                        {{ get_setting('app_name') }}
                    </h2>
                    @if(get_setting('app_tagline'))
                        <p class="text-sm text-cyan-300 mt-1">
                            {{ get_setting('app_tagline') }}
                        </p>
                    @endif
                </div>
<!-- Konten Form -->
<div class="p-8 sm:p-8 bg-gradient-to-b from-slate-900/70 to-slate-900/90">
    <div class="text-center mb-8">
        <h3 class="text-xl font-bold text-white digital-font tracking-wider">Login</h3>
        <p class="text-gray-400 mt-2 text-sm">Akses System</p>
    </div>

    <x-auth-session-status class="mb-4 text-cyan-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Input Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-400 mb-1">
                <span class="text-cyan-400">></span> Alamat Email
            </label>
            <div class="relative">
                <input id="email"
                       class="tech-input w-full"
                       type="email"
                       name="email"
                       :value="old('email')"
                       required
                       autofocus
                       placeholder="user@domain.com">
                <div class="absolute right-3 top-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-cyan-400" />
        </div>

        <!-- Input Password dengan Toggle -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-400 mb-1">
                <span class="text-cyan-400">></span> Kata Sandi
            </label>
            <div class="relative">
                <input id="password"
                       class="tech-input w-full pr-10"
                       type="password"
                       name="password"
                       required
                       placeholder="••••••••">
                <button type="button"
                        onclick="togglePassword(this, 'password')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center eye-toggle"
                        aria-label="Tampilkan/sembunyikan password">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd"
                              d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-cyan-400" />
        </div>

        <!-- Remember & Lupa Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center text-sm text-gray-400 cursor-pointer">
                <input id="remember_me"
                       type="checkbox"
                       class="tech-checkbox mr-2"
                       name="remember">
                <span>Ingat kredensial</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm tech-link">
                    Lupa sandi?
                </a>
            @endif
        </div>

        <!-- Tombol Submit -->
        <button type="submit"
                class="tech-button w-full flex items-center justify-center gap-2 glow-effect">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                 viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                      clip-rule="evenodd" />
            </svg>
            MASUK
        </button>
    </form>

    <!-- Link Daftar -->
    <div class="mt-8 text-center text-sm text-gray-400">
        Pengguna baru?
        <a href="{{ route('register') }}" class="tech-link font-medium ml-1">
            Register
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1"
                 viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                      clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>


@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Fungsi untuk toggle password dengan animasi mata
        function togglePassword(button, fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = button.querySelector('svg');

            if (!field) return; // Jika field tidak ditemukan, hentikan fungsi

            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = '<path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                button.classList.add('text-cyan-400');
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = '<path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />';
                button.classList.remove('text-cyan-400');
            }

            // Animasi bounce
            button.classList.add('animate-bounce');
            setTimeout(() => {
                button.classList.remove('animate-bounce');
            }, 300);
        }
    </script>
@endpush
</x-guest-layout>
