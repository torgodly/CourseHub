<div class="flex items-start bg-gray-900 text-white p-8 rounded-lg">
    <div class="w-2/3 pr-8">
        <h1 class="text-3xl font-bold mb-2">{{ $course->title }}</h1>
        <div class="flex items-center text-sm text-gray-400 mb-4">
            <span>{{ $course->attendees }} Attended this course</span>
            <span class="ml-4">
                <i class="fas fa-user-check text-green-400"></i>
                <span class="ml-1">{{ $course->registered_count }} Registered on upcoming course</span>
            </span>
        </div>
        <p class="italic text-gray-300 mb-4">"{{ $course->quote }}"</p>
        <p class="text-sm">Upcoming course date: <span class="font-bold">{{ $course->upcoming_date }}</span></p>
    </div>
    <div class="w-1/3 relative">
        <img src="{{ $course->thumbnail }}" alt="Course Preview" class="rounded-lg shadow-lg">
        <div class="absolute inset-0 flex items-center justify-center">
            <button class="bg-white text-gray-800 rounded-full p-4 hover:bg-gray-200 transition">
                <i class="fas fa-play text-xl"></i>
            </button>
        </div>
        <p class="text-center mt-2 text-xs text-gray-400">Preview this course</p>
    </div>
</div>
