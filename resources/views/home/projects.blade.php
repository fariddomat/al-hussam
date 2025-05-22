<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[100vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg transition-transform duration-1000"
            style="background-image: url('{{ asset('images/sections/Project hero.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/80 to-navy/60"></div>
            <!-- Centered Content -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="h-full flex items-center">
                <div class="container">
                    <div class="max-w-3xl mx-auto bg-white/50 rounded-lg p-8">
                        <div class="text-center">
                            <h1 class="text-4xl md:text-6xl font-semibold text-navy mb-4">مشاريعنا المتميزة</h1>
                            <p class="text-lg md:text-xl text-charcoal">استكشف مجموعتنا المتنوعة من المشاريع العقارية المبتكرة</p>
                        </div>
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="mt-8 text-center opacity-0 scale-95">
                            <a href="#categories"
                                class="inline-block px-8 py-4 bg-blue-500 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                                استكشف المزيد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Categories Section (Swiper Carousel) -->
    <section id="categories" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                المشاريع
            </h2>
            @if ($categories->isNotEmpty())
                <div class="w-full relative">
                    <div class="swiper centered-slide-carousel swiper-container relative">
                        <div class="swiper-wrapper">
                            @foreach ($projects as $index => $project)
                                <div class="swiper-slide">
                                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                         x-intersect:delay="{{ ($index * 100) }}"
                                         class="group material-card h-auto">
                                        <div class="relative bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-2 hover:opacity-100 hover:filter-none ripple">

                                            <!-- Image -->
                                            <a  href="{{ route('projects.show', $project->slug) }}">
                                                <img src="{{ $project->img ? Storage::url($project->img) : asset('images/default-project.jpg') }}"
                                                     alt="{{ $project->name }}"
                                                     class="w-full h-64 object-cover rounded-t-inherit swiper-lazy">
                                            </a>
                                            <!-- Content -->
                                            <div class="p-6 pt-16">
                                                <h3 class="text-xl font-medium text-navy mb-2">{{ $project->name }}</h3>
                                                <p class="text-charcoal text-base leading-relaxed">{!! \Illuminate\Support\Str::limit(strip_tags($project->description), 100) !!}</p>
                                            </div>
                                            <!-- Decorative Border -->
                                            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-transparent"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation Arrows -->
                        <div class="swiper-button-prev">
                        </div>
                        <div class="swiper-button-next">
                        </div>
                        <!-- Pagination Dots -->
                        <div class="swiper-pagination"></div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            if (typeof Swiper === 'undefined') {
                                console.error('Swiper.js is not loaded. Ensure Swiper is included in your JavaScript bundle.');
                                return;
                            }
                            new Swiper('.centered-slide-carousel', {
                                centeredSlides: true,
                                loop: true,
                                spaceBetween: 30,
                                slideToClickedSlide: true,
                                pagination: {
                                    el: '.centered-slide-carousel .swiper-pagination',
                                    clickable: true,
                                },
                                navigation: {
                                    nextEl: '.swiper-button-next',
                                    prevEl: '.swiper-button-prev',
                                },
                                breakpoints: {
                                    990: {
                                        slidesPerView: 1,
                                        spaceBetween: 0,
                                    },
                                    1028: {
                                        slidesPerView: 3,
                                        spaceBetween: 20,
                                    },
                                    1280: {
                                        slidesPerView: 3,
                                        spaceBetween: 30,
                                    },
                                },
                                on: {
                                    slideChange: function () {
                                        const slides = document.querySelectorAll('.centered-slide-carousel .swiper-slide');
                                        slides.forEach((slide, index) => {
                                            if (slide.classList.contains('swiper-slide-active')) {
                                            } else {
                                            }
                                        });
                                    },
                                },
                            });
                        });
                    </script>
                </div>
            @else
                <div class="max-w-md mx-auto bg-white rounded-xl shadow-md p-8 text-center material-card">
                    <p class="text-charcoal text-lg mb-4">لا توجد فئات مشاريع متاحة حاليًا</p>
                    <a @click="contactOpen = true" href="#"
                       class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                        تواصل معنا
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy mb-6 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                هل أنت مستعد لبدء مشروعك؟
            </h2>
            <p class="text-charcoal text-lg mb-8 max-w-2xl mx-auto">
                تواصل معنا اليوم لمناقشة رؤيتك وتحويلها إلى واقع مع الحسام.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                 class="opacity-0 scale-95">
                <a @click="contactOpen = true" href="#"
                   class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                    تواصل معنا
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Animations and Styles -->
    <style>
        :root {
            --navy: #1e3a8a;
            --blue-500: #d4af37;
            --blue-600: #b8972e;
            --charcoal: #374151;
            --gray-50: #f1f5f9;
        }

        .bg-navy {
            background-color: var(--navy);
        }

        .text-navy {
            color: var(--navy);
        }


        .text-charcoal {
            color: var(--charcoal);
        }

        .bg-gray-50 {
            background-color: var(--gray-50);
        }

        /* Swiper Styles */
        .swiper-wrapper {
            width: 100%;
            height: max-content !important;
            padding-bottom: 64px !important;
            -webkit-transition-timing-function: ease-in-out !important;
            transition-timing-function: ease-in-out !important;
            position: relative;
        }

        .swiper-pagination-bullet {
            background: var(--charcoal);
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            background: var(--navy) !important;
            opacity: 1;
            transform: scale(1.25);
        }

        /* Animations */
        @keyframes fade-in-slide-up {
            from {
                transform: translateY(10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in-scale {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes gradient-shift {
            0% {
                background-position: 200% center;
            }
            100% {
                background-position: 0% center;
            }
        }

        @keyframes ripple-effect {
            0% {
                transform: scale(0);
                opacity: 0.4;
            }
            100% {
                transform: scale(4);
                opacity: 0;
            }
        }

        .button-scroll-effect {
            background-size: 200% auto;
            animation: gradient-shift 3s ease-in-out forwards;
        }

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.7s ease-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.7s ease-out forwards;
        }

        /* Material Design Ripple Effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.3);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1);
            pointer-events: none;
        }

        .ripple:active::after {
            animation: ripple-effect 0.6s ease-out;
        }

        /* Slider Styles */
        .filter.blur-sm {
            filter: blur(2px);
        }



        button[aria-label], .swiper-button-prev, .swiper-button-next {
            cursor: pointer;
        }

        /* Material Card Styling */
        .material-card {
            position: relative;
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .material-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .material-card img.rounded-t-inherit {
            border-top-left-radius: inherit;
            border-top-right-radius: inherit;
        }

        /* Parallax */
        .parallax-bg {
            will-change: transform;
            transition: transform 0.5s ease-out;
        }

        /* RTL Adjustments */
        [dir="rtl"] .text-right {
            text-align: right;
        }

        [dir="rtl"] .swiper-button-prev {
            left: auto;
            right: 1.5rem;
        }

        [dir="rtl"] .swiper-button-next {
            right: auto;
            left: 1.5rem;
        }

        [dir="rtl"] .fa-chevron-left {
            transform: rotate(180deg);
        }

        [dir="rtl"] .fa-chevron-right {
            transform: rotate(180deg);
        }

        [dir="rtl"] .swiper-pagination {
            direction: ltr;
        }


        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-64 {
                height: 16rem;
            }
            .h-72 {
                height: 18rem;
            }
            .swiper-slide {
                width: 100% !important;
            }
            .scale-105 {
                transform: scale(1);
            }
            .opacity-75.filter.blur-sm {
                opacity: 1;
                filter: none;
            }
            .swiper-pagination-bullet {
                width: 12px;
                height: 12px;
            }
        }

        /* Disable Parallax on Mobile */
        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll !important;
            }
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            .animate-section,
            .animate-item,
            .button-scroll-effect,
            .ripple::after,
            .material-card {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
            }
            .material-card:hover {
                transform: none !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            }
        }

                .swiper-slide-next,
        .swiper-slide-prev {
            filter: blur(1px);

                transform: scale(1.2);
                height: 72%;
        }
        .swiper-slide-active
        {
            filter: none;

                transform: scale(1);
        }
    </style>
</x-site-layout>
