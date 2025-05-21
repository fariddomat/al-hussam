<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[100vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg transition-transform duration-1000"
            style="background-image: url('{{ asset('images/sections/Register interest hero.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/80 to-navy/60"></div>
            <!-- Centered Title -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="h-full flex items-center">
                <div class="container">
                    <div class="max-w-3xl mx-auto bg-navy/90 text-white rounded-lg p-8 shadow-lg">
                        <div class="text-center">
                            <h1 class="text-4xl md:text-6xl font-semibold mb-4">خدماتنا</h1>
                            <p class="text-lg md:text-xl text-gray-200">حلول عقارية مبتكرة لتلبية تطلعاتكم</p>
                        </div>
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="mt-8 text-center opacity-0 scale-95">
                            <a href="#services"
                                class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-xl transition-all duration-500">
                                استكشف المزيد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section id="services" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12">خدماتنا</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($services as $index => $service)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        x-intersect:delay="{{ $index * 200 }}"
                        class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg hover:scale-102 transition-all duration-300 group">
                        <!-- Thumbnail Image -->
                        {{-- <img src="{{ $service->image ? Storage::url($service->image) : asset('images/services/placeholder.jpg') }}"
                            alt="{{ $service->name }}" class="w-full h-48 object-cover rounded-md mb-4"> --}}
                        <!-- Name with Icon -->
                        <div class="flex items-center mb-2">
                            <i class="{{ $service->icon ?? 'fas fa-cog' }} text-2xl text-blue-500 mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                            <h3 class="text-xl font-medium text-navy relative">
                                {{ $service->name }}
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                            </h3>
                        </div>
                        <!-- Divider -->
                        <hr class="border-gray-200 my-4">
                        <!-- Description -->
                        <p class="text-charcoal text-base leading-relaxed mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($service->description), 150) !!}</p>
                        <!-- CTA -->
                        <a wire:navigate href="{{ route('services.show', $service->slug) }}"
                            class="text-blue-500 hover:underline font-medium">عرض المزيد</a>
                    </div>
                @endforeach
            </div>
            @if ($services->isEmpty())
                <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 text-center">
                    <p class="text-charcoal text-lg mb-4">لا توجد خدمات متاحة حالياً</p>
                    <a href="{{ route('contact') }}"
                        class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-xl transition-all duration-500">
                        تواصل معنا
                    </a>
                </div>
            @endif
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

        .button-scroll-effect {
            background-size: 200% auto;
            animation: gradient-shift 3s ease-in-out forwards;
        }

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.8s ease-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.8s ease-out forwards;
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

        [dir="rtl"] .flex.items-center .mr-2 {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-48 {
                height: 12rem;
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
            .button-scroll-effect {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
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
