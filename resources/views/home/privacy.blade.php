<x-site-layout>
        <!-- Privacy Details Section -->
        <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
            class="bg-gray-100 py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-blue-500">
            <div class="container">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                    سياسة الخصوصية
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <!-- Text -->
                    <div x-intersect="$el.classList.add('animate-item', 'slide-in-left')"
                        class="opacity-0 translate-x-10">
                        <h3 class="text-2xl font-bold text-blue-500 mb-4">
                            حماية بياناتك مع الحسام
                        </h3>
                        <div class="prose prose-lg text-gray-600 leading-relaxed mb-4">
                            {!! $content !!}
                        </div>
                    </div>
                    <!-- Image with blue Gradient Border -->
                    <div x-intersect="$el.classList.add('animate-item', 'slide-in-right')"
                        class="opacity-0 -translate-x-10 relative p-4">
                        <div class="blue-border"></div>
                        <img src="{{ asset('logo/Al-Hussam 1.png') }}"
                            alt="شعار الحسام"
                            width="400" height="400"
                            class="w-full h-96 object-contain rounded-lg shadow-md relative z-10"
                            loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
            class="bg-white py-16 opacity-0 translate-y-10 border-t-2 border-b-2 border-dashed border-blue-500">
            <div class="container">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">
                    تواصل معنا
                </h2>
                <div class="max-w-2xl mx-auto text-center">
                    <p class="text-lg text-gray-600 mb-6">
                        إذا كانت لديك أي أسئلة حول سياسة الخصوصية، لا تتردد في التواصل مع فريقنا.
                    </p>
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                        class="opacity-0 scale-95">
                        <a @click="contactOpen = true" href="#"
                            class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-blue-500 hover:text-white transition-all duration-300"
                            aria-label="تواصل مع الحسام">
                            تواصل معنا الآن
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Custom Animations and Styles -->
        <style>
            @keyframes text-slide-in {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            @keyframes slide-in-right {
                from { transform: translateX(100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }

            @keyframes slide-in-left {
                from { transform: translateX(-100px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }

            @keyframes fade-in-slide-up {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }

            @keyframes fade-in-scale {
                from { transform: scale(0.95); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }

            @keyframes pulse-once {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }

            .animate-text-slide-in {
                animation: text-slide-in 0.8s ease-in-out forwards;
            }

            .animate-slide-in-right {
                animation: slide-in-right 0.8s ease-in-out forwards;
            }

            .animate-slide-in-left {
                animation: slide-in-left 0.8s ease-in-out forwards;
            }

            .animate-section.fade-in-slide-up {
                animation: fade-in-slide-up 0.8s ease-in-out forwards;
            }

            .animate-item.fade-in-scale {
                animation: fade-in-scale 0.8s ease-in-out forwards;
            }

            .animate-pulse-once {
                animation: pulse-once 1s ease-in-out;
            }

            /* blue Gradient Border */
            .blue-border {
                position: absolute;
                inset: 0;
                z-index: 5;
            }

            .blue-border::before,
            .blue-border::after {
                content: '';
                position: absolute;
                background: linear-gradient(to right, #FFD700, #FBBF24);
            }

            .blue-border::before {
                width: 40px;
                height: 2px;
                top: 10px;
                left: 10px;
            }

            .blue-border::after {
                width: 40px;
                height: 2px;
                bottom: 10px;
                right: 10px;
            }

            .blue-border::before:nth-child(2),
            .blue-border::after:nth-child(2) {
                width: 2px;
                height: 40px;
                background: linear-gradient(to bottom, #FFD700, #FBBF24);
            }

            .blue-border::before:nth-child(2) {
                top: 10px;
                right: 10px;
            }

            .blue-border::after:nth-child(2) {
                bottom: 10px;
                left: 10px;
            }

            /* Prose Styles for Content */
            .prose h1,
            .prose h2,
            .prose h3 {
                color: #1F2937; /* gray-900 */
                margin-top: 1.5rem;
                margin-bottom: 1rem;
            }

            .prose p {
                margin-bottom: 1rem;
                line-height: 1.75;
            }

            .prose ul,
            .prose ol {
                margin-bottom: 1rem;
                padding-right: 1.5rem; /* RTL */
            }

            .prose li {
                margin-bottom: 0.5rem;
            }

            [dir="rtl"] .prose ul,
            [dir="rtl"] .prose ol {
                padding-right: 0;
                padding-left: 1.5rem;
            }

            /* RTL Adjustments */
            [dir="rtl"] .slide-in-left {
                animation: slide-in-right 0.8s ease-in-out forwards;
            }

            [dir="rtl"] .slide-in-right {
                animation: slide-in-left 0.8s ease-in-out forwards;
            }

            [dir="rtl"] .blue-border::before {
                left: auto;
                right: 10px;
            }

            [dir="rtl"] .blue-border::after {
                right: auto;
                left: 10px;
            }

            [dir="rtl"] .blue-border::before:nth-child(2) {
                right: auto;
                left: 10px;
            }

            [dir="rtl"] .blue-border::after:nth-child(2) {
                left: auto;
                right: 10px;
            }

            /* Responsive Adjustments */
            @media (max-width: 640px) {
                .h-96 {
                    height: 16rem;
                }
            }

            /* Reduced Motion */
            @media (prefers-reduced-motion: reduce) {
                .animate-section, .animate-item {
                    animation: none !important;
                    transform: none !important;
                    opacity: 1 !important;
                }
            }
        </style>

        <!-- Alpine.js Intersection Observer -->
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
