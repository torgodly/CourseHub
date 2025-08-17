@extends('layouts.app')

@section('content')
    <div class="p-6 flex gap-6 ">
        {{-- Left: Course Content --}}
        <div class="flex-1">

            {{-- Breadcrumbs --}}
            <div class="text-gray-500 text-sm mb-4">
                {{ $course->title }} < <a href="{{ route('courses.index') }}">{{ __('sections.courses') }}</a>
                    < <a href="{{ route('welcome') }}">{{ __('sections.home') }}</a>
            </div>

            {{-- Title --}}
            <h1 class="text-4xl font-bold"> {{ $section->title }} </h1>
            <a href="{{ route('courses.show', $course) }}"
                class="text-md text-gray-500 mb-4">{{ __('sections.from_course', ['course' => $course->title]) }}
            </a>

            {{-- Video --}}
            <div class="rounded-xl overflow-hidden shadow mb-6">
                <img src="https://placehold.co/800x450" alt="Course Thumbnail" class="w-full">
                <div class="bg-gray-900 text-white px-4 py-2 flex justify-between items-center">
                    <span>
                        {{ __('sections.video_duration', ['current' => '12:30', 'total' => '1:20:00']) }}
                    </span>
                </div>
            </div>


            <div class="flex items-center justify-between ">
                {{-- Author --}}
                <div class="flex items-center gap-3 mb-6">
                    {{-- <img src="{{ asset($course->trainer->avatar) ?? 'https://placehold.co/50x50' }}" class="rounded-full" --}}
                    <img src="{{ 'https://placehold.co/50x50' }}" class="rounded-full" alt="Mentor">
                    <div>
                        <p class="font-semibold"> {{ $course->trainer->name }} </p>
                        <p class="text-sm text-gray-500">
                            {{ __('sections.mentor_profession', ['profession' => 'Works at Google']) }} </p>
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
                <h2 class="font-bold text-lg mb-2">{{ __('sections.about_course') }}</h2>
                <p class="text-gray-700">
                    {{ $section->description }}
                </p>
            </div>

            {{-- Mobile: Progress + Lessons --}}
            <div class="my-10 block lg:hidden">
                {{-- Progress --}}
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="font-semibold mb-2">{{ __('sections.study_progress', ['progress' => '4%']) }}</h3>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-primary-orange h-2 rounded-full" style="width: 4%"></div>
                    </div>
                </div>

                {{-- Lessons --}}
                <div class="bg-white p-4 rounded-lg  shadow space-y-2 my-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold">{{ __('sections.course_completion') }}</span>
                        <span class="text-gray-500">1/{{ $course->sections->count() }}</span>
                    </div>

                    @foreach ($course->sections as $index => $section)
                        @if ($section->id == collect(request()->segments())->last())
                            <div class="flex items-center justify-between p-2 rounded bg-indigo-50">
                                <div class="flex items-center gap-2">
                                    <button class="text-primary-orange">
                                        {{ __('sections.pause') }}
                                    </button>
                                    <span>{{ $section->title }}</span>
                                </div>
                                <span class="text-sm text-gray-500">1h 20 min</span>
                            </div>
                        @else
                            <a href="{{ route('courses.sections.show', [$course, $section]) }}">
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-2">
                                        <button class="text-primary-orange">
                                            {{ __('sections.play') }}
                                        </button>
                                        <span class="">{{ $section->title }}</span>
                                    </div>
                                    <span class="text-sm text-gray-500">20 min</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
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

        </div>

        {{-- Right: Progress + Lessons --}}
        <div class="w-80 space-y-6 mt-22 hidden lg:block">
            {{-- Progress --}}
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="font-semibold mb-2">Your Study Progress 4%</h3>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-primary-orange h-2 rounded-full" style="width: 4%"></div>
                </div>
            </div>

            {{-- Lessons --}}
            <div class="bg-white p-4 rounded-lg  shadow space-y-2">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold">Course Completion</span>
                    <span class="text-gray-500">1/{{ $course->sections->count() }}</span>
                </div>

                @foreach ($course->sections as $index => $courseSection)
                    @if ($courseSection->id == collect(request()->segments())->last())
                        {{-- Current Section --}}
                        <div class="flex items-center justify-between p-2 rounded bg-indigo-50">
                            <div class="flex items-center gap-2">
                                <button class="text-primary-orange">⏸</button>
                                <span>{{ $courseSection->title }}</span>
                            </div>
                            <span class="text-sm text-gray-500">1h 20 min</span>
                        </div>
                    @else
                        <a href="{{ route('courses.sections.show', [$course, $courseSection]) }}">
                            <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                <div class="flex items-center gap-2">
                                    <button class="text-primary-orange">▶</button>
                                    <span class="">{{ $courseSection->title }}</span>
                                </div>
                                <span class="text-sm text-gray-500">20 min</span>
                            </div>
                        </a>
                    @endif
                @endforeach



            </div>
        </div>


    </div>
@endsection
