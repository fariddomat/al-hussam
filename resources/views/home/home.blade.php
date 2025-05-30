<x-site-layout>
   <!-- Hero Image Slider -->
<section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
    class="relative h-[85vh] md:h-[100vh] opacity-0 overflow-hidden">
    <div x-data='{
        slides: @json($sliders, JSON_UNESCAPED_SLASHES),
        currentSlide: 0,
        isMobile: window.innerWidth < 768,
        init() {
            // Update isMobile on resize
            window.addEventListener("resize", () => {
                this.isMobile = window.innerWidth < 768;
            });
            // Auto-advance slides
            if (this.slides.length > 0) {
                setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                }, 5000);
            }
        },
        getSlideImage(slide) {
            return this.isMobile ? slide.image_mobile : slide.image;
        }
    }'
        class="relative h-full" wire:ignore>
        <!-- Debug -->
        <div x-show="false" x-text="JSON.stringify(slides)"></div>
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="currentSlide === index" class="absolute inset-0 transition-opacity duration-1000"
                :class="{ 'opacity-100': currentSlide === index, 'opacity-0': currentSlide !== index }">
                <!-- Background Image with Zoom Effect -->
                <div class="absolute inset-0 bg-cover bg-center zoom-effect"
                    :style="{ 'background-image': `url(${getSlideImage(slide)})` }"></div>
                <!-- Dark Overlay -->
                <div class="absolute inset-0" style="background: #173c4d78"></div>
                <!-- Right-Aligned Content (Text, Description, Button) -->
                <div
                    class="absolute top-1/2 right-8 md:right-12 transform -translate-y-1/2 text-right text-white animate-text-slide-in flex flex-col items-start">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4" x-text="slide.text"></h1>
                    <p class="text-lg md:text-xl max-w-md mb-6" x-text="slide.description"></p>
                    <a wire:navigate href="{{ route('about') }}"
                        class="inline-block px-6 py-3 bg-transparent text-white font-semibold rounded-md border border-white hover:border-blue-500 relative overflow-hidden group hover:text-white transition-colors duration-300"
                        aria-label="home">
                        <span class="relative z-10">استكشف المزيد</span>
                        <span
                            class="absolute inset-0 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></span>
                    </a>
                </div>
            </div>
        </template>
        <div x-show="slides.length === 0"
            class="absolute inset-0 flex items-center justify-center text-white bg-gray-900">
            <p>لا توجد صور متاحة</p>
        </div>
    </div>
