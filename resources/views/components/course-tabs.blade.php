@props(['active' => 'all'])

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4 px-4 sm:px-0">
    {{-- Added px-4 for default padding on the component itself on small screens --}}

    {{-- Tabs --}}
    {{-- Added overflow-x-auto and whitespace-nowrap for horizontal scrolling if tabs overflow --}}
    <div class="flex gap-6 border-b border-gray-200 overflow-x-auto whitespace-nowrap pb-2 scrollbar-hide">
        {{-- scrollbar-hide is a custom Tailwind plugin (or manual CSS) if you want to hide the scrollbar visually --}}
        @php
            $tabs = [
                'all' => __('All'),
                'new' => __('New'),
                'popular' => __('Popular'),
            ];
        @endphp

        @foreach ($tabs as $key => $label)
            <a href="{{ route('courses.index', ['tab' => $key]) }}"
               class="flex-shrink-0 {{-- Prevents tabs from shrinking if space is tight --}}
               pb-2 border-b-2 text-sm font-medium transition-colors duration-200
               {{ $active === $key
                    ? 'border-primary-orange text-primary-orange font-bold'
                    : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Sort & Filter --}}
    <div
        class="flex gap-3 flex-shrink-0 justify-end md:justify-normal"> {{-- Added flex-shrink-0 and justify-end for better mobile alignment --}}
        {{-- Sort Dropdown --}}
        <select
            class="block w-full sm:w-auto border rounded-xl px-3 py-2 text-sm font-medium text-gray-700 border-gray-300 focus:ring-2 focus:ring-primary-orange focus:border-primary-orange">
            {{-- Added block w-full sm:w-auto to make it full width on small screens and then auto on larger --}}
            <option>{{ __('Sort by') }}</option>
            <option>{{ __('Newest') }}</option>
            <option>{{ __('Oldest') }}</option>
            <option>{{ __('Most Popular') }}</option>
        </select>
        <select
            class="block w-full sm:w-auto border rounded-xl px-3 py-2 text-sm font-medium text-gray-700 border-gray-300 focus:ring-2 focus:ring-primary-orange focus:border-primary-orange">
            {{-- Added block w-full sm:w-auto to make it full width on small screens and then auto on larger --}}
            <option>{{ __('Sort by') }}</option>
            <option>{{ __('Newest') }}</option>
            <option>{{ __('Oldest') }}</option>
            <option>{{ __('Most Popular') }}</option>
        </select>

        {{-- Filter Button --}}
        <button
            class="flex-shrink-0 border rounded-xl px-3 py-2 text-sm font-medium text-gray-700 border-gray-300 flex items-center gap-2 hover:bg-gray-100 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V20a1 1 0 01-1.447.894l-4-2A1 1 0 018 18v-4.586L3.293 6.707A1 1 0 013 6V4z"/>
            </svg>
            {{ __('Filter') }}
        </button>
    </div>
</div>

{{-- Custom CSS for scrollbar-hide (optional, if you want to hide native scrollbar) --}}
{{--
<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
</style>
--}}
