@props(['course'])

@php
    use Illuminate\Support\Str;
@endphp

<div class=" overflow-hidden bg-transparent flex flex-col relative">
    {{-- Course Image --}}
    {{-- <img src="{{ asset($course->thumbnails) ?? 'https://placehold.co/500x300/000000/FFF' }}" alt="{{ $course->title }}"> --}}

    <img src=" https://placehold.co/600x400/000000/FFF" alt="{{ $course->title }}"
        class="w-full shadow-md h-44 rounded-xl object-cover mb-2">

    <div class="p-4 pt-1 bg-white flex flex-col flex-grow rounded-2xl border ">
        <div class="flex items-center justify-between mb-4 bg-white pt-2  rounded-md">


            <div class="flex items-center ">
                {{-- Rating --}}
                <div class="flex items-center mb-1 text-yellow text-xl">
                    ★ <span class="ml-1 text-black text-sm">{{ $course->average_rating ?? '0' }}</span>
                </div>
                @auth
                    {{-- Favorite Icon --}}
                    <form class="" method="POST" action="{{ route('courses.favorite.toggle', $course) }}">
                        @csrf
                        @method('POST')
                        <button type="submit" @click="toggleFavorite" x-data="{ isFavorite: {{ $course->isFavoritedBy(auth()->user()) ? 'true' : 'false' }} }"
                            :class="isFavorite ? 'text-red-500' : 'text-gray-500'"
                            class="mr-4 mt-1 text-xl transition-colors duration-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </button>
                    </form>
                @endauth
            </div>

            {{-- Tag / Level --}}
            @forelse ($course->tags as $tag)
                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full ">
                    {{ $course->tag->name }}
                </span>
            @empty
            @endforelse

            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full ">
                {{ $course->level ?? __('course_card.not_specified') }}
            </span>

        </div>

        {{-- Title --}}
        <h3 class="text-lg font-semibold text-primary-orange mb-1">
            <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-primaryOrange transition-colors">
                {{ $course->title }}
            </a>
        </h3>

        {{-- Description (limited to 100 words) --}}
        <p class="text-sm text-gray-500 mb-4 flex-grow">
            {{ Str::words($course->description ?? '', 15, '...') }}
        </p>

        {{-- Instructor --}}
        <div class="flex items-center gap-2 mb-4">
            <img src="{{ $course->trainer->image ?? 'https://placehold.co/40x40' }}"
                class="w-6 h-6 bg-primary-orange rounded-full object-cover"
                alt="{{ $course->trainer->name ?? __('course_card.trainer') }}">
            <span class="text-xs text-gray-600">
                {{ $course->trainer->name ?? __('course_card.unknown') }}
            </span>
        </div>


        {{-- Price & Button --}}
        <div class="flex items-center justify-between">
            <button
                class="flex items-center justify-center px-3 py-2 orange-300 mx-auto mt-auto rounded-md bg-primary-orange hover:bg-orange-600 font-bold text-white">

                <span class="text-lg mr-1">
                    {{ $course->price ?? '0' }} {{ __('course_card.currency') }}
                </span>
            </button>


        </div>
    </div>
</div>
