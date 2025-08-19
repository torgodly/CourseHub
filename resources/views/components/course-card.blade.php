@props(['course'])

@php
    use Illuminate\Support\Str;
@endphp

<a href="{{ route('courses.show', $course->slug) }}">
    <div
        class="max-w-sm rounded-2xl overflow-hidden shadow-lg bg-white hover:shadow-xl transition duration-300 flex flex-col">
        {{-- Course Image --}}
        <img src="{{ asset($course->thumbnails) ?: 'https://placehold.co/500x300/000000/FFF' }}"
             alt="{{ $course->title }}"
             class="w-full h-48 object-cover">

        <div class="p-5 flex flex-col flex-grow">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    {{-- Rating --}}
                    <div class="flex items-center text-yellow-400 text-lg">
                        ★ <span class="ml-1 text-gray-800 text-sm">{{ $course->average_rating ?? '0' }}</span>
                    </div>

                    @auth
                        {{-- Favorite --}}
                        <form method="POST" action="{{ route('courses.favorite.toggle', $course) }}" class="ml-3">
                            @csrf
                            @method('POST')
                            <button type="submit" class="transition-colors duration-300 cursor-pointer">
                                <x-tabler-heart
                                    class="w-6 h-6 text-red-500 {{ $course->isFavoritedBy(auth()->user()) ? 'fill-red-500' : ' ' }}"/>
                            </button>
                        </form>

                    @endauth
                </div>

                {{-- Tags & Level --}}
                <div class="flex gap-2">
                    @forelse ($course->tags as $tag)
                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                        {{ $tag->name }}
                    </span>
                    @empty
                    @endforelse
                    @php
                        $levelClasses = [
                            'Beginner' => 'text-green-800 bg-green-100',
                            'Intermediate' => 'text-yellow-800 bg-yellow-100',
                            'Advanced' => 'text-red-800 bg-red-100',
                        ];
                        $levelKey = $course->level->name; // or ->value depending on your enum
                    @endphp

                    <span
                        class="text-xs px-2 py-1 rounded-full {{ $levelClasses[$levelKey] ?? 'text-gray-700 bg-gray-100' }}">
    {{ $course->level->getLabel() ?? __('Not specified') }}
</span>


                </div>
            </div>

            {{-- Title --}}
            <h3 class="text-lg font-semibold text-primary-orange mb-2">
                <p
                    class="hover:text-orange-600 transition-colors">
                    {{ $course->title }}
                </p>
            </h3>

            {{-- Description --}}
            <p class="text-sm text-gray-600 mb-4 flex-grow">
                {{ Str::words($course->description ?? '', 15, '...') }}
            </p>

            {{-- Instructor --}}
            <div class="flex items-center gap-2 mb-4">
                <img src="{{ $course->trainer->image ?? 'https://placehold.co/40x40' }}"
                     class="w-8 h-8 rounded-full object-cover"
                     alt="{{ $course->trainer->name ?? __('Trainer') }}">
                <span class="text-xs text-gray-700">
                {{ $course->trainer->name ?? __('Unknown') }}
            </span>
            </div>

            {{-- Price & Button --}}
            <div class="flex items-center justify-between mt-auto">
            <span class="text-indigo-600 font-bold text-lg">
                {{ $course->price ?? '0' }} {{ __('Currency') }}
            </span>
                @if(auth()->check() && auth()->user()->paid($course))

                    <button
                        class="px-4 py-2 bg-primary-orange hover:bg-orange-600 text-white text-sm rounded-xl transition">
                        {{ __('Continue Studying') }}

                    </button>
                @else
                    <button
                        class="px-4 py-2 bg-primary-orange hover:bg-orange-600 text-white text-sm rounded-xl transition">
                        {{ __('Enroll Now') }}
                    </button>
                @endif

            </div>
        </div>
    </div>
</a>
