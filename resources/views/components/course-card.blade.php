@props(['course'])

@php
    use Illuminate\Support\Str;
@endphp

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-color-neutral-gray flex flex-col">
    {{-- Course Image --}}
    {{-- <img src="{{ asset($course->thumbnails) ?? 'https://placehold.co/500x300/000000/FFF' }}" alt="{{ $course->title }}" --}}
    <img src=" https://placehold.co/600x400/000000/FFF" alt="{{ $course->title }}"
        class="w-full h-44 object-cover bg-amber-50">

    <div class="p-6 flex flex-col flex-grow">
        <div class="flex items-center justify-between mb-4">
            {{-- Tag / Level --}}
            <span class="text-xs px-2 py-1 bg-purple-200 text-accent-purple rounded inline-block">
                {{ $course->level ?? 'غير محدد' }}
            </span>

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
