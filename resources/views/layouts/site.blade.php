<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    livewire:navigate>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $info = \App\Models\Info::first();
    @endphp
    <meta name="description" content="{{ $metaDescription ?? strip_tags($info->description) }} ">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ Storage::url($info?->logo_2) }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $metaTitle ?? $info?->name }}">
    <meta property="og:description" content="{{ strip_tags($info?->description) }} ">
    <meta property="og:image" content="{{ Storage::url($info?->logo_2) }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $info?->name }}">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?? $info?->name }}">
    <meta name="twitter:description" content="{{ strip_tags($info?->description) }} ">
    <meta name="twitter:image" content="{{ Storage::url($info?->logo_2) }}">

    <title>{{ $metaTitle ?? $info->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
    <script src="{{ asset('noty/noty.min.js') }}" defer></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"
        integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css"
        integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="overflow-x-hidden">
    <!-- Loader -->
    <div x-data="{ isLoading: true }" x-init="setTimeout(() => isLoading = false, 2000)" x-show="isLoading" x-cloak
        class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-90 z-50 transition-opacity duration-500"
        :class="{ 'opacity-100': isLoading, 'opacity-0': !isLoading }">
        <div class="loader w-16 h-16 border-8 border-blue-500 border-t-black rounded-full animate-spin"></div>
    </div>

    <div class="flex flex-col min-h-screen" x-data="{ menuOpen: false, searchOpen: false, contactOpen: false }">
        <!-- Fixed Header -->
        <header
            class="header fixed top-0 left-0 right-0 z-50  flex items-center justify-center bg-transparent transition-all duration-300">
            <div class="container flex justify-between items-center">
                <!-- Right Side (Visual Left in RTL): Logo and Navigation Links -->
                <div class="flex items-center space-x-6 space-x-reverse">
                    <!-- Logo -->
                    <a href="{{ route('home') }}">
                        <img src="{{ Storage::url($info?->logo) }}" alt="Al Hussam Logo"
                            class="header-logo h-16  w-16  transition-transform duration-300" />
                    </a>
                    <!-- Desktop Navigation -->
                    <nav class="hidden md:flex space-x-6 space-x-reverse nav-items" dir="ltr">
                        <a href="{{ route('home') }}"
                            class="nav-link hover:text-gray-200 transition-colors duration-200 {{ request()->is('/') ? 'active' : '' }}"
                            wire:navigate aria-label="home">الرئيسية</a>
                        <a href="{{ route('about') }}"
                            class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                            aria-label="about">من نحن</a>
                             <div x-data="{ open: false }" class="relative">
                            <a href="{{ route('projects') }}" @mouseover="open = true"
                                @click.away="open = false"
                                class="nav-link hover:text-gray-200 transition-colors duration-500 flex items-center"
                                aria-label="projects">
                                {{-- <i class="fas fa-chevron-down mr-1"></i> --}}
                                المشاريع
                            </a>
                            {{-- <div x-show="open" @mouseover="open = true" @mouseleave="open = false"
                                class="absolute top-full right-0 mt-2 bg-white text-gray-900 rounded-md shadow-lg w-48">
                                @foreach (\App\Models\ProjectCategory::all() as $item)
                                    <a href="{{ route('projects', $item) }}"
                                        class="block px-4 py-2 hover:bg-gray-100 hover:text-black"
                                        aria-label="project {{ $item->name }}">{{ $item->name }}</a>
                                @endforeach
                            </div> --}}
                        </div>
                        <a href="{{ route('services') }}"
                            class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                            aria-label="service">خدماتنا</a>

                        <a href="{{ route('blogs.index') }}"
                            class="nav-link hover:text-gray-200 transition-colors duration-200" wire:navigate
                            aria-label="blogs">المدونة</a>
                    </nav>
                </div>

                <!-- Left Side (Visual Right in RTL): Contact Us, WhatsApp, Search -->
                <div class="hidden md:flex items-center space-x-4 space-x-reverse">
                    <button @click="contactOpen = true"
                        class="nav-link hover:text-gray-200 transition-colors duration-200" aria-label="contact">
                        تواصل معنا
                    </button>
                    <a href="https://wa.me/+966{{ \App\Models\SocialMedia::where('name', 'whatsapp')->first()?->link }}"
                        target="_blank" class="flex items-center hover:text-gray-200 transition-colors duration-200"
                        aria-label="whatsapp">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <button @click="searchOpen = !searchOpen" aria-label="search">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                </div>

                <!-- Mobile Menu Button and Icons -->
                <div class="flex md:hidden items-center space-x-3 space-x-reverse">
                    <a href="https://wa.me/+966{{ \App\Models\SocialMedia::where('name', 'whatsapp')->first()?->link }}"
                        target="_blank" class="flex items-center hover:text-gray-200 transition-colors duration-200"
                        aria-label="whatsapp">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    <button @click="searchOpen = !searchOpen" aria-label="search">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    <button @click="menuOpen = !menuOpen" aria-label="menu">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Search Popup -->
        <div x-show="searchOpen" x-cloak
            class="fixed z-[1000] top-0 left-0 w-full h-screen flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-xl mx-4 relative"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform scale-95"
                x-transition:enter-end="transform scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="transform scale-100" x-transition:leave-end="transform scale-95">
                <button class="absolute top-4 left-4 text-gray-600 hover:text-gray-800" @click="searchOpen = false"
                    aria-label="search exit">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">ابحث في الموقع</h3>
                <form action="{{ route('search') }}" method="GET" class="space-y-4">
                    <div>
                        <label for="query" class="block text-gray-600mb-1">كلمة البحث</label>
                        <input type="text" name="query" id="query" placeholder="أدخل كلمة البحث"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="scope" class="block text-gray-600mb-1">نطاق البحث</label>
                        <select name="scope" id="scope"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="all">الكل</option>
                            <option value="projects">المشاريع</option>
                            <option value="blogs">الأخبار</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit"
                            class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition-all duration-300"
                            aria-label="search submit">
                            ابحث الآن
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Contact Modal -->
        <div x-show="contactOpen" x-cloak
            class="fixed inset-0 bg-black  bg-opacity-50 flex items-center justify-center z-50"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg mx-4 relative material-card"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="transform scale-95"
                x-transition:enter-end="transform scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="transform scale-100" x-transition:leave-end="transform scale-95">
                <button class="absolute top-4 right-4 text-navy hover:text-gray-800" @click="contactOpen = false"
                    aria-label="close contact modal">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h3 class="text-2xl font-bold text-navy mb-4 text-center">أرسل استفسارك</h3>
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg text-center">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-navymb-1">الاسم <span
                                class="text-red-500">*</span></label>
                        <input name="name" id="name" type="text" value="{{ old('name') }}"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">

                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-navymb-1">البريد الإلكتروني </label>
                        <input name="email" id="email" type="email" value="{{ old('email') }}"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-navymb-1">رقم الهاتف <span
                                class="text-red-500">*</span></label>
                        <input name="phone" id="phone" type="text" value="{{ old('phone') }}"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Project -->
                    <div>
                        <label for="project_id" class="block text-navymb-1">المشروع <span
                                class="text-red-500">*</span></label>
                        <select name="project_id" id="project_id"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('project_id') border-red-500 @enderror">
                            <option value="">اختر المشروع</option>
                            @foreach ($projects ?? \App\Models\Project::all() as $project)
                                <option value="{{ $project->id }}"
                                    {{ old('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-navymb-1">الرسالة /label>
                        <textarea name="message" id="message" rows="2"
                            class="w-full p-3 pt-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="px-8 py-4 bg-black text-white font-semibold rounded-md hover:bg-navy transition-all duration-300 ripple">
                            أرسل الآن
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mobile Menu -->
        {{-- <div class="mobile-menu h-screen fixed top-0 right-0  w-64 bg-gray-900 text-white p-6 md:hidden z-50" x-show="menuOpen"
            x-bind:class="{ 'open': menuOpen }"  x-cloak x-transition.opacity> --}}

<div x-show="menuOpen" x-cloak x-transition.opacity
            class="fixed inset-0 bg-gray-900 text-white bg-opacity-50 z-50 md:hidden" @click="menuOpen = false">
            <div class="fixed top-0 right-0 w-3/4 max-w-sm bg-gray-900 text-white h-full shadow-lg overflow-y-auto"
                @click.stop>
            <button class="absolute top-4 left-4" @click="menuOpen = false" aria-label="menu exit">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <nav class="mt-20 mr-2 space-y-4">
                <a href="{{ route('home') }}"
                    class="block hover:text-gray-300 {{ request()->is('/') ? 'font-bold border-r-2 border-white' : '' }}"
                    wire:navigate aria-label="home">الرئيسية</a>
                <a href="{{ route('about') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="about">نبذة عنا</a>
                <a href="{{ route('services') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="services">خدماتنا</a>
                <a href="{{ route('projects') }}" class="block hover:text-gray-300" 
                    aria-label="services">المشاريع</a>
                {{-- <div x-data="{ open: false }">
                    <button @click="open = !open" class="block hover:text-gray-300 flex justify-between w-full"
                        aria-label="project open">
                        المشاريع
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div x-show="open" class="pr-4 space-y-2">
                        @foreach (\App\Models\ProjectCategory::all() as $item)
                            <a href="{{ route('projects', $item) }}" class="block hover:text-gray-300"
                                aria-label="project {{ $item->name }}">{{ $item->name }}</a>
                        @endforeach
                    </div>
                </div> --}}
                <a href="{{ route('blogs.index') }}" class="block hover:text-gray-300" wire:navigate
                    aria-label="blogs">الأخبار</a>
                <button @click="contactOpen = true" class="block hover:text-gray-300 text-left"
                    aria-label="contact">تواصل معنا</button>
            </nav>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>
        <!-- Footer -->
        <svg width="100%" height="100%" id="svg" viewBox="0 0 1440 390" xmlns="http://www.w3.org/2000/svg"
            class="transition duration-300 ease-in-out delay-150">
            <style>
                .path-0 {
                    animation: pathAnim-0 4s;
                    animation-timing-function: linear;
                    animation-iteration-count: infinite;
                }

                @keyframes pathAnim-0 {
                    0% {
                        d: path("M 0,400 L 0,150 C 120,120.07142857142857 240,90.14285714285714 373,94 C 506,97.85714285714286 652.0000000000001,135.5 772,168 C 891.9999999999999,200.5 986,227.85714285714283 1093,224 C 1200,220.14285714285717 1320,185.07142857142858 1440,150 L 1440,400 L 0,400 Z");
                    }

                    25% {
                        d: path("M 0,400 L 0,150 C 141.53571428571428,167.28571428571428 283.07142857142856,184.57142857142858 404,166 C 524.9285714285714,147.42857142857142 625.25,93 738,87 C 850.75,81 975.9285714285716,123.42857142857144 1095,142 C 1214.0714285714284,160.57142857142856 1327.0357142857142,155.28571428571428 1440,150 L 1440,400 L 0,400 Z");
                    }

                    50% {
                        d: path("M 0,400 L 0,150 C 102,139.85714285714286 204,129.71428571428572 341,119 C 478,108.28571428571429 650,97 767,122 C 884,147 946,208.28571428571428 1049,219 C 1152,229.71428571428572 1296,189.85714285714286 1440,150 L 1440,400 L 0,400 Z");
                    }

                    75% {
                        d: path("M 0,400 L 0,150 C 146.03571428571428,173.67857142857144 292.07142857142856,197.35714285714286 422,192 C 551.9285714285714,186.64285714285714 665.7499999999999,152.25 783,152 C 900.2500000000001,151.75 1020.9285714285713,185.64285714285717 1131,191 C 1241.0714285714287,196.35714285714283 1340.5357142857142,173.178571428Steve Jobs57142 1440,150 L 1440,400 L 0,400 Z");
                    }

                    100% {
                        d: path("M 0,400 L 0,150 C 120,120.07142857142857 240,90.14285714285714 373,94 C 506,97.85714285714286 652.0000000000001,135.5 772,168 C 891.9999999999999,200.5 986,227.85714285714283 1093,224 C 1200,220.14285714285717 1320,185.07142857142858 1440,150 L 1440,400 L 0,400 Z");
                    }
                }
            </style>
            <path
                d="M 0,400 L 0,150 C 120,120.07142857142857 240,90.14285714285714 373,94 C 506,97.85714285714286 652.0000000000001,135.5 772,168 C 891.9999999999999,200.5 986,227.85714285714283 1093,224 C 1200,220.14285714285717 1320,185.07142857142858 1440,150 L 1440,400 L 0,400 Z"
                stroke="none" stroke-width="0" fill="#25b2d9" fill-opacity="1"
                class="transition-all duration-300 ease-in-out delay-150 path-0"></path>
        </svg>
        <footer class="footer pb-12">
            <div class="container grid grid-cols-1 md:grid-cols-3 gap-40">


                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">روابط سريعة</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <div>

                            <ul class="space-y-2">

                                <li><a href="{{ route('about') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="blogs">من نحن</a></li>
                                <li><a href="{{ route('services') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="blogs">الخدمات</a></li>
                                <li><a href="{{ route('privacy') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="privacy">سياسة الخصوصية</a></li>
                                <li><a href="{{ route('terms') }}" class="hover:text-gray-300" wire:navigate
                                        aria-label="terms">الشروط والأحكام</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <!-- Column 3: Newsletter -->
                <div>

                    <h3 class="text-xl font-bold mb-4">تابعنا</h3>
                    <div class="mt-4 flex space-x-4 space-x-reverse">
                        @foreach (\App\Models\SocialMedia::all() as $item)
                            <a href="{{ $item->link }}" class="hover:text-gray-300"
                                aria-label="{{ $item->name }}"><i class="fab {{ $item->icon }}"
                                    style="font-size: 2rem"></i></a>
                        @endforeach
                    </div>
                    <h3 class="text-xl font-bold mb-4 mt-2">سجل معنا ك مسوق :
                    </h3>
                    <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST"
                        class="space-y-4">
                        @csrf
                        <div class="relative">
                            <input type="text" name="mobile" id="mobile" placeholder="أدخل رقم هاتفك"
                                class="w-full p-3 pl-28 border border-gray-200 rounded-lg bg-gray-100 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i
                                class="fas fa-phone absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="submit"
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 px-4 py-1 bg-black text-white font-semibold rounded-lg hover:bg-blue-600 transition-all duration-300"
                                aria-label="newsletter">
                                سجل الآن
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Column 4: Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">معلومات التواصل</h3>
                    <ul class="space-y-2 text-white">
                        <li style="font-size: 1rem"><i class="fas fa-phone mr-2 mt-2 mb-2"></i> <a
                                href="tel:{{ $info?->phone_1 }}">{{ $info?->phone_1 }}</a></li>
                        <li style="font-size: 1rem"><i class="fas fa-envelope mr-2  mt-2 mb-2"></i> <a
                                href="mailto:{{ $info?->email }}">{{ $info?->email }}</a></li>
                        <li style="font-size: 1rem"><i class="fas fa-map-marker-alt mr-2" mt-2 mb-2></i> <a
                                href="https://maps.app.goo.gl/8nj2F8jSgBz9pJHz5"> {{ $info?->location }}</a></li>
                    </ul>

                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    @extends('layouts._noty')
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('redirect', (url) => {
                window.location.href = url;
            });
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized');
        });

        // Newsletter Form Submission with AJAX
        $(document).ready(function() {
            $('#newsletter-form').ajaxForm({
                beforeSubmit: function() {
                    $('#newsletter-form button').prop('disabled', true).text('جارٍ الإرسال...');
                },
                success: function(response) {
                    $('#newsletter-form button').prop('disabled', false).text('اشترك الآن');
                    new Noty({
                        type: response.success ? 'success' : 'error',
                        text: response.message,
                        timeout: 3000,
                    }).show();
                    if (response.success) {
                        $('#newsletter-form')[0].reset();
                    }
                },
                error: function(response) {
                    $('#newsletter-form button').prop('disabled', false).text('اشترك الآن');
                    new Noty({
                        type: 'error',
                        text: response.message,
                        timeout: 3000,
                    }).show();
                }
            });
        });
    </script>
</body>

</html>
