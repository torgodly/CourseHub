@props([
    'image',
    'tag',
    'title',
    'description',
    'students',
    'weeks',
    'lessons',
    'rating',
    'price',
    'instructor',
    'instructorImage'
])

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 flex flex-col">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">

    <div class="p-4 ">
        <div class="flex items-center justify-between ">


        {{-- Tag --}}
        <span class="text-xs px-2 py-1 bg-purple-100 text-purple-600 rounded mb-2 inline-block">
            {{ $tag }}
        </span>

        {{-- Rating --}}
        <div class="flex items-center text-xl text-yellow-500 mb-3">
            ★ <span class="ml-1 text-black text-sm">{{ $rating }}</span>
        </div>

        </div>
        {{-- Title --}}
        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $title }}</h3>

        {{-- Description --}}
        <p class="text-sm text-gray-500 mb-4 flex-grow">{{ $description }}</p>

        {{-- Stats --}}
        <div class="flex items-center justify-between text-gray-400 text-xs mb-3">
            <span>👥 {{ $students }} طالب</span>
            <span>📅 {{ $weeks }} أسابيع</span>
            <span>📚 {{ $lessons }} درس</span>
        </div>



        {{-- Instructor --}}
        <div class="flex items-center gap-2 mb-4 ">
            <img src="{{ $instructorImage }}" class="w-6 h-6 rounded-full" alt="{{ $instructor }}">
            <span class="text-xs text-gray-600">{{ $instructor }}</span>
        </div>

        {{-- Price & Button --}}
        <div class="flex items-center mt-auto rounded mx-auto justify-center w-[85%] bg-orange-500 hover:bg-orange-600 font-bold text-white">
            <button class=" text-white text-sm px-4 py-2 rounded">
                <div>أضف إلى السلة</div>
            </button>
            <div class="text-white">|</div>
            <span class="text-lg  mr-3">{{ $price }} ﷼</span>

        </div>
    </div>
</div>
