@extends('layouts.app')

@section('content')
    <div class="p-6 flex gap-6 ">
        {{-- Left: Course Content --}}
        <div class="flex-1 mt-4">

            {{-- Breadcrumbs --}}
            <div class="text-gray-500 text-sm mb-4">



                <a href="{{ route('welcome') }}"> {{ __('courses.home') }} </a>
                >
                <a href="{{ route('courses.index') }}"> {{ __('courses.title') }} </a>
                >
                {{ $course->title }}
            </div>

            {{-- Title --}}
            <h1 class="text-4xl font-bold mb-4"> {{ $course->title }} </h1>

            {{-- Video --}}
            <div class="rounded-xl overflow-hidden shadow mb-6">
                <img src="https://placehold.co/800x450" alt="Course Thumbnail" class="w-full">
                <div class="bg-gray-900 text-white px-4 py-2 flex justify-between items-center">
                    <span>⏯ 12:30 / 1:20:00</span>
                </div>
            </div>


            <div class="flex items-center justify-between ">
                {{-- Author --}}
                <div class="flex items-center gap-3 mb-6">
                    {{-- <img src="{{ asset($course->trainer->avatar) ?? 'https://placehold.co/50x50' }}" class="rounded-full" --}}
                    <img src="{{ 'https://placehold.co/50x50' }}" class="rounded-full" alt="Mentor">
                    <div>
                        <p class="font-semibold"> {{ $course->trainer->name }} </p>
                        <p class="text-sm text-gray-500">Mentor • {{ $course->trainer->profession }} Works at Google </p>
                    </div>
                </div>

                {{-- Favorite Button --}}
                <div class="save">
                    @auth
                        {{-- Favorite Icon --}}
                        <form method="POST" action="{{ route('courses.favorite.toggle', $course) }}">
                            @csrf
                            <button type="submit">
                                @if ($course->isFavoritedBy(auth()->user()))
                                    <x-heroicon-s-heart class="w-10 h-10 text-red-500" />
                                @else
                                    <x-heroicon-s-heart class="w-10 h-10 text-gray-500" />
                                @endif

                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            {{-- About --}}
            <div class="mb-6">
                <h2 class="font-bold text-lg mb-2">About This Course</h2>
                <p class="text-gray-700">
                    Unlock your creative potential with our Beginner-Level Illustrator Course! ...
                    {{ $course->description }}
                </p>
            </div>

            {{-- Suit For --}}
            <div>
                <h2 class="font-bold text-lg mb-2">This Course Suit For:</h2>
                <ul class="list-disc pl-6 mr-3 text-gray-700 space-y-1">
                    <li>Anyone who wants to start their career ...</li>
                    <li>This course is for beginners ...</li>
                    <li>For anyone who needs to add Illustration ...</li>
                    <li>Aimed at people new to the world ...</li>
                </ul>
            </div>

            {{-- <x-buy-course-card :course="$course" /> --}}

            <x-accordion :course="$course" />
        </div>

        {{-- Right: Progress + Lessons --}}
        <x-buy-course-card :course="$course" />


    </div>
@endsection
