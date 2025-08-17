@props(['course'])

<div x-data="{ open: null }" class="divide-y divide-gray-200 border border-gray-200 rounded-lg mt-4">

    @foreach ($course->sections as $index => $section)
        {{-- Accordion 1 --}}

        <div>
            <button @click="open = (open === {{ $index }} ? null : {{ $index }})"
                class="flex justify-between items-center w-full px-5 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50">

                {{-- TODO:: View Show Section to users who purchased the course only --}}
                @auth
                    <a href="{{ route('courses.sections.show', [$course, $section]) }}">
                        <span>{{ $index + 1 }}
                            .
                            {{ $section->title }}</span>
                    </a>
                @else
                    <div>
                        <span>{{ $index + 1 }}
                            .
                            {{ $section->title }}</span>
                    </div>

                @endauth

                <svg fill="#000000" x-show="open !== {{ $index }}" class="h-10 w-10 mt-2" version="1.1"
                    id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 500 500" enable-background="new 0 0 500 500" xml:space="preserve">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M306,192h-48v-48c0-4.4-3.6-8-8-8s-8,3.6-8,8v48h-48c-4.4,0-8,3.6-8,8s3.6,8,8,8h48v48c0,4.4,3.6,8,8,8s8-3.6,8-8v-48h48 c4.4,0,8-3.6,8-8S310.4,192,306,192z">
                        </path>
                    </g>
                </svg>



                <svg class="w-4 h-4 mt-4 ml-3" fill="none" x-show="open === {{ $index }}"
                    stroke="currentColor" stroke-width="2">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M6 12L18 12" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </g>
                    </svg>
                </svg>

            </button>
            <div x-show="open === {{ $index }}" x-transition class="px-5 pb-4 text-gray-700">
                <em>{{ $section->description }}</em>
            </div>
        </div>
    @endforeach
</div>
