@props(['active' => 'all'])

<div class="flex items-center justify-between">


    <div class="flex gap-4 border-gray-200 mb-6">
        @php
            $tabs = [
                'all' => 'الكل',
                'new' => 'أحدث الدورات',
                'popular' => 'الأكثر شيوعاً',
                'specialties' => 'التخصصات',
            ];
        @endphp

        @foreach ($tabs as $key => $label)
            <a href="{{ route('courses.index', ['tab' => $key]) }}"
               class="pb-2 border-b-2 transition-colors duration-200
   {{ $active === $key ? 'border-orange-500 text-orange-500 font-bold' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="flex gap-2 mb-6">
        {{-- Left: Filters --}}
        <div class="flex gap-4">
            <select class="border rounded-xl px-3 py-2 text-sm font-bold text-gray-800 border-gray-400">
                <option>فرز حسب</option>
            </select>
        </div>

        {{-- Right: Filter Icon --}}
        <button
            class="border rounded-xl px-3 py-1 text-sm font-bold text-gray-800 border-gray-400 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V20a1 1 0 01-1.447.894l-4-2A1 1 0 018 18v-4.586L3.293 6.707A1 1 0 013 6V4z"/>
            </svg>
            الفلترة
        </button>

    </div>

</div>
