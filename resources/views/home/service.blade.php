<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[100vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg transition-transform duration-1000"
            style="background-image: url('{{ $service->img ? Storage::url($service->img) : asset('images/service-details.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/80 to-navy/60"></div>
            <!-- Centered Content -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="h-full flex items-center">
                <div class="container">
                    <div class="max-w-3xl mx-auto bg-white/90 text-navy rounded-lg p-8 shadow-lg">
                        <div class="text-center">
                            <h1 class="text-4xl md:text-6xl font-semibold mb-4">{{ $service->name }}</h1>
                            <p class="text-lg md:text-xl text-charcoal">حلول عقارية مبتكرة لتحقيق تطلعاتك</p>
                        </div>
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="mt-8 text-center opacity-0 scale-95">
                            <a href="#details"
                                class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-xl transition-all duration-500">
                                استكشف التفاصيل
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Details Section -->
    <section id="details" x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-8 relative group">
                {{ $service->name }}
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
            </h2>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="200"
                class="max-w-3xl mx-auto">
                <p class="text-charcoal text-lg leading-relaxed mb-6" style="text-align: justify">
                    {!! $service->description !!}
                </p>
                @if (!empty($service->features))
                    <div class="space-y-4">
                        @foreach ($service->features as $feature)
                            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                x-intersect:delay="{{ $loop->index * 100 }}"
                                class="flex items-center text-charcoal text-base hover:translate-x-2 transition-transform duration-300">
                                <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                <span>{!! $feature !!}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in')" x-intersect:delay="400"
                class="mt-8 max-w-4xl mx-auto">
                <img src="{{ $service->img ? Storage::url($service->img) : asset('images/service-details.jpg') }}"
                    alt="{{ $service->name }}"
                    class="w-full h-80 object-cover rounded-lg shadow-md">
            </div>
        </div>
    </section>

    <!-- Order Service Form Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-black py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-white text-center mb-12">اطلب الخدمة الآن</h2>
            <div class="max-w-2xl mx-auto bg-white rounded-lg p-8 shadow-md border border-blue-500/30">
                <!-- Form -->
                <div x-data="{
                    form: { name: '', email: '', phone: '', project_type: '{{ $service->slug }}', message: '', service_id: '{{ $service->id }}' },
                    submitted: false,
                    errors: {}
                }" @submit.prevent="
                    errors = {};
                    if (!form.name) errors.name = 'الاسم مطلوب';
                    if (!form.email || !form.email.includes('@')) errors.email = 'البريد الإلكتروني غير صالح';
                    if (!form.phone) errors.phone = 'رقم الهاتف مطلوب';
                    if (!form.project_type) errors.project_type = 'نوع المشروع مطلوب';
                    if (!form.message) errors.message = 'الرسالة مطلوبة';
                    if (Object.keys(errors).length === 0) {
                        fetch('/api/service-request', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(form)
                        }).then(response => {
                            if (response.ok) {
                                submitted = true;
                                form = { name: '', email: '', phone: '', project_type: '{{ $service->slug }}', message: '', service_id: '{{ $service->id }}' };
                            } else {
                                return response.json().then(data => {
                                    if (data.errors) {
                                        errors = { ...errors, ...data.errors };
                                    } else {
                                        errors.submit = 'حدث خطأ أثناء الإرسال';
                                    }
                                });
                            }
                        }).catch(() => {
                            errors.submit = 'حدث خطأ في الاتصال بالخادم';
                        });
                    }
                ">
                    <form class="space-y-6">
                        <!-- Hidden Service ID -->
                        <input type="hidden" x-model="form.service_id">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-navy font-medium mb-2">الاسم</label>
                            <input id="name" type="text" x-model="form.name"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                :class="{ 'border-red-500': errors.name }">
                            <p x-show="errors.name" class="text-red-500 text-sm mt-1" x-text="errors.name"></p>
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-navy font-medium mb-2">البريد الإلكتروني</label>
                            <input id="email" type="email" x-model="form.email"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                :class="{ 'border-red-500': errors.email }">
                            <p x-show="errors.email" class="text-red-500 text-sm mt-1" x-text="errors.email"></p>
                        </div>
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-navy font-medium mb-2">رقم الهاتف</label>
                            <input id="phone" type="tel" x-model="form.phone"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                :class="{ 'border-red-500': errors.phone }">
                            <p x-show="errors.phone" class="text-red-500 text-sm mt-1" x-text="errors.phone"></p>
                        </div>
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-navy font-medium mb-2">رسالتك</label>
                            <textarea id="message" x-model="form.message" rows="5"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                :class="{ 'border-red-500': errors.message }"></textarea>
                            <p x-show="errors.message" class="text-red-500 text-sm mt-1" x-text="errors.message"></p>
                        </div>
                        <!-- Submit Button -->
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="text-center opacity-0 scale-95">
                            <button type="submit"
                                class="px-8 py-4 bg-black text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-xl transition-all duration-500">
                                إرسال الطلب
                            </button>
                        </div>
                    </form>
                    <!-- Success Message -->
                    <div x-show="submitted" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-6 text-center text-green-600 font-medium">
                        تم إرسال طلبك بنجاح! سنتواصل معك قريبًا.
                    </div>
                    <!-- Error Message -->
                    <div x-show="errors.submit" class="mt-6 text-center text-red-500 font-medium" x-text="errors.submit"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12">خدمات أخرى</h2>
            @if ($relatedServices->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedServices as $index => $relatedService)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ $index * 200 }}"
                            class="bg-white rounded-lg p-6 shadow-md hover:shadow-lg hover:scale-102 transition-all duration-300 group">

                             <!-- Name with Icon -->
                            <div class="flex items-center mb-2">
                                <i class="{{ $relatedService->icon ?? 'fas fa-cog' }} text-2xl text-blue-500 mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                                <h3 class="text-xl font-medium text-navy relative">
                                    {{ $relatedService->name }}
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-500 group-hover:w-full transition-all duration-300"></span>
                                </h3>
                            </div>
                            <!-- Divider -->
                            <hr class="border-gray-200 my-4">
                            <!-- Description -->
                            <p class="text-charcoal text-base leading-relaxed mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($relatedService->description), 150) !!}</p>
                            <!-- CTA -->
                            <a href="{{ route('services.show', $relatedService->slug) }}"
                                class="text-blue-500 hover:underline font-medium">عرض المزيد</a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-8 text-center">
                    <p class="text-charcoal text-lg mb-4">لا توجد خدمات أخرى متاحة حاليًا</p>
                    <a href="{{ route('services.index') }}"
                        class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-xl transition-all duration-500">
                        تصفح الخدمات
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

        .animate-item.fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.8s ease-out forwards;
        }

        /* Parallax */
        .parallax-bg {
            will-change: transform;
            transition: transform 0.5s ease-out;
        }

        /* Form Input Focus */
        input:focus, textarea:focus {
            outline: none;
        }

        /* RTL Adjustments */
        [dir="rtl"] .text-right {
            text-align: right;
        }

        [dir="rtl"] .flex.items-center .mr-2 {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        [dir="rtl"] .hover\:translate-x-2 {
            transform: translateX(-0.5rem);
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-80 {
                height: 16rem;
            }
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
