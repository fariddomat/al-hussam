<x-site-layout>
    <!-- Hero Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-blue-500 relative h-[100vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg transition-transform duration-1000"
            style="background-image: url('{{ $blog->image ? Storage::url($blog->image) : asset('images/blog-placeholder.jpg') }}')">
            <!-- Dark Overlay with Gradient -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/80 to-navy/60"></div>
            <!-- Centered Title -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="h-full flex items-center">
                <div class="container">
                    <div class="max-w-3xl mx-auto bg-white/95 text-navy rounded-lg p-8 shadow-lg">
                        <div class="text-center">
                            <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $blog->title }}</h1>
                            <p class="text-base md:text-lg text-gray-600">
                                بقلم {{ $blog->author_name }} | {{ $blog->author_title }} | {{ $blog->created_at->format('Y-m-d') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 opacity-0 translate-y-10 py-12">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Content (Main content in cards) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Main Image Card -->
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        class="bg-white rounded-lg shadow-md p-6 opacity-0 scale-95">
                        <div class="relative p-4">
                            <div class="blue-border"></div>
                            <img src="{{ $blog->image ? Storage::url($blog->image) : asset('images/blog-placeholder.jpg') }}"
                                alt="{{ $blog->image_alt ?? $blog->title }}"
                                class="w-full h-80 object-cover rounded-lg relative z-10">
                        </div>
                    </div>

                    <!-- First Paragraph Card -->
                    @if ($blog->first_paragraph)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="bg-white rounded-lg shadow-md p-6 opacity-0 scale-95">
                            <div class="prose prose-lg text-gray-600 leading-relaxed">
                                <p>{!! nl2br(e($blog->first_paragraph)) !!}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Description Card -->
                    @if ($blog->description)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="bg-white rounded-lg shadow-md p-6 opacity-0 scale-95">
                            <div class="prose prose-lg text-gray-600 leading-relaxed">
                                {!! $blog->description !!}
                            </div>
                        </div>
                    @else
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="bg-white rounded-lg shadow-md p-6 opacity-0 scale-95">
                            <div class="prose prose-lg text-gray-600 leading-relaxed">
                                <p>لا يوجد محتوى متاح لهذا المقال.</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Content (Content Table in Material Card) -->
                @if ($blog->content_table)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        class="lg:col-span-1 opacity-0 scale-95">
                        <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">فهرس المحتوى</h3>
                            <div class="prose prose-lg text-gray-600 leading-relaxed">
                                {!! $blog->content_table !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Related Posts Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-100 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 text-center mb-12">مقالات ذات صلة</h2>
            @if ($relatedBlogs->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedBlogs as $index => $relatedBlog)
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            x-intersect:delay="{{ $index * 200 }}"
                            class="blog-card bg-white rounded-lg shadow-md overflow-hidden opacity-0 scale-95 hover:scale-105 hover:shadow-xl transition-all duration-300">
                            <div class="relative p-4">
                                <div class="blue-border"></div>
                                <img src="{{ $relatedBlog->image ? Storage::url('images/' . $relatedBlog->image) : asset('images/blog-placeholder.jpg') }}"
                                    alt="{{ $relatedBlog->image_alt ?? $relatedBlog->title }}"
                                    class="w-full h-64 object-cover rounded-lg relative z-10">
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $relatedBlog->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($relatedBlog->introduction), 100) !!}</p>
                                <p class="text-gray-500 text-sm mb-4">{{ $relatedBlog->created_at->format('Y-m-d') }}</p>
                                <a wire:navigate href="{{ route('blogs.show', $relatedBlog->slug) }}"
                                    class="text-blue-600 hover:underline">اقرأ المزيد</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-8">
                    <p>لا توجد مقالات ذات صلة متاحة حاليًا</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">استكشف المزيد من المقالات</h2>
            <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                زر مدونتنا للحصول على المزيد من الرؤى العقارية أو تواصل مع الحسام لاستشارات مخصصة.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale', 'animate-pulse-once')"
                class="opacity-0 scale-95">
                <a wire:navigate href="{{ route('blogs.index') }}"
                    class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-md border border-gray-300 hover:bg-blue-500 hover:text-white transition-all duration-300 mr-4">
                    تصفح المدونة
                </a>
                <a wire:navigate href="{{ route('contact') }}"
                    class="inline-block px-8 py-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition-all duration-300">
                    تواصل معنا
                </a>
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

        @keyframes slide-in-up {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
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

        .animate-slide-in-up {
            animation: slide-in-up 0.8s ease-in-out forwards;
        }

        .animate-pulse-once {
            animation: pulse-once 1s ease-in-out;
        }

        /* Blue Border */
        .blue-border {
            position: absolute;
            inset: 0;
            z-index: 5;
        }

        .blue-border::before,
        .blue-border::after {
            content: '';
            position: absolute;
            background: #3B82F6; /* blue-500 */
        }

        .blue-border::before {
            width: 30px;
            height: 2px;
            top: 10px;
            left: 10px;
        }

        .blue-border::after {
            width: 30px;
            height: 2px;
            bottom: 10px;
            right: 10px;
        }

        .blue-border::before:nth-child(2),
        .blue-border::after:nth-child(2) {
            width: 2px;
            height: 30px;
            background: #3B82F6; /* blue-500 */
        }

        .blue-border::before:nth-child(2) {
            top: 10px;
            right: 10px;
        }

        .blue-border::after:nth-child(2) {
            bottom: 10px;
            left: 10px;
        }

        /* Parallax */
        .parallax-bg {
            will-change: transform;
        }

        /* Blog Card Hover */
        .blog-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* Prose Styling for Content */
        .prose {
            max-width: 100%;
        }

        .prose p {
            margin-bottom: 1.5rem;
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
            .blog-image {
                height: 16rem;
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
            .animate-section, .animate-item {
                animation: none !important;
                transform: none !important;
                opacity: 1 !important;
            }
            .blog-card:hover {
                transform: none !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
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
