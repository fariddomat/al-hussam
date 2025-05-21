<x-site-layout>
    <!-- Hero Section (Who We Are) -->
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
                        <div class="max-w-3xl mx-auto bg-navy/90 text-white rounded-lg p-8 shadow-lg">
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
        class="bg-gradient-to-b from-gray-50 to-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container pt-12 pb-12">
            @foreach (\App\Models\About::where('name', ['Mission'])->get() as $about)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative">
                    <!-- Image (Overlapping) -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="200"
                        class="md:absolute md:left-0 md:w-1/2">
                        <img src="{{ $about->img ? Storage::url($about->img) : asset('images/mission.jpg') }}"
                            alt="Mission" class="w-full h-80 md:h-[28rem] object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    </div>
                    <!-- Text Card -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="400"
                        class="md:ml-auto md:w-2/3 bg-white rounded-lg p-8 shadow-sm">
                        <h3 class="text-2xl font-medium text-blue-500 mb-4">رسالتنا</h3>
                        <div class="text-charcoal text-lg leading-relaxed">
                            {!! $about->discription !!}
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Values and Goals Section (Including Vision) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12">قيمنا وأهدافنا</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Values Cards -->
                @foreach (\App\Models\About::whereIn('name', ['Vision', 'Values'])->orderBy('sort_id')->get() as $about)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        x-intersect:delay="{{ ($loop->index + 1) * 200 }}"
                        class="bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <h3 class="text-xl font-medium text-navy mb-2 relative">
                            @if ($about->name == 'Vision')
                            رؤيتنا
                            @else
                            {{ $about->name == 'Success Standards' ? 'معايير النجاح' : 'قيمنا' }}

                            @endif
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                        </h3>
                        <div class="text-charcoal text-base leading-relaxed">
                            {!! $about->discription !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Work Environment Section (New Design) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative py-16 opacity-0 translate-y-10">
        <div class="absolute inset-0 bg-navy md:bg-gradient-to-r md:from-navy md:to-white"></div>
        <div class="container relative z-10">
            <h2 class="text-4xl md:text-6xl font-semibold text-white md:text-navy text-center mb-12">بيئة العمل</h2>
            @foreach (\App\Models\About::where('name', 'Work Environment')->get() as $about)
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <!-- Text -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="200"
                        class="md:w-1/2 bg-white rounded-lg p-8 shadow-md">
                        <h3 class="text-2xl font-medium text-blue-500 mb-4">بيئة عمل محفزة</h3>
                        <div class="text-charcoal text-lg leading-relaxed">
                            {!! $about->discription !!}
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('contact') }}"
                                class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:scale-105 transition-all duration-300">
                                تواصل معنا
                            </a>
                        </div>
                    </div>
                    <!-- Image -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="400"
                        class="md:w-1/2">
                        <img src="{{ $about->img ? Storage::url($about->img) : asset('images/work-environment.jpg') }}"
                            alt="Work Environment" class="w-full h-[32rem] object-cover rounded-lg shadow-md hover:rotate-2 transition-transform duration-300">
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Partners Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy mb-12">شركائنا</h2>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="flex animate-continuous-slide" x-data="{ pause: false }" @mouseenter="pause = true"
                    @mouseleave="pause = false">
                    <!-- Logos (Repeated for seamless loop) -->
                    <div class="flex flex-shrink-0">
                        @foreach ($partners as $partner)
                            <img src="{{ Storage::url($partner->img) }}" alt="{{ $partner->name ?? 'Partner' }}"
                                class="h-16 mx-6 filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300">
                        @endforeach
                    </div>
                    <!-- Duplicate Logos for Continuous Effect -->
                    <div class="flex flex-shrink-0">
                        @foreach ($partners as $partner)
                            <img src="{{ Storage::url($partner->img) }}" alt="{{ $partner->name ?? 'Partner' }}"
                                class="h-16 mx-6 filter grayscale hover:grayscale-0 hover:scale-110 transition-all duration-300">
                        @endforeach
                    </div>
                </div>
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

        .text-blue-500 {
            color: var(--blue-500);
        }

        .bg-blue-500 {
            background-color: var(--blue-500);
        }

        .bg-blue-600 {
            background-color: var(--blue-600);
        }

        .text-charcoal {
            color: var(--charcoal);
        }

        .bg-gray-50 {
            background-color: var(--gray-50);
        }

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
            animation: continuous-slide 30s linear infinite;
        }

        .animate-continuous-slide[x-data="{ pause: true }"] {
            animation-play-state: paused;
        }

        [dir="rtl"] .animate-continuous-slide {
            animation-direction: reverse;
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

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-80 {
                height: 16rem;
            }
            .h-\[32rem\] {
                height: 20rem;
            }
            .md\:h-\[28rem\] {
                height: 20rem;
            }
        }

        /* Disable Parallax on Mobile */
        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll !important;
            }
            .md\:bg-gradient-to-r {
                background: var(--navy);
            }
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

    <!-- Alpine.js and Parallax Script -->
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

        // Parallax Effect
        document.addEventListener('DOMContentLoaded', () => {
            const parallaxSections = document.querySelectorAll('[data-parallax]');
            parallaxSections.forEach(section => {
                const bg = section.querySelector('.parallax-bg');
                window.addEventListener('scroll', () => {
                    const rect = section.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const offset = window.pageYOffset - section.offsetTop;
                        bg.style.transform = `translateY(${offset * 0.3}px)`;
                    }
                });
            });
        });
    </script>
</x-site-layout>