</section>

    <!-- Projects Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative bg-white py-16 opacity-0 translate-y-10" dir="rtl">
        <div class="">
            <!-- Title -->
            <h2 class="text-4xl md:text-5xl font-bold text-black text-center mb-12">مشاريعنا المميزة</h2>
            <!-- Projects Stack -->
            <div x-data="{ activeProject: null }" class="">
                @foreach ($projects->take(4) as $index => $project)
                    <div x-on:mouseenter="activeProject = {{ $index }}" x-on:mouseleave="activeProject = null"
                        x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        x-intersect:delay="{{ $index * 200 }}"
                        class="project-card bg-white shadow-md transition-all duration-300 overflow-hidden relative"
                        :class="{
                            'h-16 md:h-20': activeProject !== {{ $index }} && activeProject !== null,
                            'h-32 md:h-32': activeProject === null,
                            'h-64 md:h-80': activeProject === {{ $index }}
                        }">
                        <!-- Image -->
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300"
                            :style="{ 'background-image': `url('{{ $project->img ? Storage::url($project->img) : asset('images/coming-soon.jpg') }}` }">
                        </div>
                        <!-- Dark Overlay -->
                        <div class="absolute inset-0" style="background: #173c4d78"></div>
                        <!-- Status Badge -->
                        <div class="absolute z-50 top-4 left-4 px-2 py-1 rounded text-white text-sm font-semibold"
                            :class="{
                                'bg-gray-500': '{{ $project->status }}'
                                === 'not_started',
                                'bg-blue-500': '{{ $project->status }}'
                                === 'pending',
                                'bg-green-500': '{{ $project->status }}'
                                === 'done'
                            }">
                            @switch($project->status)
                                @case('not_started')
                                    لم يبدأ
                                @break

                                @case('pending')
                                    قيد التنفيذ
                                @break

                                @case('done')
                                    مكتمل
                                @break
                            @endswitch
                        </div>
                        <!-- Project Info (Visible in Collapsed and Default States) -->
                        <div class="absolute bottom-2 right-0 w-full h-8 bg-transperent flex items-center justify-between px-4"
                            :class="{ 'opacity-100': activeProject !== {{ $index }}, 'opacity-0': activeProject ===
                                    {{ $index }} }">
                            <h3 class="text-lg font-bold text-white">{{ $project->name }}</h3>
                            <span class="text-sm text-black">{{ $project->ProjectCategory->name }}</span>
                        </div>
                        <!-- Expanded Content (Visible on Hover) -->
                        <div class="absolute inset-0 flex flex-col justify-end p-6"
                            :class="{ 'opacity-100': activeProject === {{ $index }}, 'opacity-0': activeProject !==
                                    {{ $index }} }"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform translate-y-4">
                            <h3 class="text-xl md:text-2xl font-bold text-white mb-2">{{ $project->name }}</h3>
                            <p class="text-sm md:text-base text-white mb-4">{{ $project->ProjectCategory->name }}</p>
                            <a href="{{ route('projects.show', $project->slug) }}"
                                class="inline-block px-6 py-3 bg-transparent text-white font-semibold rounded-md border border-white hover:bg-blue-500 relative overflow-hidden group hover:text-white transition-colors duration-300">
                                <span class="relative z-10">عرض التفاصيل</span>
                                <span
                                    class="absolute inset-0 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Explore More Button -->
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')" x-intersect:delay="800"
                class="text-center mt-12">
                <a href="{{ route('project-categories') }}"
                    class="inline-block px-8 py-4 bg-transparent text-blue-900 font-semibold rounded-md border border-black hover:border-white relative overflow-hidden group hover:text-white transition-colors duration-300">
                <span class="relative z-10">استكشف المزيد من المشاريع</span>
                    <span
                        class="absolute inset-0 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative bg-blue-500 py-16 overflow-hidden" dir="rtl">
        <div class="container mx-auto px-4 text-center">
            <!-- Title -->
            <h2
                class="text-3xl md:text-4xl font-bold text-white mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                شركاؤنا
            </h2>
            <!-- Card Slider -->
            <div x-data='{
                currentSlide: 0,
                slides: @json($partners, JSON_UNESCAPED_SLASHES),
                slidesPerView: 4,
                init() {
                    this.updateSlidesPerView();
                    window.addEventListener("resize", () => this.updateSlidesPerView());
                },
                updateSlidesPerView() {
                    if (window.innerWidth < 640) {
                        this.slidesPerView = 1;
                    } else if (window.innerWidth < 768) {
                        this.slidesPerView = 2;
                    } else if (window.innerWidth < 1024) {
                        this.slidesPerView = 3;
                    } else {
                        this.slidesPerView = 4;
                    }
                },
                nextSlide() {
                    if (this.currentSlide < this.slides.length - this.slidesPerView) {
                        this.currentSlide++;
                    }
                },
                prevSlide() {
                    if (this.currentSlide > 0) {
                        this.currentSlide--;
                    }
                }
            }'
                class="relative">
                <!-- Slider Content -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out" style="    justify-content: center;"
                        :style="{ transform: `translateX(${(currentSlide * -100 / slidesPerView)}%)` }">
                        @foreach ($partners as $index => $partner)
                            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                x-intersect:delay="{{ $index * 100 }}"
                                class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-2 group">
                                <div
                                    class="relative bg-gray-300 rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:scale-105">
                                    <img src="{{ Storage::url($partner->img) }}"
                                        alt="{{ $partner->name ?? 'Partner' }}"
                                        class="w-full h-32 ">
                                    <!-- Partner Name -->
                                    <div
                                        class="bg-black bg-opacity-80 text-white text-sm font-semibold py-2 px-3 text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        {{ $partner->name ?? 'Partner' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Navigation Arrows -->
                <button x-show="currentSlide > 0" @click="prevSlide"
                    class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-black p-2 rounded-full transition-all duration-300"
                    aria-label="Previous slide">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button x-show="currentSlide < slides.length - slidesPerView" @click="nextSlide"
                    class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-black p-2 rounded-full transition-all duration-300"
                    aria-label="Next slide">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
        </div>
    </section>

    {{-- Facilities --}}
      <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="bg-gray-900 py-16 opacity-0 translate-y-10">
        <div class="container">
            <h2 class="text-4xl md:text-6xl font-semibold text-white text-center mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                ما يميزنا
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Featured Image -->
                <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                    class="material-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 scale-95">
                    <img src="{{asset('images/sections/ما يميزنا ٠- هوم بيج-min.jpg')}}"
                         alt="image"
                         class="w-screen h-full max-h-[21rem] object-cover hover:scale-105 transition-transform duration-300">
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

    <!-- Blogs Section -->
    @if ($blogs->count() > 0)
