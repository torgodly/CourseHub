@extends('layouts.app')

@section('content')
    <div class="p-6 flex gap-6 ">
        {{-- Left: Course Content --}}
        <div class="flex-1">

            {{-- Breadcrumbs --}}
            <div class="text-gray-500 text-sm mb-4">
                {{ $course->title }} < <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                    < <a href="{{ route('welcome') }}">{{ __('Home') }}</a>
            </div>

            {{-- Title --}}
            <h1 class="text-2xl font-bold mb-4"> {{ $course->title }} </h1>

            {{-- Video --}}
            <div class="rounded-xl overflow-hidden shadow mb-6">
                <img src="https://placehold.co/800x450" alt="Course Thumbnail" class="w-full">
                <div class="bg-gray-900 text-white px-4 py-2 flex justify-between items-center">
                    <span>⏯ 12:30 / 1:20:00</span>
                </div>
            </div>

            {{-- Author --}}
            <div class="flex items-center gap-3 mb-6">
                {{-- <img src="{{ asset($course->trainer->avatar) ?? 'https://placehold.co/50x50' }}" class="rounded-full" --}}
                <img src="{{ 'https://placehold.co/50x50' }}" class="rounded-full" alt="Mentor">
                <div>
                    <p class="font-semibold"> {{ $course->trainer->name }} </p>
                    <p class="text-sm text-gray-500">Mentor • {{ $course->trainer->profession }} Works at Google </p>
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

            <x-accordion :sections="$course->sections" />
        </div>

        {{-- Right: Progress + Lessons --}}
        <div class="w-80 space-y-6">
            {{-- Progress --}}
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Your Study Progress 4%</h3>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 4%"></div>
                </div>
            </div>

            {{-- Lessons --}}
            <div class="bg-white p-4 rounded-lg shadow space-y-2">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold">Course Completion</span>
                    <span class="text-gray-500">1/25</span>
                </div>
                @foreach ($course->sections as $index => $section)
                    <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                        <div class="flex items-center gap-2">
                            <button class="text-indigo-600">▶</button>
                            <span class="">{{ $section->title }}</span>
                        </div>
                        <span class="text-sm text-gray-500">20 min</span>
                    </div>
                @endforeach
                {{-- Lesson Item --}}
                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                    <div class="flex items-center gap-2">
                        <button class="text-indigo-600">▶</button>
                        <span>Introduction</span>
                    </div>
                    <span class="text-sm text-gray-500">20 min</span>
                </div>

                <div class="flex items-center justify-between p-2 rounded bg-indigo-50">
                    <div class="flex items-center gap-2">
                        <button class="text-indigo-600">⏸</button>
                        <span>Mastering Tools</span>
                    </div>
                    <span class="text-sm text-gray-500">1h 20 min</span>
                </div>

                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                    <div class="flex items-center gap-2">
                        <button class="text-indigo-600">▶</button>
                        <span>Mastering Adobe Illustrator</span>
                    </div>
                    <span class="text-sm text-gray-500">2h 10 min</span>
                </div>
            </div>
        </div>


    </div>
@endsection
