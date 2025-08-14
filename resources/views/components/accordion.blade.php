@props(['sections'])

<div x-data="{ open: 1 }" class="divide-y divide-gray-200 border border-gray-200 rounded-lg mt-4">


    @foreach ($sections as $index => $section)
        {{-- Accordion 1 --}}

        <div>
            <button @click="open = (open === {{ $index }} ? null : {{ $index }})"
                class="flex justify-between items-center w-full px-5 py-4 text-left font-semibold text-gray-800 hover:bg-gray-50">

                <span>{{ $index + 1 }} . {{ $section->title }}</span>
                <svg x-show="open !== {{ $index }}" class="w-4 h-4" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                <svg x-show="open === {{ $index }}" class="w-4 h-4" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M5 12h14" />
                </svg>
            </button>
            <div x-show="open === {{ $index }}" x-transition class="px-5 pb-4 text-gray-700">
                <em>{{ $section->description }}</em>
            </div>
        </div>
    @endforeach
</div>
