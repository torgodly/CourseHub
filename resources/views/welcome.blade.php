@extends('layouts.app')

@section('content')

    {{-- Hero Section --}}
    {{-- Adjusted padding-top to account for fixed header --}}
    <div class="pt-[90px] md:pt-[120px] pb-[40px] flex flex-col md:flex-row items-center justify-center container mx-auto px-4 md:px-0">
        {{-- flex-col on mobile, flex-row on md+ --}}
        {{-- Added px-4 for horizontal padding on smaller screens --}}

        <div class="w-full md:w-[550px] mt-8 md:mt-12 text-center md:text-left mb-8 md:mb-0">
            {{-- w-full on mobile, fixed width on md+ --}}
            {{-- text-center on mobile, text-left on md+ --}}
            {{-- Added mb-8 on mobile to space out from the image --}}

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-primary-orange leading-tight">
                {{-- Responsive font sizes for h2 --}}
                {{ __('Learn, Develop & Launch Your Skills') }}
            </h2>
            <h3 class="text-xl sm:text-2xl text-neutral-gray mt-2 mb-6">
                {{-- Responsive font sizes for h3 --}}
                {{ __('Join our platform and start your journey today') }}
            </h3>
            <a href="{{ route('courses.index') }}"
               class="inline-block px-8 py-3 text-lg sm:text-xl font-bold bg-primary-orange hover:bg-secondary-orange active:bg-yellow text-white rounded-full transition duration-300">
                {{-- Increased padding and adjusted text size for better tap target --}}
                {{ __('Browse Courses') }}
            </a>
        </div>

        {{-- Image Section --}}
        <div class="w-full md:w-[620px] mt-8 md:mt-0 flex justify-center md:justify-start">
            {{-- w-full on mobile, fixed width on md+ --}}
            {{-- flex justify-center to center image on mobile --}}
            <img src="{{ asset('images/background1.png') }}" alt="bg" class="w-full h-auto max-w-md md:max-w-full object-contain">
            {{-- w-full for full width on mobile, max-w-md to prevent excessive size on tablet-ish screens, object-contain to maintain aspect ratio --}}
        </div>
    </div>

    {{-- Training Courses Section --}}
    <div class="py-[40px]" id="courses">
        <div class="container mx-auto px-4 md:px-0"> {{-- Added px-4 for horizontal padding on smaller screens --}}

            <h2 class="text-2xl sm:text-3xl text-[#333] font-bold mb-4"> {{-- Responsive font size for h2, added mb-4 --}}
                <span>{{ __('Training ') }}</span>
                <span class="text-primary-orange">{{ __('Courses') }}</span>
            </h2>

            {{-- Course Filter/Sort Links --}}
            <ul class="flex flex-wrap gap-x-4 sm:gap-x-6 py-3 text-base sm:text-xl text-[#333] mb-6">
                {{-- flex-wrap to allow items to wrap, increased gap for better spacing, adjusted text size --}}
                <li><a href="#" class="hover:text-primary-orange transition-colors">{{ __('Latest Courses -') }}</a></li>
                <li><a href="#" class="hover:text-primary-orange transition-colors">{{ __('Best Sellers -') }}</a></li>
                <li><a href="#" class="hover:text-primary-orange transition-colors">{{ __('Free Courses') }}</a></li>
            </ul>

            {{-- Courses Grid --}}
            {{-- This part is already very good for responsiveness due to your existing grid classes --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($courses->slice(0, 4) as $course)
                    <x-course-card :$course />
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('courses.index') }}"
                   class="inline-block px-8 py-3 text-base sm:text-lg bg-primary-orange hover:bg-secondary-orange text-white rounded-md font-bold transition duration-300">
                    {{-- Increased padding and adjusted text size for better tap target --}}
                    {{ __('View All Courses') }}
                </a>
            </div>

        </div>
    </div>
@endsection
