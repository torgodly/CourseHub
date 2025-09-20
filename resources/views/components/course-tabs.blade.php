@props(['active' => 'all', 'tags' => []])

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4 px-4 sm:px-0">

    {{-- Tabs --}}
    <div class="flex gap-6 border-b border-gray-200 overflow-x-auto whitespace-nowrap pb-2 scrollbar-hide">
        @php
            $tabs = [
                'all' => __('All'),
                'new' => __('New'),
                'popular' => __('Popular'),
            ];
        @endphp

        @foreach ($tabs as $key => $label)
            <a href="{{ route('courses.index', ['tab' => $key]) }}"
               class="flex-shrink-0 pb-2 border-b-2 text-sm font-medium transition-colors duration-200
               {{ $active === $key
                    ? 'border-primary-orange text-primary-orange font-bold'
                    : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Search, Sort & Filter --}}
    <div class="flex gap-3 flex-shrink-0 justify-end md:justify-normal items-center flex-wrap">

        {{-- Search Input --}}
        <div class="flex flex-col">
            <label for="course-search" class="text-sm font-medium text-gray-700 mb-1">
                {{ __('Search') }}
            </label>
            <input
                id="course-search"
                type="text"
                name="search"
                placeholder="{{ __('Search courses...') }}"
                value="{{ request('search') }}"
                title="{{ __('Search courses by name or keyword') }}"
                class="w-full sm:w-56 border rounded-xl px-3 py-2 text-sm text-gray-700
               border-gray-300 focus:ring-2 focus:ring-primary-orange
               focus:border-primary-orange placeholder-gray-400"
            >
        </div>

        <script>
            document.getElementById('course-search').addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const url = new window.URL(window.location.href);

                    if (this.value.trim()) {
                        url.searchParams.set('search', this.value.trim());
                    } else {
                        url.searchParams.delete('search');
                    }

                    window.location.href = url.toString();
                }
            });
        </script>


        {{-- Tag Filter --}}
        <div class="flex flex-col">
            <label for="tag-select" class="text-sm font-medium text-gray-700">{{ __('Tags') }}:</label>
            <select
                id="tag-select"
                title="{{ __('Filter courses by tag') }}"
                class="block w-full sm:w-auto border rounded-xl px-3 py-2 text-sm font-medium text-gray-700
                       border-gray-300 focus:ring-2 focus:ring-primary-orange focus:border-primary-orange
                       hover:border-gray-400 transition"
            >
                <option value="">{{ __('All') }}</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <script>
            document.getElementById('tag-select').addEventListener('change', function () {
                const url = new window.URL(window.location.href);
                if (this.value) {
                    url.searchParams.set('tag', this.value);
                } else {
                    url.searchParams.delete('tag');
                }
                window.location.href = url.toString();
            });
        </script>

        {{-- Filter Button --}}
        <div class="flex flex-col">
            <label for="clear-filters" class="text-sm font-medium text-gray-700 mb-1">
                {{ __('Filters') }}
            </label>

            <button
                id="clear-filters"
                type="button"
                onclick="
            const url = new window.URL(window.location.href);
            url.searchParams.delete('tag');
            url.searchParams.delete('search');
            // keep tab, remove other filters if needed
            window.location.href = url.toString();
        "
                class="flex-shrink-0 border rounded-xl px-3 py-2 text-sm font-medium flex items-center gap-2
               transition focus:ring-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
                {{ __('Clear Filter') }}
            </button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const url = new URL(window.location.href);
                const hasFilters = url.searchParams.get("tag") || url.searchParams.get("search");

                const btn = document.getElementById("clear-filters");
                if (hasFilters) {
                    btn.classList.add("bg-primary-orange", "text-white", "border-primary-orange", "hover:bg-primary-orange/90");
                } else {
                    btn.classList.add("text-gray-700", "border-gray-300", "hover:bg-gray-100");
                }
            });
        </script>


    </div>
</div>
