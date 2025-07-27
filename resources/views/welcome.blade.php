<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ get_setting('app_name') ?? 'Sistem Informasi' }}</title>
    <link rel="icon" href="{{ asset('img/logo_polda.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


</head>

<body class="antialiased bg-gray-50 font-sans overflow-x-hidden">
    <!-- Futuristic Loader -->
    <div class="loader-wrapper">
        <div class="loader-container">
            <div class="holographic-loader">
                <div class="holographic-plane"></div>
                <div class="holographic-grid">
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                    <div class="grid-line"></div>
                </div>
                <div class="loading-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>

                @if(get_setting('logo_kanan'))
                    <img src="{{ Storage::url(get_setting('logo_kanan')) }}" class="holographic-logo" alt="Logo Polri">
                @endif
            </div>
        </div>

        <div class="loader-text">
            <span class="loading-text">Memuat Sistem <strong>{{ get_setting('app_name') ?? config('app.name', 'Laravel') }}</strong></span>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
    </div>


        <!-- Floating Particles Background -->
        <div class="particles-background">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>


    <div class="flex flex-col min-h-screen">
        <!-- Holographic Navigation -->
            <header class="bg-white/90 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-200/30 transform -translate-y-full opacity-0 transition-all duration-500 ease-out" id="main-nav">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
                    <div class="flex items-center space-x-4">
                        @if(get_setting('logo_kanan'))
                            <div class="logo-container relative group">
                                <img src="{{ Storage::url(get_setting('logo_kanan')) }}" class="h-12 w-auto transition-all duration-300 group-hover:scale-110 group-hover:rotate-3" alt="Logo">
                                <div class="logo-halo"></div>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <a href="/" class="font-bold text-xl text-gray-800 leading-tight hover:text-blue-600 transition-colors relative group">
                                {{ get_setting('app_name') }}
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            @if(get_setting('app_tagline'))
                                <span class="text-xs text-gray-500 font-medium mt-0.5 tracking-wider">{{ get_setting('app_tagline') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-md hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 flex items-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:rotate-12 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <span class="relative">
                                    Dashboard
                                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
                                </span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-blue-600 font-medium px-3 py-1.5 rounded transition-all duration-300 hover:bg-gray-100/50 flex items-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:animate-bounce" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <span class="relative">
                                    Log in
                                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
                                </span>
                            </a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-md hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 flex items-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 group-hover:rotate-180 transition-transform duration-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="relative">
                                    Register
                                    <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
                                </span>
                            </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            </header>


        {{-- Main --}}
        <main class="flex-grow">
            {{-- Hero Slider --}}
            <section class="relative h-[70vh] w-full hero-animate">
                <div class="swiper-container h-full">
                    <div class="swiper-wrapper">
                        @foreach($sliders as $slide)
                            <div class="swiper-slide" style="background-image: url('{{ Storage::url($slide->image_path) }}')">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                                <div class="absolute inset-0 flex flex-col justify-end md:justify-center items-center text-white text-center p-6 z-10">
                                    <h1 class="text-4xl md:text-6xl font-extrabold drop-shadow-md">{{ $slide->title }}</h1>
                                    <p class="mt-4 max-w-2xl text-lg text-white/80">{{ $slide->subtitle }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next text-kuning-polisi"></div>
                    <div class="swiper-button-prev text-kuning-polisi"></div>
                </div>
            </section>

<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $videoEmbed = get_setting('welcome_video_type') == 'embed' && get_setting('welcome_video_embed');
            $videoUpload = get_setting('welcome_video_type') == 'upload' && get_setting('welcome_video_path');
            $hasVideo = $videoEmbed || $videoUpload;
        @endphp

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Kolom Informasi & Prosedur -->
            <div class="{{ $hasVideo ? 'lg:w-7/12' : 'w-full' }}">
                <h2 class="text-2xl font-bold text-coklat-polisi mb-4">Informasi & Prosedur</h2>
                <p class="text-gray-500 mb-6">Panduan dan penjelasan layanan publik kami.</p>

                <!-- Swiper Slider -->
                <div class="swiper informasiSwiper">
                    <div class="swiper-wrapper">
                        @foreach($sections as $section)
                            <div class="swiper-slide">
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all duration-300">
                                    @if($section->image)
                                        <div class="h-48 overflow-hidden rounded-t-lg">
                                            <img src="{{ Storage::url($section->image) }}" alt="{{ $section->title }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @endif
                                    <div class="p-5">
                                        <h3 class="text-lg font-semibold text-coklat-polisi mb-2">{{ $section->title }}</h3>
                                        <p class="text-gray-600 text-sm">{{ $section->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigasi panah -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            @if($hasVideo)
                <!-- Garis Pemisah Vertikal -->
                <div class="hidden lg:block border-l border-gray-200 mx-2"></div>

                <!-- Kolom Video -->
                <div class="lg:w-3/12">
                    <div class="sticky top-4 space-y-4">
                        @if(get_setting('welcome_video_title'))
                            <h3 class="text-xl font-bold text-coklat-polisi">{{ get_setting('welcome_video_title') }}</h3>
                        @endif

                        <div class="rounded-lg overflow-hidden shadow-md" style="height: 360px;">
                            @if($videoUpload)
                                <video autoplay loop muted playsinline
                                       class="w-full h-full object-cover"
                                       style="border-radius: 12px;">
                                    <source src="{{ Storage::url(get_setting('welcome_video_path')) }}" type="video/mp4">
                                </video>
                            @elseif($videoEmbed)
                                <div class="w-full h-full">
                                    {!! get_setting('welcome_video_embed') !!}
                                </div>
                            @endif
                        </div>

                        @if(get_setting('welcome_video_description'))
                            <p class="text-gray-600 text-sm">{{ get_setting('welcome_video_description') }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>



            {{-- Berita Terkini --}}
            {{-- Kontak & Peta --}}
            <section class="py-20 bg-gray-100 animate-section delay-200">
                <div class="max-w-7xl mx-auto px-6">
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden grid md:grid-cols-2">
                        {{-- Kontak --}}
                        <div class="p-10 space-y-6">
                            <h2 class="text-3xl font-bold text-muda-polisi">Kontak & Lokasi</h2>
                            <p class="text-gray-500">Hubungi kami atau datang langsung ke kantor kami.</p>

                            <div class="space-y-4 text-gray-700">
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-kuning-polisi" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <div>
                                        <h4 class="font-semibold text-coklat-polisi">Alamat</h4>
                                        <p>{{ get_setting('footer_address') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-kuning-polisi" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11 11 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <div>
                                        <h4 class="font-semibold text-coklat-polisi">Telepon</h4>
                                        <p>{{ get_setting('contact_phone') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <svg class="w-6 h-6 text-kuning-polisi" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <div>
                                        <h4 class="font-semibold text-coklat-polisi">Email</h4>
                                        <p>{{ get_setting('contact_email') }}</p>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('locator.index') }}" class="inline-block mt-6 px-6 py-3 bg-kuning-polisi text-white rounded-md font-semibold hover:bg-black transition">
                                Cari Kantor Polisi Lain
                            </a>
                        </div>

                        {{-- Google Maps --}}
                        <div class="w-full h-[450px]">
                            @if(get_setting('map_embed_code'))
                                @php
                                    $iframe_code = get_setting('map_embed_code');
                                    $iframe_code = preg_replace('/width="\d+"/', 'width="100%"', $iframe_code);
                                    $iframe_code = preg_replace('/height="\d+"/', 'height="100%"', $iframe_code);
                                @endphp
                                {!! $iframe_code !!}
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- Link Terkait --}}

            <!-- Related Links with Hover Effects -->
            <section id="link-terkait" class="py-20 bg-white relative overflow-hidden">
                <!-- Animated background elements -->
                <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                    <div class="floating-diamond diamond-1"></div>
                    <div class="floating-diamond diamond-2"></div>
                </div>

                <div class="max-w-7xl mx-auto px-6 relative">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-coklat-polisi mb-4">Link Terkait</h2>
                        <p class="mt-2 text-gray-500 text-lg max-w-2xl mx-auto">Situs resmi yang terhubung dengan layanan kami.</p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8 place-items-center">
                        @forelse($relatedLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" title="{{ $link->name }}"
                            class="transition-all duration-500 hover:scale-110 hover:drop-shadow-lg relative group">
                                <div class="link-logo-container p-4 bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-200/30 h-32 w-full flex items-center justify-center">
                                    <img src="{{ Storage::url($link->logo_path) }}"
                                        alt="{{ $link->name }}"
                                        class="h-16 w-auto object-contain grayscale group-hover:grayscale-0 transition duration-500" />
                                </div>
                                <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-blue-600 text-white text-xs font-medium px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                    {{ $link->name }}
                                </div>
                            </a>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada link terkait.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </main>

        {{-- Footer --}}
        <footer class="animate-section delay-400">
            @include('layouts.partials.footer')
        </footer>
    </div>
        <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 invisible flex items-center justify-center z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
@php
$aksesoris = [
    'top-left' => get_setting('aksesoris_kiri_atas'),
    'top-right' => get_setting('aksesoris_kanan_atas'),
    'bottom-left' => get_setting('aksesoris_kiri_bawah'),
    'bottom-right' => get_setting('aksesoris_kanan_bawah'),
];
@endphp

@foreach ($aksesoris as $posisi => $path)
    @if ($path)
        <img src="{{ asset('storage/' . $path) }}"
             class="fixed {{ str_replace('-', '-', $posisi) }} w-24 h-24 z-50 pointer-events-none"
             style="
                 @if($posisi == 'top-left') top: 0; left: 0;
                 @elseif($posisi == 'top-right') top: 0; right: 0;
                 @elseif($posisi == 'bottom-left') bottom: 0; left: 0;
                 @elseif($posisi == 'bottom-right') bottom: 0; right: 0;
                 @endif
             "
             alt="Aksesoris {{ $posisi }}">
    @endif
@endforeach



        <script>
// Fungsi animasi untuk konten di dalam slide
function animateSlideContent(slide) {
    const content = slide.querySelector('.slide-content');
    if (!content) return;

    gsap.fromTo(content,
        { opacity: 0, y: 50 },
        { opacity: 1, y: 0, duration: 1, ease: 'power3.out' }
    );
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.informasiSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
            }
        });
    });
</script>



    {{-- Swiper Script + Animasi Trigger --}}
    <script>
        // Script untuk loader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.loader-wrapper').style.opacity = '0';
                setTimeout(function() {
                    document.querySelector('.loader-wrapper').style.display = 'none';

                    // Trigger animasi untuk semua section setelah loader selesai
                    const animateSections = document.querySelectorAll('.animate-section, .hero-animate');
                    animateSections.forEach(section => {
                        section.classList.add('animated');
                    });
                }, 500);
            }, 1000);
        });

        // Script untuk Swiper
        document.addEventListener('DOMContentLoaded', function() {
            const swiperContainer = document.querySelector('.swiper-container');

            // Show loading spinner
            swiperContainer.classList.add('loading');

            // Initialize Swiper after images load
            const loadImages = Array.from(document.querySelectorAll('.swiper-slide')).map(slide => {
                const bgImage = slide.style.backgroundImage;
                if (!bgImage) return Promise.resolve();

                const imgUrl = bgImage.replace('url("', '').replace('")', '');
                return new Promise(resolve => {
                    const img = new Image();
                    img.src = imgUrl;
                    img.onload = resolve;
                    img.onerror = resolve; // Resolve even if image fails to load
                });
            });

            Promise.all(loadImages).then(() => {
                // Hide loading spinner
                swiperContainer.classList.remove('loading');

                // Initialize Swiper
                const swiper = new Swiper('.swiper-container', {
                    loop: true,
                    preloadImages: false,
                    lazy: true,
                    watchSlidesProgress: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    speed: 800,
                    effect: 'slide',
                    on: {
                        init: function() {
                            // Add initialized class
                            swiperContainer.classList.add('swiper-initialized');
                        }
                    }
                });
            });
        });

        // Fallback jika ada section yang belum ter-animate
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const sections = document.querySelectorAll('.animate-section');
                sections.forEach(section => {
                    if (!section.classList.contains('animated')) {
                        section.classList.add('animated');
                    }
                });
            }, 1500);
        });

         document.addEventListener('DOMContentLoaded', function() {
        const nav = document.getElementById('main-nav');

        // Set timeout untuk memastikan transisi terjadi setelah render
        setTimeout(() => {
            nav.classList.remove('transform', '-translate-y-full', 'opacity-0');
            nav.classList.add('translate-y-0', 'opacity-100');
        }, 50);

        // Tambahkan animasi hover untuk item menu
        const navItems = document.querySelectorAll('header a');
        navItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.classList.add('transform', 'scale-105');
            });
            item.addEventListener('mouseleave', () => {
                item.classList.remove('transform', 'scale-105');
            });
        });
    });

    // Loader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.loader-wrapper').style.opacity = '0';
                setTimeout(function() {
                    document.querySelector('.loader-wrapper').style.display = 'none';

                    // Initialize GSAP animations
                    initAnimations();
                }, 500);
            }, 2000);
        });

