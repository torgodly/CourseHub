@extends('layouts.app')

@section('content')
    <div class="container min-h-[52vh] mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">{{ __('purchased_courses.title') }}</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ __('purchased_courses.description') }}
            </p>
        </div>

        <div>
            <div class="grid gap-4">
                @forelse ($purchasedCourses as $course)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden border border-color-neutral-gray flex flex-col sm:flex-row">

                        {{-- Course Image --}}
                        <img src="https://placehold.co/600x400/000000/FFF" alt="{{ $course->title }}"
                            class="w-full sm:w-48 h-40 sm:h-auto object-cover bg-amber-50">

                        {{-- Content --}}
                        <div class="p-4 flex flex-col flex-grow">
                            {{-- Title --}}
                            <h3 class="text-lg font-semibold text-primary-orange mb-1">
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="hover:text-primaryOrange transition-colors">
                                    {{ $course->title }}
                                </a>
                            </h3>

                            {{-- Description --}}
                            <p class="text-sm text-gray-500 mb-4">
                                {{ Str::words($course->description ?? '', 15, '...') }}
                            </p>

                            {{-- Instructor --}}
                            <div class="flex items-center gap-2 mt-auto">
                                <img src="{{ $course->trainer->image ?? 'https://placehold.co/40x40' }}"
                                    class="w-6 h-6 bg-primary-orange rounded-full object-cover"
                                    alt="{{ $course->trainer->name ?? __('purchased_courses.trainer') }}">
                                <span class="text-xs text-gray-600">
                                    {{ $course->trainer->name ?? __('purchased_courses.unknown') }}
                                </span>
                            </div>
                        </div>

                        {{-- Watch Now Icon --}}

                        <div class="text-center self-center  p-6">
                            <a href="{{ route('courses.sections.show', [$course, $course->sections[0]]) }}"
                                class="inline-block px-6 py-2 bg-primary-orange hover:bg-secondary-orange text-white text-lg rounded-md font-bold">
                                {{ __('purchased_courses.watch_now') }}
                            </a>
                        </div>

                    </div>
                @empty
                    {{-- No Favorites Message --}}
                    <div class="text-center  mt-4 flex gap-2 items-center justify-center">
                        <p class="text-gray-500"> {{ __('purchased_courses.no_courses') }}</p><a
                            class="text-primary-color underline cursor-pointer"
                            href="{{ route('courses.index') }}">{{ __('purchased_courses.go_to_courses') }}</a>
                    </div>
                @endforelse

            </div>
        </div>



        {{-- <div class="mt-6">{{ $purchasedCourses->links() }}</div> --}}

    </div>
@endsection
