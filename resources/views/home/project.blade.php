<x-site-layout>
    <!-- Hero Section (Parallax) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative h-[100vh] overflow-hidden opacity-0 translate-y-10" data-parallax>
        <div class="absolute inset-0 bg-cover bg-center parallax-bg transition-transform duration-1000"
            style="background-image: url('{{ $project->cover_img ? Storage::url($project->cover_img) : ($project->img ? Storage::url($project->img) : asset('images/coming-soon.jpg')) }}')">
            <!-- Dark Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-navy/80 to-navy/60"></div>
            <!-- Centered Content -->
            <div x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
                class="h-full flex items-center">
                <div class="container">
                    <div class="max-w-3xl mx-auto bg-white/50 rounded-lg p-8">
                        <div class="text-center">
                            <h1 class="text-4xl md:text-6xl font-semibold text-navy mb-4">{{ $project->name }}</h1>
                            <p class="text-lg md:text-xl text-charcoal">تجربة سكنية فاخرة مصممة بعناية</p>
                        </div>
                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                            class="mt-8 text-center opacity-0 scale-95">
                            <a href="#details"
                                class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                                استكشف المزيد
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Details Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10" id="details">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                عن المشروع
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Details -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                    class="material-card bg-white rounded-xl shadow-md p-6 opacity-0 scale-95">
                    <ul class="text-charcoal text-base sm:text-lg space-y-4">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                            <span><strong>الموقع:</strong> {!! $project->address ?? 'غير محدد' !!}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-drafting-compass text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                            <span><strong>اسم المخطط:</strong> {{ $project->scheme_name ?? 'غير محدد' }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-building text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                            <span><strong>عدد الأدوار:</strong> {{ $project->floors_count ?? 'غير محدد' }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                            <span><strong>تاريخ البناء:</strong> {{ $project->date_of_build ? $project->date_of_build : 'غير محدد' }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-chart-line text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                            <span><strong>نسبة الإنجاز:</strong> {{ $project->status_percent ?? 0 }}%</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                            <span><strong>الحالة:</strong>
                                @switch($project->status)
                                    @case('not_started') لم يبدأ @break
                                    @case('pending') قيد التنفيذ @break
                                    @case('done') مكتمل @break
                                    @default غير محدد
                                @endswitch
                            </span>
                        </li>
                        @if ($project->address_location)
                            <li class="flex items-center">
                                <i class="fas fa-map text-blue-500 bg-navy rounded-full w-8 h-8 flex items-center justify-center mr-3"></i>
                                <span><strong>موقع المشروع:</strong>
                                    <a href="{{ $project->address_location }}" target="_blank" class="text-navy hover:underline">عرض الخريطة</a>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- Image and PDFs -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                    class="material-card bg-white rounded-xl shadow-md p-6 opacity-0 scale-95">
                    <div class="mb-6 flex flex-wrap gap-4">
                        @if ($project->projectPdfs->isNotEmpty())
                            @foreach ($project->projectPdfs as $index => $pdf)
                                <a href="{{ Storage::url($pdf->file) }}" download
                                    class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                                    <i class="fas fa-file-pdf mr-2"></i> تحميل البروشور #{{ $index + 1 }}
                                </a>
                            @endforeach
                        @endif
                        @if ($project->projectPdf2s->isNotEmpty())
                            @foreach ($project->projectPdf2s as $index => $pdf)
                                <a href="{{ Storage::url($pdf->file) }}" download
                                    class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                                    <i class="fas fa-file-pdf mr-2"></i> تحميل تصميم ثلاثي الأبعاد #{{ $index + 1 }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                    <div class="relative rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ $project->img ? Storage::url($project->img) : asset('images/coming-soon.jpg') }}"
                            alt="{{ $project->name }}"
                            class="w-full h-64 md:h-80 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Guarantees Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                الضمانات
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Featured Image -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                    class="material-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 scale-95">
                    <img src="{{asset('images/sections/Real-estate-broker-3.jpg')}}"
                         alt="{{ $project->name }}"
                         class="w-full h-96 md:h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <!-- Guarantee Cards -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                    class="flex flex-col gap-4 opacity-0 scale-95">
                    <!-- Top Row: Blue and Red Cards -->
                    <div class="flex gap-4">
                        <!-- Blue Card: Smart Entry -->
                        <div class="material-card bg-blue-600 text-white rounded-xl shadow-md p-6 flex-1 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg ripple" style="background-color: #0c9696;">
                            <div class="flex items-center">
                                <i class="fas fa-key text-white bg-navy rounded-full w-10 h-10 flex items-center justify-center mr-3"></i>
                                <div>
                                    <h3 class="text-lg font-semibold">نظام دخول ذكي</h3>
                                    <p class="text-base mt-1">أمان وسهولة الوصول باستخدام التكنولوجيا الحديثة</p>
                                </div>
                            </div>
                        </div>
                        <!-- Red Card: Dedicated Parking -->
                        <div class="material-card bg-red-600 text-white rounded-xl shadow-md p-6 flex-1 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg ripple" style="background-color: #cc2168;">
                            <div class="flex items-center">
                                <i class="fas fa-parking text-white bg-navy rounded-full w-10 h-10 flex items-center justify-center mr-3"></i>
                                <div>
                                    <h3 class="text-lg font-semibold">مواقف مخصصة للسيارات</h3>
                                    <p class="text-base mt-1">مواقف آمنة ومخصصة لسكان المشروع</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bottom Row: Yellow Card -->
                    <div class="material-card bg-blue-500 text-navy rounded-xl shadow-md p-6 transition-all duration-300 hover:-translate-y-2 hover:shadow-lg ripple">
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-blue-500 bg-navy rounded-full w-10 h-10 flex items-center justify-center mr-3"></i>
                            <div>
                                <h3 class="text-lg font-semibold">ضمانات المشروع</h3>
                                <ul class="text-base mt-2 space-y-1">
                                    <li><i class="fas fa-check-circle text-navy mr-2"></i> الهيكل الإنشائي: ٢٥ سنة</li>
                                    <li><i class="fas fa-check-circle text-navy mr-2"></i> اتحاد الملاك: ١ سنة</li>
                                    <li><i class="fas fa-check-circle text-navy mr-2"></i> الأفياش والسباكة: ٥ سنوات</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Details Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                تفاصيل المشروع
            </h2>
            <div class="max-w-2xl mx-auto material-card bg-white rounded-xl shadow-md p-8">
                <p class="text-charcoal text-lg leading-relaxed">
                    {!! $project->details ?? 'لا توجد تفاصيل متاحة لهذا المشروع.' !!}
                </p>
            </div>
        </div>
    </section>

    <!-- Apartments Section (Swiper Carousel) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                نماذج الوحدات السكنية
            </h2>
            @if ($project->apartments->isNotEmpty())
                <div class="w-full relative">
                    <div class="swiper apartments-carousel swiper-container relative">
                        <div class="swiper-wrapper">
                            @foreach ($project->apartments as $index => $apartment)
                                <div class="swiper-slide">
                                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                         x-intersect:delay="{{ ($index * 100) }}"
                                         x-data="{ expanded: false }"
                                         class="group material-card h-auto bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-2 hover:opacity-100 hover:filter-none ripple">
                                        <!-- Image -->
                                        <div class="relative">
                                            <img src="{{ $apartment->img ? Storage::url($apartment->img) : asset('images/coming-soon.jpg') }}"
                                                 alt="{{ $apartment->type }}"
                                                 class="w-full h-64 object-cover rounded-t-inherit swiper-lazy">
                                        </div>
                                        <!-- Content -->
                                        <div class="p-6">
                                            <div class="flex justify-between items-center cursor-pointer" @click="expanded = !expanded">
                                                <h3 class="text-xl font-medium text-navy">{{ $apartment->type ?? 'غير محدد' }}</h3>
                                                <i class="fas fa-chevron-down text-blue-500 transition-transform duration-300" :class="{ 'rotate-180': expanded }"></i>
                                            </div>
                                            <div class="text-charcoal text-base mt-2 space-y-2">
                                                <p><i class="fas fa-key text-blue-500 mr-2"></i> رمز النموذج: {{ $apartment->code ?? 'غير محدد' }}</p>
                                                <p><i class="fas fa-ruler-combined text-blue-500 mr-2"></i> المساحة: {{ $apartment->area ?? 'غير محدد' }} م²</p>
                                                <p><i class="fas fa-money-bill-wave text-blue-500 mr-2"></i> السعر: {{ $apartment->price ? number_format($apartment->price, 2) : 'غير محدد' }} ريال</p>
                                            </div>
                                            <!-- Expanded Content -->
                                            <div x-show="expanded" x-transition:enter="transition ease-out duration-300"
                                                 x-transition:enter-start="opacity-0 max-h-0"
                                                 x-transition:enter-end="opacity-100 max-h-screen"
                                                 x-transition:leave="transition ease-in duration-200"
                                                 x-transition:leave-start="opacity-100 max-h-screen"
                                                 x-transition:leave-end="opacity-0 max-h-0"
                                                 class="mt-4 border-t border-gray-200 pt-4 space-y-4">
                                                @if ($apartment->about)
                                                    <p><strong>حول الشقة:</strong> {!! $apartment->about !!}</p>
                                                @endif
                                                <p><strong>التفاصيل:</strong> {!! $apartment->details ?? 'لا توجد تفاصيل متاحة' !!}</p>
                                                <p><strong>عدد الغرف:</strong> {{ $apartment->room_count ?? 'غير محدد' }}</p>
                                                <p><strong>ملحق:</strong> {{ $apartment->appendix ? 'نعم' : 'لا' }}</p>
                                                @if ($apartment->price_bank && $apartment->price_bank > 0)
                                                    <p><strong>سعر البنك:</strong> {{ number_format($apartment->price_bank, 2) }} ريال</p>
                                                @endif
                                                @if ($apartment->youtube)
                                                    <div class="mt-2">
                                                        <iframe class="w-full h-48 rounded-lg"
                                                                src="{{ str_replace('watch?v=', 'embed/', $apartment->youtube) }}"
                                                                frameborder="0"
                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                allowfullscreen></iframe>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Decorative Border -->
                                        <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-transparent"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation Arrows -->
                        <div class="swiper-button-prev absolute top-1/2 left-6 transform -translate-y-1/2 bg-white/50 hover:bg-white/75 text-navy p-3 rounded-full shadow-sm hover:shadow-md transition-all duration-300 ripple z-30">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                        <div class="swiper-button-next absolute top-1/2 right-6 transform -translate-y-1/2 bg-white/50 hover:bg-white/75 text-navy p-3 rounded-full shadow-sm hover:shadow-md transition-all duration-300 ripple z-30">
                            <i class="fas fa-chevron-left"></i>
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
                            new Swiper('.apartments-carousel', {
                                centeredSlides: true,
                                loop: true,
                                spaceBetween: 30,
                                slideToClickedSlide: true,
                                pagination: {
                                    el: '.apartments-carousel .swiper-pagination',
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
                                        const slides = document.querySelectorAll('.apartments-carousel .swiper-slide');
                                        slides.forEach((slide, index) => {
                                            if (slide.classList.contains('swiper-slide-active')) {
                                                slide.querySelector('.material-card').classList.add('scale-105', 'z-10', 'shadow-lg');
                                                slide.querySelector('.material-card img').classList.add('h-72');
                                                slide.querySelector('.material-card').classList.remove('opacity-75', 'filter', 'blur-sm');
                                            } else {
                                                slide.querySelector('.material-card').classList.remove('scale-105', 'z-10', 'shadow-lg');
                                                slide.querySelector('.material-card img').classList.remove('h-72');
                                                slide.querySelector('.material-card').classList.add('opacity-75', 'filter', 'blur-sm');
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
                    <p class="text-charcoal text-lg mb-4">لا توجد شقق متاحة لهذا المشروع حاليًا</p>
                    <a href="{{ route('contact') }}"
                       class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                        تواصل معنا
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Image Gallery Section (Swiper Carousel) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                معرض الصور
            </h2>
            <div x-data="{ zoomedImage: null }">
                @if ($project->projectImages->isNotEmpty())
                    <div class="w-full relative">
                        <div class="swiper gallery-carousel swiper-container relative">
                            <div class="swiper-wrapper">
                                @foreach ($project->projectImages as $index => $image)
                                    <div class="swiper-slide">
                                        <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                             x-intersect:delay="{{ ($index * 100) }}"
                                             class="material-card bg-white rounded-xl shadow-md overflow-hidden">
                                            <img src="{{ Storage::url($image->img) }}"
                                                 alt="{{ $project->name }} Image"
                                                 class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                                                 @click="zoomedImage = '{{ Storage::url($image->img) }}'">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!-- Navigation Arrows -->
                            <div class="swiper-button-prev absolute top-1/2 left-6 transform -translate-y-1/2 bg-white/50 hover:bg-white/75 text-navy p-3 rounded-full shadow-sm hover:shadow-md transition-all duration-300 ripple z-30">
                                <i class="fas fa-chevron-right"></i>
                            </div>
                            <div class="swiper-button-next absolute top-1/2 right-6 transform -translate-y-1/2 bg-white/50 hover:bg-white/75 text-navy p-3 rounded-full shadow-sm hover:shadow-md transition-all duration-300 ripple z-30">
                                <i class="fas fa-chevron-left"></i>
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
                                new Swiper('.gallery-carousel', {
                                    centeredSlides: true,
                                    loop: true,
                                    spaceBetween: 30,
                                    slideToClickedSlide: true,
                                    pagination: {
                                        el: '.gallery-carousel .swiper-pagination',
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
                                            const slides = document.querySelectorAll('.gallery-carousel .swiper-slide');
                                            slides.forEach((slide, index) => {
                                                if (slide.classList.contains('swiper-slide-active')) {
                                                    slide.querySelector('.material-card').classList.add('scale-105', 'z-10', 'shadow-lg');
                                                    slide.querySelector('.material-card img').classList.add('h-72');
                                                    slide.querySelector('.material-card').classList.remove('opacity-75', 'filter', 'blur-sm');
                                                } else {
                                                    slide.querySelector('.material-card').classList.remove('scale-105', 'z-10', 'shadow-lg');
                                                    slide.querySelector('.material-card img').classList.remove('h-72');
                                                    slide.querySelector('.material-card').classList.add('opacity-75', 'filter', 'blur-sm');
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
                        <p class="text-charcoal text-lg mb-4">لا توجد صور متاحة لهذا المشروع</p>
                        <a href="{{ route('contact') }}"
                           class="inline-block px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                            تواصل معنا
                        </a>
                    </div>
                @endif
                <!-- Zoom Modal -->
                <div x-show="zoomedImage" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
                    @click="zoomedImage = null">
                    <img :src="zoomedImage" class="max-w-[90%] max-h-[90%] object-contain" @click.stop>
                </div>
            </div>
        </div>
    </section>

    <!-- Location & Virtual Tour Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-50 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                الموقع والجولة الافتراضية
            </h2>
            <div class="material-card bg-white rounded-xl shadow-md overflow-hidden">
                <div class="relative h-96">
                    <iframe class="w-full h-full"
                            src="{{ $project->address_location ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3623.677552346104!2d46.6752957!3d24.7135517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQyJzQ4LjgiTiA0NsKwNDAnMzEuMSJF!5e0!3m2!1sen!2sus!4v1631234567890' }}"
                            frameborder="0" allowfullscreen loading="lazy"></iframe>
                    @if ($project->virtual_location)
                        <a href="{{ $project->virtual_location }}" target="_blank"
                           class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                            <i class="fas fa-vr-cardboard mr-2"></i> جولة افتراضية
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-white py-16 opacity-0 translate-y-10">
        <div class="container text-center">
            <h2 class="text-4xl md:text-6xl font-semibold text-navy mb-6 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                هل أنت مهتم بهذا المشروع؟
            </h2>
            <p class="text-charcoal text-lg mb-8 max-w-2xl mx-auto">
                تواصل مع فريق المبيعات للحصول على مزيد من المعلومات أو لطلب استشارة.
            </p>
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                 class="opacity-0 scale-95">
                <a href="{{ route('contact') }}"
                   class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg button-scroll-effect hover:bg-navy hover:shadow-md transition-all duration-300 ripple">
                    <i class="fas fa-phone-alt mr-2"></i> تواصل معنا
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Styles -->
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

        /* Guarantee Cards */
        .bg-blue-600 {
            background-color: #2563eb;
        }

        .bg-red-600 {
            background-color: #dc2626;
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

        [dir="rtl"] .flex.items-center > i {
            margin-right: 0;
            margin-left: 0.75rem;
        }

        [dir="rtl"] .flex.items-center > div {
            text-align: right;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .h-64 {
                height: 16rem;
            }
            .h-72 {
                height: 18rem;
            }
            .h-80 {
                height: 20rem;
            }
            .h-96 {
                height: 24rem;
            }
            .h-48 {
                height: 12rem;
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
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .flex.gap-4 {
                flex-direction: column;
            }
            .material-card.bg-blue-600,
            .material-card.bg-red-600,
            .material-card.bg-blue-500 {
                width: 100%;
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
            .material-card:hover,
            img:hover {
                transform: none !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            }
        }
    </style>

    <!-- Alpine.js and Parallax Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('intersect', (el, { expression }, { evaluate, cleanup }) => {
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