function initAnimations() {
    // Animate navigation
    gsap.to("#main-nav", {
        y: 0,
        opacity: 1,
        duration: 0.8,
        ease: "power3.out"
    });

    // Initialize Swiper
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        lazy: true,
        preloadImages: false,
        watchSlidesProgress: true,
        speed: 800,
        effect: 'slide',
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        on: {
            init: function () {
                document.querySelector('.swiper-container').classList.add('swiper-initialized');
                animateSlideContent(this.slides[this.activeIndex]);
            },
            slideChange: function () {
                animateSlideContent(this.slides[this.activeIndex]);
            }
        }
    });

    // Scroll-triggered animation
    gsap.utils.toArray('[class*="transform"]').forEach(element => {
        if (element.classList.contains('animated')) return;
        ScrollTrigger.create({
            trigger: element,
            start: "top 80%",
            onEnter: () => {
                element.classList.add('animated');
            }
        });
    });

    // Counters
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = +counter.getAttribute('data-target');
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        ScrollTrigger.create({
            trigger: counter,
            start: "top 80%",
            onEnter: () => updateCounter(),
            once: true
        });
    });
}


            // Hover effects for navigation items
            const navItems = document.querySelectorAll('header a');
            navItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    gsap.to(item, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
                item.addEventListener('mouseleave', () => {
                    gsap.to(item, {
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                });
            });

            // Logo hover effect
            const logoContainer = document.querySelector('.logo-container');
            if (logoContainer) {
                logoContainer.addEventListener('mouseenter', () => {
                    gsap.to('.logo-halo', {
                        scale: 1.2,
                        opacity: 1,
                        duration: 0.5
                    });
                });
                logoContainer.addEventListener('mouseleave', () => {
                    gsap.to('.logo-halo', {
                        scale: 1,
                        opacity: 0,
                        duration: 0.5
                    });
                });
            }

            // Floating particles animation
            const particles = document.querySelectorAll('.particle');
            particles.forEach((particle, index) => {
                gsap.to(particle, {
                    y: `+=${Math.random() * 100 - 50}`,
                    x: `+=${Math.random() * 100 - 50}`,
                    duration: 10 + Math.random() * 10,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                    delay: index * 0.5
                });
            });



    </script>
    <script>
    const backToTopButton = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible');
        }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

</body>
</html>
