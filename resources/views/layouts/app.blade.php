<!DOCTYPE html>
<html dir="rtl" lang="ar"> <!-- lang="ar": يحدد أن لغة الصفحة هي العربية-->
    <!-- dir="rtl": يضبط الاتجاه الافتراضي للنص ليكون من اليمين إلى اليسار -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>آفاق | دورات تدربية</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
            rel="stylesheet">
        rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body style=" font-family: 'IBM Plex Sans Arabic', sans-serif;">
        <header class="shadow-lg fixed top-0 right-0 left-0 z-10 bg-white" x-data="{ open: false }">
            <div class="container mx-auto h-20 px-4 pt-3 flex justify-between">
                <div class="flex items-center gap-x-8">
                    <a href="/" class="relative -top-2">
                        <img src="{{ asset('images/Red AFAQ Logo Ver.png') }}" alt="AFAQ logo" class="w-36 h-auto">
                    </a>
                    <a href=""
                        class="text-[#333] font-bold active:underline active:decoration-20 active:underline-offset-8 active:decoration-primary-orange hover:text-primary-orange">فئات</a>
                    {{-- @if (Auth::user()->is_admin)
                <a href="{{ route('trainer', Auth::user()->id) }}"
                    class="text-[#333] font-bold active:underline active:decoration-20 active:underline-offset-8 active:decoration-primary-orange hover:text-primary-orange">لوحة
                    تحكم المدرب</a>
            @elseif (Auth::user() !== null)
                <a href="{{ route('instructor.create1', Auth::user()->id) }}"
                    class="text-[#333] font-bold active:underline active:decoration-20 active:underline-offset-8 active:decoration-primary-orange hover:text-primary-orange">سجل
                    كمدرب</a>
            @else
                <a href="{{ route('instructor.create2') }}"
                    class="text-[#333] font-bold  active:underline active:decoration-20 active:underline-offset-8 active:decoration-primary-orange hover:text-primary-orange">سجل
                    كمدرب</a>
            @endif --}}

                </div>
                <div class="flex items-center">
                    <form>

                        <div class="relative group">
                            <input
                                class=" w-[250px] bg-[#f4f4f4] placeholder:text-[#757575] placeholder: text-slate-700 text-sm border border-[#f4f4f4] rounded-full px-3 py-2 transition duration-300  focus:border-[#f7e4d6] focus:bg-[#f7e4d6] focus:ring-0 "
                                placeholder="ابحث" />
                            <button class="absolute top-2 left-3 " type="button">
                                <i
                                    class="fa-solid fa-magnifying-glass text-lg text-[#757575] group-focus-within:text-primary-orange transition duration-300 "></i>

                            </button>
                        </div>

                    </form>
                </div>
                @if (Route::has('login'))
                    <div class="flex items-center gap-x-3">
                        @auth

                            <div class="flex items-center gap-x-3">
                                <a href="#" class="relative top-[3px] ">
                                    <i class="fa-regular fa-heart text-xl "></i>
                                </a>

                                <a href="#" class="relative top-[4px] ">
                                    <i class="fa-solid fa-cart-shopping text-xl "></i>
                                </a>

                                <a href="#"
                                    class="bg-primary-orange px-3 py-2 text-white font-bold rounded-full hover:bg-primary-orange active:bg-primary-orange">
                                    لوحتي التعليمية
                                </a>
                                <div class="flex items-center gap-3 px-3 rounded-lg h-[55px] w-fit font-sans">
                                    <!-- Icon -->
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

                                    <!-- Balance Info -->
                                    <div class="flex flex-col items-start justify-start ml-4">
                                        <span class="text-[8px] text-black font-light tracking-[0.6px]">Wallet
                                            balance</span>
                                        <p class="text-[13.5px] text-black font-semibold tracking-[0.5px]">
                                            <span id="currency">$</span>{{ auth()->user()->wallet->balance }}
                                        </p>
                                    </div>

                                    <!-- Button -->
                                    <button
                                        class="flex items-center justify-center gap-1 px-4 py-[2px] bg-primary-orange text-white text-xs rounded-full transition-all duration-300 hover:bg-white hover:text-primary-orange hover:ring-2 hover:ring-primary-orange focus:outline-none focus:ring-2 focus:ring-primary-orange">
                                        <span class="text-lg leading-none">+</span>Add Money
                                    </button>
                                </div>

                            </div>

                            <div class="hidden sm:flex sm:items-center ">
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
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.show')">
                                            {{ __('حسابي') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('courses.purchased')">
                                            {{ __('الدورات المشتراة') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('favorites.index')">
                                            {{ __('المفضلة') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                {{ __('تسجيل خروج') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @else
                            <a href="{{ route('register') }}"
                                class="px-3 py-2 text-primary-orange font-bold rounded-full border border-primary-orange ">
                                تسجيل جديد
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('login') }}"
                                    class="px-3 py-2 text-primary-orange font-bold rounded-full border ">
                                    تسجيل دخول
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>


        </header>
        {{-- Main Content --}}
        <main class="flex-grow container my-10 mx-auto">
            @yield('content')
        </main>
    </body>



    <div class="bg-[#f7e4d6] pt-10 pb-[15px]">
        <div class="container mx-auto">
            <div class="flex gap-x-20">
                <ul>
                    <li class="text-xl text-[#333] font-bold mb-3">آفاق</li>
                    <li class="mb-3 text-[#333]"><a href="#">عن آفاق</a></li>
                    <li class="mb-3 text-[#333]"><a href="#">تواصل معنا</a></li>
                    <li class="mb-3 text-[#333]"><a href="#">شروط والأحكام</a></li>
                </ul>
                <ul>
                    <li class="text-xl text-[#333] font-bold mb-3">الروابط</li>
                    <li class="mb-3 text-[#333]"><a href="/">الرئيسية</a></li>
                    <li class="mb-3 text-[#333]"><a href="#">انظم كمدرب</a></li>
                    <li class="mb-3 text-[#333]"><a href="#">فئات</a></A></li>
                </ul>
                <ul>
                    <li class="text-xl text-[#333] font-bold mb-3">التواصل</li>
                    <li class="mb-3 text-[#333]">
                        <a href="https://wa.me/218910078151" target="_blank">
                            0910078151
                        </a>
                    </li>
                    <li class="mb-3 text-[#333]"><a href="{{ 'mailto:mahaalkurmaji8@gmail.com' }}"
                            target="_blank">mahaalkurmaji8@gmail.com</a></li>
                    <li class="mb-3 text-[#333] text-3xl flex gap-x-4">
                        <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-square-x-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="mt-16 text-center text-[#333] font-light">
                جميع الحقوق محفوظة © {{ date('Y') }} منصة آفاق
            </div>
        </div>
    </div>


    </body>


</html>
