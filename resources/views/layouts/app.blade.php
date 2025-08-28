<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Afaq Platform') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Add Font Awesome for social icons, if not already included --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="font-family: 'IBM Plex Sans Arabic', sans-serif;">

<header class="shadow-lg fixed top-0 right-0 left-0 z-50 bg-white" x-data="{ open: false }">
    <div class="container mx-auto h-20 px-4 pt-3 flex items-center justify-between">
        {{-- Logo --}}
        <div class="flex gap-3 justify-center items-center">
            <a href="/" class="relative -top-2">
                <img src="{{ asset('images/Red AFAQ Logo Ver.png') }}" alt="AFAQ logo" class="w-28 h-auto md:w-36">
            </a>

            {{-- Desktop Navigation (hidden on mobile) --}}

            {{-- Language Switcher (hidden on mobile) --}}
            <div class="hidden md:flex items-center gap-x-6">
                <a href="{{ route('lang.switch', 'en') }}"
                   class="{{ app()->getLocale() === 'en' ? 'font-bold underline' : '' }}">
                    English
                </a>
                <a href="{{ route('lang.switch', 'ar') }}"
                   class="{{ app()->getLocale() === 'ar' ? 'font-bold underline' : '' }}">
                    العربية
                </a>
            </div>
        </div>

        {{-- Search Bar (hidden on mobile) --}}
        <div class="hidden md:flex items-center">
            <form action="{{ route('courses.index') }}" method="GET" class="flex items-center">
                <div class="relative group">
                    <input name="search"
                           class="w-[250px] bg-[#f4f4f4] placeholder:text-[#757575] text-sm border border-[#f4f4f4] rounded-full px-3 py-2 transition duration-300 focus:border-[#f7e4d6] focus:bg-[#f7e4d6] focus:ring-0"
                           placeholder="{{ __('Search courses...') }}"/>
                    <button class="absolute top-2 rtl:left-3 ltr:right-3" type="submit">
                        {{-- Changed to type="submit" for actual search --}}
                        <x-tabler-search
                            class="text-lg text-[#757575] group-focus-within:text-primary-orange transition duration-300"/>
                    </button>
                </div>
            </form>
        </div>

        {{-- Auth Section (hidden on mobile, uses desktop dropdown) --}}
        <div class="hidden md:flex items-center gap-x-3">
            @auth
                {{-- Wallet Info --}}
                <div class="flex items-center gap-3 px-3 rounded-lg h-[55px] w-fit font-sans">
                    <div class="w-7 flex items-center justify-center">
                        <svg viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg"
                             class="w-full">
                            <rect x="0.539915" y="6.28937" width="21" height="4" rx="1.5"
                                  transform="rotate(-4.77865 0.539915 6.28937)" fill="#7D6B9D" stroke="black">
                            </rect>
                            <circle cx="11.5" cy="5.5" r="4.5" fill="#E7E037" stroke="#F9FD50"
                                    stroke-width="2"></circle>
                            <path
                                d="M2.12011 6.64507C7.75028 6.98651 12.7643 6.94947 21.935 6.58499C22.789 6.55105 23.5 7.23329 23.5 8.08585V24C23.5 24.8284 22.8284 25.5 22 25.5H2C1.17157 25.5 0.5 24.8284 0.5 24V8.15475C0.5 7.2846 1.24157 6.59179 2.12011 6.64507Z"
                                fill="#BF8AEB" stroke="black"></path>
                            <path
                                d="M16 13.5H23.5V18.5H16C14.6193 18.5 13.5 17.3807 13.5 16C13.5 14.6193 14.6193 13.5 16 13.5Z"
                                fill="#BF8AEB" stroke="black"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col items-start justify-start ml-4">
                        <span class="text-xs text-black font-light tracking-[0.6px]">{{ __('Wallet Balance') }}</span>
                        <p class="text-[13.5px] text-black font-semibold tracking-[0.5px]">
                            <span id="currency">$</span>{{ auth()->user()->wallet->balance }}
                        </p>
                    </div>
                    <a href="{{ route('wallet.index') }}"
                       class="flex items-center justify-center gap-1 px-4 py-2 font-bold bg-primary-orange text-white text-xs rounded-full transition-all duration-300 hover:bg-white hover:text-primary-orange hover:ring-2 hover:ring-primary-orange focus:outline-none focus:ring-2 focus:ring-primary-orange">
                        <span class="text-lg leading-none">+</span>{{ __('Add Money') }}
                    </a>
                </div>
                @if(auth()->user()->type =='admin')
                    <a href="/admin"
                       class="flex items-center justify-center gap-1 px-4 py-2 font-bold bg-primary-orange text-white text-xs rounded-full transition-all duration-300 hover:bg-white hover:text-primary-orange hover:ring-2 hover:ring-orange-500 focus:outline-none focus:ring-2 focus:ring-primary-orange">
                        <span class="text-lg leading-none"></span>{{ __('My Dashboard') }}
                    </a>
                @elseif(auth()->user()->type =='trainer')
                    <a href="/trainer"
                       class="flex items-center justify-center gap-1 px-4 py-2 font-bold bg-primary-orange text-white text-xs rounded-full transition-all duration-300 hover:bg-white hover:text-primary-orange hover:ring-2 hover:ring-orange-500 focus:outline-none focus:ring-2 focus:ring-primary-orange">
                        <span class="text-lg leading-none"></span>{{ __('My Dashboard') }}
                    </a>
                @endif

                {{-- User Dropdown --}}
                <div class="sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.show')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('courses.purchased')">
                                {{ __('Purchased Courses') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('favorites.index')">
                                {{ __('Favorites') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <a href="{{ route('register') }}"
                   class="px-3 py-2 text-primary-orange font-bold rounded-full border border-primary-orange hover:bg-primary-orange hover:text-white transition duration-300">
                    {{ __('Register') }}
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('login') }}"
                       class="px-3 py-2 text-primary-orange font-bold rounded-full border hover:bg-primary-orange hover:text-white transition duration-300">
                        {{ __('Login') }}
                    </a>
                @endif
            @endauth
        </div>

        {{-- Mobile Menu Button (visible on mobile) --}}
        <div class="md:hidden flex items-center">
            <button @click="open = !open" class="text-gray-500 hover:text-primary-orange focus:outline-none">
                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu (hidden by default, toggles open on click) --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden fixed inset-0 bg-white p-6 pt-20 overflow-y-auto z-40">
        <div class="flex flex-col space-y-6">

            {{-- Mobile Search Bar --}}
            <form action="{{ route('courses.index') }}" method="GET" class="flex items-center w-full">
                <div class="relative group w-full">
                    <input name="search"
                           class="w-full bg-[#f4f4f4] placeholder:text-[#757575] text-sm border border-[#f4f4f4] rounded-full px-4 py-3 transition duration-300 focus:border-[#f7e4d6] focus:bg-[#f7e4d6] focus:ring-0"
                           placeholder="{{ __('Search courses...') }}"/>
                    <button class="absolute top-1/2 -translate-y-1/2 rtl:left-4 ltr:right-4" type="submit">
                        <x-tabler-search
                            class="text-xl text-[#757575] group-focus-within:text-primary-orange transition duration-300"/>
                    </button>
                </div>
            </form>

            {{-- Mobile Categories --}}


            {{-- Mobile Language Switcher --}}
            <div class="flex items-center gap-x-6 text-lg">
                <a href="{{ route('lang.switch', 'en') }}"
                   class="{{ app()->getLocale() === 'en' ? 'font-bold underline text-primary-orange' : '' }} hover:text-primary-orange">
                    English
                </a>
                <a href="{{ route('lang.switch', 'ar') }}"
                   class="{{ app()->getLocale() === 'ar' ? 'font-bold underline text-primary-orange' : '' }} hover:text-primary-orange">
                    العربية
                </a>
            </div>

            <div class="border-t border-gray-200 pt-6">
                @auth
                    {{-- Mobile Wallet Info --}}
                    <div class="flex flex-col gap-y-4 mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-7 flex items-center justify-center">
                                <svg viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg"
                                     class="w-full">
                                    <rect x="0.539915" y="6.28937" width="21" height="4" rx="1.5"
                                          transform="rotate(-4.77865 0.539915 6.28937)" fill="#7D6B9D" stroke="black">
                                    </rect>
                                    <circle cx="11.5" cy="5.5" r="4.5" fill="#E7E037" stroke="#F9FD50"
                                            stroke-width="2"></circle>
                                    <path
                                        d="M2.12011 6.64507C7.75028 6.98651 12.7643 6.94947 21.935 6.58499C22.789 6.55105 23.5 7.23329 23.5 8.08585V24C23.5 24.8284 22.8284 25.5 22 25.5H2C1.17157 25.5 0.5 24.8284 0.5 24V8.15475C0.5 7.2846 1.24157 6.59179 2.12011 6.64507Z"
                                        fill="#BF8AEB" stroke="black"></path>
                                    <path
                                        d="M16 13.5H23.5V18.5H16C14.6193 18.5 13.5 17.3807 13.5 16C13.5 14.6193 14.6193 13.5 16 13.5Z"
                                        fill="#BF8AEB" stroke="black"></path>
                                </svg>
                            </div>
                            <div class="flex flex-col items-start justify-start ml-4">
                                    <span
                                        class="text-sm text-black font-light tracking-[0.6px]">{{ __('Wallet Balance') }}</span>
                                <p class="text-base text-black font-semibold tracking-[0.5px]">
                                    <span id="currency">$</span>{{ auth()->user()->wallet->balance }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('wallet.index') }}"
                           class="w-full text-center px-4 py-2 font-bold bg-primary-orange text-white text-sm rounded-full transition-all duration-300 hover:bg-white hover:text-primary-orange hover:ring-2 hover:ring-primary-orange focus:outline-none focus:ring-2 focus:ring-primary-orange">
                            <span class="text-lg leading-none">+</span>{{ __('Add Money') }}
                        </a>
                    </div>

                    {{-- Mobile Dashboard/Profile Links --}}
                    <a href="/trainer"
                       class="w-full text-center block px-4 py-2 font-bold bg-primary-orange text-white text-sm rounded-full transition-all duration-300 hover:bg-white hover:text-primary-orange hover:ring-2 hover:ring-primary-orange focus:outline-none focus:ring-2 focus:ring-primary-orange mb-4">
                        {{ __('My Dashboard') }}
                    </a>

                    <p class="text-lg font-bold text-gray-700 mb-2">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.show') }}"
                       class="block px-3 py-2 text-gray-700 hover:text-primary-orange hover:bg-gray-100 rounded-md">{{ __('Profile') }}</a>
                    <a href="{{ route('courses.purchased') }}"
                       class="block px-3 py-2 text-gray-700 hover:text-primary-orange hover:bg-gray-100 rounded-md">{{ __('Purchased Courses') }}</a>
                    <a href="{{ route('favorites.index') }}"
                       class="block px-3 py-2 text-gray-700 hover:text-primary-orange hover:bg-gray-100 rounded-md">{{ __('Favorites') }}</a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit"
                                class="w-full text-left block px-3 py-2 text-red-600 hover:bg-red-50 rounded-md">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}"
                       class="w-full text-center block px-4 py-2 text-primary-orange font-bold rounded-full border border-primary-orange hover:bg-primary-orange hover:text-white transition duration-300 mb-4">
                        {{ __('Register') }}
                    </a>
                    <a href="{{ route('login') }}"
                       class="w-full text-center block px-4 py-2 text-primary-orange font-bold rounded-full border hover:bg-primary-orange hover:text-white transition duration-300">
                        {{ __('Login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

{{-- Main Content --}}
<main class="flex-grow container my-10 mx-auto pt-20 md:pt-0"> {{-- Added pt-20 to push content below fixed header --}}
    @yield('content')
</main>

<div class="bg-[#f7e4d6] pt-10 pb-[15px]">
    <div class="container mx-auto px-4">
        {{-- Made footer items wrap on small screens --}}
        <div class="flex flex-col md:flex-row gap-y-8 md:gap-y-0 md:gap-x-20">
            <ul class="w-full md:w-auto">
                <li class="text-xl text-[#333] font-bold mb-3">{{ __('About Afaq') }}</li>
                <li class="mb-3 text-[#333]"><a href="#" class="hover:text-primary-orange">{{ __('About Us') }}</a></li>
                <li class="mb-3 text-[#333]"><a href="#" class="hover:text-primary-orange">{{ __('Contact Us') }}</a>
                </li>
                <li class="mb-3 text-[#333]"><a href="#"
                                                class="hover:text-primary-orange">{{ __('Terms & Conditions') }}</a>
                </li>
            </ul>
            <ul class="w-full md:w-auto">
                <li class="text-xl text-[#333] font-bold mb-3">{{ __('Quick Links') }}</li>
                <li class="mb-3 text-[#333]"><a href="/" class="hover:text-primary-orange">{{ __('Home') }}</a></li>
                <li class="mb-3 text-[#333]"><a href="#"
                                                class="hover:text-primary-orange">{{ __('Become a Trainer') }}</a></li>
                <li class="mb-3 text-[#333]"><a href="#" class="hover:text-primary-orange">{{ __('Categories') }}</a>
                </li>
            </ul>
            <ul class="w-full md:w-auto">
                <li class="text-xl text-[#333] font-bold mb-3">{{ __('Connect With Us') }}</li>
                <li class="mb-3 text-[#333]">
                    <a href="https://wa.me/218910078151" target="_blank" class="hover:text-primary-orange">
                        0910078151
                    </a>
                </li>
                <li class="mb-3 text-[#333]"><a href="{{ 'mailto:mahaalkurmaji8@gmail.com' }}" target="_blank"
                                                class="hover:text-primary-orange">mahaalkurmaji8@gmail.com</a></li>
                <li class="mb-3 text-[#333] text-3xl flex gap-x-4">
                    <a href="#" class="hover:text-primary-orange"><i class="fa-brands fa-square-facebook"></i></a>
                    <a href="#" class="hover:text-primary-orange"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-primary-orange"><i class="fa-brands fa-square-x-twitter"></i></a>
                    <a href="#" class="hover:text-primary-orange"><i class="fa-brands fa-linkedin"></i></a>
                </li>
            </ul>
        </div>
        <div class="mt-16 text-center text-[#333] font-light">
            {{ __('Copyright © :year Afaq Platform. All Rights Reserved.', ['year' => date('Y')]) }}
        </div>
    </div>
</div>
@stack('scripts')
</body>

</html>
