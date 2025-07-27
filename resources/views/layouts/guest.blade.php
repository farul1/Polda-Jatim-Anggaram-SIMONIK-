<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo_polda.png') }}" type="image/x-icon">
    <title>{{ get_setting('app_name') ?? 'SIMONIK' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Slot untuk CSS tambahan dari halaman lain --}}
    @stack('styles')
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

    {{-- Header --}}
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
    {{-- Main Content --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer>
        @include('layouts.partials.footer')
    </footer>

</div>

{{-- Slot untuk Script tambahan dari halaman lain --}}
@stack('scripts')


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
