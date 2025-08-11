@props(['course'])

@php
    use Illuminate\Support\Str;
@endphp

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 flex flex-col">
    {{-- Course Image --}}
    <img src="{{ asset($course->thumbnails) ?? 'https://placehold.co/600x400/000000/FFF' }}"
         alt="{{ $course->title }}"
         class="w-full h-48 object-cover">

    <div class="p-4 flex flex-col flex-grow">
        <div class="flex items-center justify-between mb-3">
            {{-- Tag / Level --}}
            <span class="text-xs px-2 py-1 bg-purple-100 text-purple-600 rounded inline-block">
                {{ $course->level ?? 'غير محدد' }}
            </span>

            {{-- Rating --}}
            <div class="flex items-center text-yellow-500 text-xl">
                ★ <span class="ml-1 text-black text-sm">{{ $course->average_rating ?? '0' }}</span>
            </div>
        </div>

        {{-- Title --}}
        <h3 class="text-lg font-semibold text-gray-800 mb-1">
            <a href="{{ route('courses.show', $course->slug) }}" class="hover:text-orange-500 transition-colors">
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
                 class="w-6 h-6 bg-orange-500 rounded-full object-cover"
                 alt="{{ $course->trainer->name ?? 'المدرب' }}">
            <span class="text-xs text-gray-600">
                {{ $course->trainer->name ?? 'غير معروف' }}
            </span>
        </div>

        {{-- Price & Button --}}
        <button
            class="flex items-center justify-center w-[85%] mx-auto mt-auto rounded bg-orange-500 hover:bg-orange-600 font-bold text-white">
            <span class="text-sm pl-3 py-2">
                أضف إلى السلة
            </span>
            <span class="px-2">|</span>
            <span class="text-lg mr-1">
                {{ $course->price ?? '0' }} د.ل
            </span>
        </button>
    </div>
</div>
