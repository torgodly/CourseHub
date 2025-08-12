@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-center bg-white rounded-full shadow w-fit mx-auto p-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="text-black cursor-not-allowed px-4 py-2 rounded-full">&lt;</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="text-black hover:text-primary-orange px-4 py-2 rounded-full">&lt;</a>
        @endif

        {{-- Pagination Elements --}}
        <ul class="flex list-none p-0 m-0">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="text-gray-500 px-4 py-2">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li
                                class="bg-primary-orange font-bold shadow-md shadow-orange-500 text-white px-4 py-2 rounded-full">
                                {{ $page }}
                            </li>
                        @else
                            <a href="{{ $url }}"
                                class="text-gray-500 hover:bg-gray-200 px-4 py-2 rounded-full">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="text-black hover:text-primary-orange px-4 py-2 rounded-full">&gt;</a>
        @else
            <button class="text-black cursor-not-allowed px-4 py-2 rounded-full">&gt;</button>
        @endif
    </nav>
@endif
