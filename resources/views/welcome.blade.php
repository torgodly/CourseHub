@extends('layouts.app')

@section('content')
    <div class="pt-[120px] pb-[40px] flex items-center justify-center container mx-auto ">
        <div class="w-[550px] mt-12">
            <h2 class="text-3xl font-bold text-primary-orange">{{ __('welcome.learn_develop_launch') }}</h2>
            <h3 class="text-2xl text-neutral-gray mt-2 mb-4">{{ __('welcome.join_platform') }}</h3>
            <a href="{{ route('courses.index') }}"
                class="inline-block px-6 py-2 font-bold bg-primary-orange hover:bg-secondary-orange active:bg-yellow text-white text-xl rounded-full ">{{ __('welcome.browse') }}</a>
        </div>
        <img src="images/background1.png" alt="bg" class="w-[620px] h-auto">
    </div>
    <div class=" py-[40px]" id="courses">
        <div class="container mx-auto">
            <h2 class="text-3xl text-[#333] font-bold">
                <span>{{ __('welcome.training_courses') }}</span>
                <span class="text-primary-orange">{{ __('welcome.training') }}</span>
            </h2>
            <ul class="flex gap-x-2 py-5 text-xl text-[#333]">
                <li><a href="#">{{ __('welcome.latest_courses') }} -</a></li>
                <li><a href="#">{{ __('welcome.best_sellers') }} -</a></li>
                <li><a href="#">{{ __('welcome.free_courses') }}</a></li>
            </ul>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($courses->slice(0, 4) as $course)
                    <x-course-card :$course />
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('courses.index') }}"
                    class="inline-block px-6 py-2 bg-primary-orange hover:bg-secondary-orange text-white text-lg rounded-md font-bold">
                    {{ __('welcome.view_all_courses') }}
                </a>
            </div>

        </div>
    </div>
@endsection
