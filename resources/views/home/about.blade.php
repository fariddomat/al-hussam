<x-site-layout>
    <!-- Hero Section (Unchanged) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[100vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg transition-transform duration-1000"
            style="background-image: url('{{ asset('images/sections/about-us.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/80 to-navy/60"></div>
            <!-- Who We Are Content -->
            <div id="who-we-are" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')" class="h-full flex items-center">
                <div class="container">
                    @foreach (\App\Models\About::where('name', 'Who We Are')->get() as $about)
                        <div class="max-w-3xl mx-auto bg-navy/90 text-white rounded-lg p-8 shadow-lg" style="background:#00000036;">
                            <h2 class="text-4xl md:text-6xl font-semibold text-center mb-6">من نحن</h2>
                            <div class="text-lg leading-relaxed text-center" style="text-align: justify">
                                {!! $about->discription !!}
                            </div>
                            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                class="mt-8 text-center opacity-0 scale-95">
                                <a href="{{ route('project-categories') }}"
                                    class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:scale-105 hover:shadow-xl transition-all duration-300">
                                    تصفح مشاريعنا
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Mission Section -->
    <section id="mission" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gradient-to-b from-gray-100 to-white py-20 opacity-0 translate-y-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @foreach (\App\Models\About::where('name', ['Mission'])->get() as $about)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center relative">
                    <!-- Image -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="200"
                        class="relative overflow-hidden rounded-xl shadow-lg group">
                        <img src="{{ $about->img ? Storage::url($about->img) : asset('images/mission.jpg') }}"
                            alt="Mission" class="w-full h-64 sm:h-80 lg:h-96 object-cover transform group-hover:scale-105 transition-transform duration-500 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <!-- Text Card -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="400"
                        class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-3xl font-semibold text-blue-600 mb-4">رسالتنا</h3>
                        <div class="text-gray-700 text-lg leading-relaxed">
                            {!! $about->discription !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Values and Goals Section (Including Vision with Images) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-20 opacity-0 translate-y-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl sm:text-5xl font-bold text-navy text-center mb-16">قيمنا وأهدافنا</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach (\App\Models\About::whereIn('name', ['Vision', 'Values'])->orderBy('sort_id')->get() as $about)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        x-intersect:delay="{{ ($loop->index + 1) * 200 }}"
                        class="relative bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 group overflow-hidden">
                        <!-- Image -->
                        <div class="relative mb-4">
                            <img src="{{ $about->img ? Storage::url($about->img) : asset('images/' . ($about->name == 'Vision' ? 'vision.jpg' : 'values.jpg')) }}"
                                alt="{{ $about->name }}" class="w-full h-48 object-cover rounded-lg transform group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <!-- Text -->
                        <h3 class="text-xl font-semibold text-navy mb-3 relative">
                            @if ($about->name == 'Vision')
                                رؤيتنا
                            @else
                                {{ $about->name == 'Success Standards' ? 'معايير النجاح' : 'قيمنا' }}
                            @endif
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
                        </h3>
                        <div class="text-gray-700 text-base leading-relaxed">
                            {!! $about->discription !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Work Environment Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative py-20 opacity-0 translate-y-10">
        <div class="absolute inset-0 bg-gradient-to-br from-navy to-blue-900/90"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h2 class="text-4xl sm:text-5xl font-bold text-white text-center mb-16">بيئة العمل</h2>
            @foreach (\App\Models\About::where('name', 'Work Environment')->get() as $about)
                <div class="flex flex-col lg:flex-row gap-10 items-center">
                    <!-- Text -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="200"
                        class="lg:w-1/2 bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-3xl font-semibold text-blue-600 mb-4">بيئة عمل محفزة</h3>
                        <div class="text-gray-700 text-lg leading-relaxed">
                            {!! $about->discription !!}
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('contact') }}"
                                class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:scale-105 hover:shadow-lg transition-all duration-300">
                                تواصل معنا
                            </a>
                        </div>
                    </div>
                    <!-- Image -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="400"
                        class="lg:w-1/2 relative overflow-hidden rounded-xl shadow-lg group">
                        <img src="{{ $about->img ? Storage::url($about->img) : asset('images/work-environment.jpg') }}"
                            alt="Work Environment" class="w-full h-64 sm:h-80 lg:h-96 object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Partners Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-20 opacity-0 translate-y-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold text-navy mb-16">شركائنا</h2>
            <div class="bg-gray-50 rounded-xl shadow-lg overflow-hidden py-6">
                <div class="flex animate-continuous-slide" x-data="{ pause: false }" @mouseenter="pause = true"
                    @mouseleave="pause = false">
                    <!-- Logos (Repeated for seamless loop) -->
                    <div class="flex flex-shrink-0 space-x-8">
                        @foreach ($partners as $partner)
                            <img src="{{ Storage::url($partner->img) }}" alt="{{ $partner->name ?? 'Partner' }}"
                                class="h-20 mx-4 filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300">
                        @endforeach
                    </div>
                    <!-- Duplicate Logos for Continuous Effect -->
                    <div class="flex flex-shrink-0 space-x-8">
                        @foreach ($partners as $partner)
                            <img src="{{ Storage::url($partner->img) }}" alt="{{ $partner->name ?? 'Partner' }}"
                                class="h-20 mx-4 filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Updated Styles -->
    <style>
        :root {
            --navy: #1e3a8a;
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-700: #4b5563;
            --white: #ffffff;
        }

        .bg-navy {
            background-color: var(--navy);
        }

        .text-navy {
            color: var(--navy);
        }

        .text-blue-600 {
            color: var(--blue-600);
        }

        .bg-blue-600 {
            background-color: var(--blue-600);
        }

        .bg-blue-700 {
            background-color: var(--blue-700);
        }

        .text-gray-700 {
            color: var(--gray-700);
        }

        .bg-gray-50 {
            background-color: var(--gray-50);
        }

        .bg-gray-100 {
            background-color: var(--gray-100);
        }

        /* Animations */
        @keyframes fade-in-slide-up {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
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

        @keyframes continuous-slide {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.8s ease-out forwards;
        }

        .animate-item.fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.8s ease-out forwards;
        }

        .animate-continuous-slide {
            animation: continuous-slide 25s linear infinite;
        }

        .animate-continuous-slide[x-data="{ pause: true }"] {
            animation-play-state: paused;
        }

        [dir="rtl"] .animate-continuous-slide {
            animation-direction: reverse;
        }

        /* Typography */
        h2, h3 {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-64 {
                height: 16rem;
            }
            .h-80 {
                height: 20rem;
            }
            .h-96 {
                height: 24rem;
            }
        }

        /* RTL Adjustments */
        [dir="rtl"] .text-right {
            text-align: right;
        }

        [dir="rtl"] .group:hover .w-0 {
            right: 0;
            left: auto;
        }

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {
            .animate-section,
            .animate-item,
            img {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
                transition: none !important;
            }
        }
    </style>

    <!-- Alpine.js and Parallax Script (Unchanged) -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('intersect', (el, { value, expression }, { evaluate, cleanup }) => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const delay = parseInt(el.getAttribute('x-intersect:delay') || '0', 10);
                            setTimeout(() => {
                                evaluate(expression);
                            }, delay);
                            observer.unobserve(el);
                        }
                    });
                }, { threshold: 0.1 });
                observer.observe(el);
                cleanup(() => observer.disconnect());
            });
        });
    </script>
</x-site-layout>