<section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative bg-white py-16 overflow-hidden" dir="rtl">
        <div class="container mx-auto px-4 text-center">
            <!-- Title -->
            <h2
                class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-10 sm:mb-12 lg:mb-16 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                المدونات
            </h2>
            <!-- Blogs Grid (Fixed for 3 Items) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach ($blogs as $index => $blog)
                    <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                        x-intersect:delay="{{ $index * 200 }}" class="relative group">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                            x-bind:style="group ?
                                `transform: perspective(1000px) rotateY(${($el.getBoundingClientRect().x - window.innerWidth / 2) / 50}deg)` :
                                ''">
                            <!-- Image -->
                            <img src="{{ $blog->image ? Storage::url($blog->image) : asset('images/default-blog.jpg') }}"
                                alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2">{{ $blog->title }}</h3>
                                <p class="text-sm text-gray-600 mb-3">{{ $blog->created_at->format('d F Y') }}</p>
                                <p class="text-sm text-gray-700 mb-4" style="text-align: justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->introduction), 100) }}
                                </p>
                                <a wire:navigate href="{{ route('blogs.show', $blog->slug) }}"
                                    class="inline-block px-6 py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition-colors duration-300"
                                    aria-label="blog {{ $blog->slug }}">
                                    استكشف
                                </a>
                            </div>
                            <!-- Decorative Gradient Border -->
                            <div
                                class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-transparent">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- View All Button -->
            <div x-intersect="$el.classList.add('animate-item', 'fade-in-slide-up')" x-intersect:delay="600"
                class="text-center mt-12">
                <a wire:navigate href="{{ route('blogs.index') }}"
                    class="inline-block px-8 py-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition-colors duration-300"
                    aria-label="blogs">
                    عرض الكل
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Features Section (Counters) -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative bg-black py-16 overflow-hidden" dir="rtl">
        <div class="container mx-auto px-4 text-center">
            <!-- Title -->
            <h2
                class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-12 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                إحصائياتنا
            </h2>
            <!-- Counters Circular Layout -->
            <div class="flex flex-wrap justify-center gap-6 md:gap-8">
                @foreach ($counters as $index => $counter)
                    <div x-intersect.once="$el.classList.add('animate-item', 'fade-in-scale'); $dispatch('start-count', { id: $el.id })"
                        id="counter-{{ $index + 1 }}" x-data="{ count: 0, progress: 0 }"
                        x-on:start-count.window="if ($event.detail.id === 'counter-{{ $index + 1 }}') {
                             let start = 0;
                             const end = parseInt($el.dataset.count);
                             const duration = 2000;
                             const interval = duration / end;
                             const timer = setInterval(() => {
                                 if (start < end) {
                                     start++;
                                     count = start;
                                     progress = (start / end) * 100;
                                 } else {
                                     clearInterval(timer);
                                 }
                             }, interval);
                         }"
                        class="relative w-40 h-40 md:w-48 md:h-48 group" data-count="{{ $counter->value }}">
                        <!-- Circular Card -->
                        <div class="absolute inset-0 rounded-full bg-white shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                            x-bind:style="group ?
                                `transform: perspective(1000px) rotateY(${($el.getBoundingClientRect().x - window.innerWidth / 2) / 50}deg)` :
                                ''">
                            <!-- Radial Progress Background -->
                            <svg class="absolute inset-0 w-full h-full">
                                <circle cx="50%" cy="50%" r="45%" fill="none" stroke="#e5e7eb"
                                    stroke-width="8"></circle>
                                <circle cx="50%" cy="50%" r="45%" fill="none"
                                    stroke="url(#gradient-{{ $index }})" stroke-width="8"
                                    stroke-linecap="round"
                                    :style="{ 'stroke-dasharray': '283', 'stroke-dashoffset': 283 - (progress * 283 / 100) }">
                                </circle>
                                <defs>
                                    <linearGradient id="gradient-{{ $index }}" x1="0%" y1="0%"
                                        x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#25b2d9;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#25b2d9;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                            <!-- Content -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                                <i class="{{ $counter->icon }} text-2xl md:text-3xl text-gray-900 mb-2"></i>
                                <p class="text-xl md:text-2xl font-semibold text-blue-500" x-text="count"></p>
                                <h3 class="text-sm md:text-base font-bold text-gray-900 mt-1">{{ $counter->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Reviews Section -->
    <section x-intersect="$el.classList.add('animate-section', 'fade-in-slide-up')"
        class="relative bg-white py-12 sm:py-16 lg:py-20 overflow-hidden" dir="rtl">
        <div class="container mx-auto px-4 text-center">
            <!-- Title -->
            <h2
                class="text-3xl sm:text-4xl md:text-5xl font-bold text-black mb-10 sm:mb-12 lg:mb-16 tracking-tight transition-transform duration-500 ease-in-out transform hover:scale-105">
                آراء العملاء
            </h2>
            <!-- Debug Output (Remove in Production) -->
            <div x-show="false" x-text="JSON.stringify(reviews)"></div>
            <!-- Reviews Carousel -->
            <div x-data='{
                currentSlide: 0,
                reviews: @json($reviews, JSON_UNESCAPED_SLASHES),
                slidesPerView: 3,
                init() {
                    this.updateSlidesPerView();
                    window.addEventListener("resize", () => this.updateSlidesPerView());
                },
                updateSlidesPerView() {
                    if (window.innerWidth < 640) {
                        this.slidesPerView = 1;
                    } else if (window.innerWidth < 768) {
                        this.slidesPerView = 2;
                    } else {
                        this.slidesPerView = 3;
                    }
                },
                nextSlide() {
                    if (this.currentSlide < this.reviews.length - this.slidesPerView) {
                        this.currentSlide++;
                    }
                },
                prevSlide() {
                    if (this.currentSlide > 0) {
                        this.currentSlide--;
                    }
                }
            }'
                class="relative" wire:ignore dir="ltr">
                <!-- Carousel Content -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="{ transform: `translateX(calc(${(currentSlide * -100 / slidesPerView)}%))` }">
                        <template x-for="(review, index) in reviews" :key="index">
                            <div x-intersect="$el.classList.add('animate-item', 'fade-in-scale')"
                                x-intersect:delay="{{ $index * 100 }}"
                                class="flex-shrink-0 w-full sm:w-1/2 md:w-1/3 px-3 group">
                                <div class="relative bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-2"
                                    x-bind:style="group ?
                                        `transform: perspective(1000px) rotateY(${($el.getBoundingClientRect().x - window.innerWidth / 2) / 50}deg)` :
                                        ''">
                                    <!-- Content -->
                                    <div class="p-6">
                                        <!-- Reviewer Image -->
                                        <img :src="review.icon || '{{ asset('images/default-user.jpg') }}'"
                                            alt="Reviewer"
                                            class="w-16 h-16 sm:w-20 sm:h-20 rounded-full mx-auto mb-4 object-cover border-2 border-blue-500">
                                        <!-- Name and Title -->
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-1"
                                            x-text="review.name || 'مجهول'"></h3>
                                        <p class="text-sm text-gray-600 italic mb-3"
                                            x-text="review.title || 'بدون عنوان'"></p>
                                        <!-- Star Rating (Assuming 5 stars for simplicity) -->
                                        <div class="flex justify-center mb-3">
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        </div>
                                        <!-- Description -->
                                        <p class="text-sm sm:text-base text-gray-700"
                                            x-text="review.description || 'بدون وصف'"></p>
                                    </div>
                                    <!-- Decorative Gradient Border -->
                                    <div
                                        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-transparent">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <!-- Navigation Arrows -->
                <button x-show="currentSlide > 0" @click="prevSlide"
                    class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-black p-3 rounded-full transition-all duration-300"
                    aria-label="Previous slide">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button x-show="currentSlide < reviews.length - slidesPerView" @click="nextSlide"
                    class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-black p-3 rounded-full transition-all duration-300"
                    aria-label="Next slide">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <!-- Fallback Message -->
                <div x-show="reviews.length === 0" class="text-center text-gray-300 py-8">
                    <p>لا توجد آراء متاحة</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Consolidated Styles -->
    <style>
        /* Zoom Effect for Hero Slider Background */
        .zoom-effect {
            animation: zoomInOut 10s ease-in-out infinite;
        }

        @keyframes zoomInOut {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Button Sliding Background Effect */
        .group:hover .bg-white {
            transform: translateX(0);
        }

        .group:hover .bg-blue-500 {
            transform: translateX(0);
        }

        /* Animation for Sections and Items */
        .animate-section.fade-in-slide-up {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .animate-item.fade-in-scale {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        /* Smooth transitions for cards and sliders */


        /* Navigation arrows */
        button[aria-label] {
            cursor: pointer;
        }

        /* 3D tilt effect on hover */
        .group:hover {
            transform: perspective(1000px) rotateY(0deg) !important;
        }

        /* SVG circle animation for Counters */
        circle {
            transition: stroke-dashoffset 2s ease-in-out;
        }

        /* Project Card Styling */
        .project-card {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .project-card:hover {
            z-index: 10;
        }

        /* Animation Keyframes */
        @keyframes text-slide-in {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slide-in-right {
            from {
                transform: translateX(100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-in-left {
            from {
                transform: translateX(-100px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slide-in-up {
            from {
                transform: translateY(10px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

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

        /* Animation Classes */
        .animate-text-slide-in {
            animation: text-slide-in 1s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.8s ease-out forwards;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.8s ease-out forwards;
        }

        .animate-section.fade-in-slide-up {
            animation: fade-in-slide-up 0.7s ease-out forwards;
        }

        .animate-item.fade-in-scale {
            animation: fade-in-scale 0.7s ease-out forwards;
        }

        /* RTL Adjustments */
        [dir="rtl"] .slider-container {
            direction: ltr;
        }

        [dir="rtl"] .project-badge {
            left: auto;
            right: 1rem;
        }

        [dir="rtl"] .guarantee-item .fas {
            margin-right: 0;
            margin-left: 1rem;
        }

        [dir="rtl"] .review-slider {
            direction: ltr;
        }

        [dir="rtl"] .slide-in-left {
            animation: slide-in-right 0.7s ease-out forwards;
        }

        [dir="rtl"] .slide-in-right {
            animation: slide-in-left 0.7s ease-out forwards;
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

        /* Reduced Motion */
        @media (prefers-reduced-motion: reduce) {

            .animate-section,
            .animate-item,
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

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .blog-image {
                height: 10rem;
            }
        }
    </style>

    <!-- Alpine.js Intersection Observer -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('intersect', (el, {
                value,
                expression
            }, {
                evaluate,
                cleanup
            }) => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const delay = parseInt(el.getAttribute('x-intersect:delay') ||
                                '0', 10);
                            setTimeout(() => {
                                evaluate(expression);
                            }, delay);
                            if (el.hasAttribute('x-intersect.once')) {
                                observer.unobserve(el);
                            }
                        }
                    });
                }, {
                    threshold: 0.1
                });
                observer.observe(el);
                cleanup(() => observer.disconnect());
            });
        });
    </script>

</x-site-layout>
