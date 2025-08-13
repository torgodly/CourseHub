@props(['course'])

@php
    use Illuminate\Support\Str;
@endphp

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-color-neutral-gray flex flex-col">
    {{-- Course Image --}}
    {{-- <img src="{{ asset($course->thumbnails) ?? 'https://placehold.co/500x300/000000/FFF' }}" alt="{{ $course->title }}" --}}
    <img src=" https://placehold.co/600x400/000000/FFF" alt="{{ $course->title }}"
        class="w-full h-44 object-cover bg-amber-50">

    <div class="p-6 flex flex-col flex-grow ">
        <div class="flex items-center justify-between mb-4">
            <div class="space-x-2 flex items-center">
                @auth
                    {{-- Favorite Icon --}}
                    <form class="" method="POST" action="{{ route('courses.favorite.toggle', $course) }}">
                        @csrf
                        @method('POST')
                        <button type="submit" @click="toggleFavorite" x-data="{ isFavorite: {{ $course->isFavoritedBy(auth()->user()) ? 'true' : 'false' }} }"
                            :class="isFavorite ? 'text-red-500' : 'text-gray-500'"
                            class="ml-4 text-xl transition-colors duration-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </button>
                    </form>
                @endauth

                {{-- Tag / Level --}}
                <span class="text-xs px-2 py-1 bg-purple-200 text-accent-purple rounded inline-block">
                    {{ $course->level ?? 'غير محدد' }}
                </span>
            </div>
            {{-- Rating --}}
            <div class="flex items-center text-yellow text-xl">
                ★ <span class="ml-1 text-black text-sm">{{ $course->average_rating ?? '0' }}</span>
            </div>
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
                alt="{{ $course->trainer->name ?? 'المدرب' }}">
            <span class="text-xs text-gray-600">
                {{ $course->trainer->name ?? 'غير معروف' }}
            </span>
        </div>


        {{-- Price & Button --}}
        <div class="flex items-center justify-between">
            <button
                class="flex items-center justify-center w-[85%] orange-300 mx-auto mt-auto rounded-md bg-primary-orange hover:bg-orange-600 font-bold text-white">
                <span class="text-sm font-medium pl-3 py-2">
                    أضف إلى السلة
                </span>
                <span class="px-2">|</span>
                <span class="text-lg mr-1">
                    {{ $course->price ?? '0' }} د.ل
                </span>
            </button>


        </div>
    </div>
</div>
