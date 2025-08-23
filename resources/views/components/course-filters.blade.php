@props(['filters'])

<div class="flex items-center gap-4">
    @foreach ($filters as $filter)
        <button class="px-4 py-2 rounded-md bg-primary-orange text-white">
            {{ __('course_filters.' . $filter) }}
        </button>
    @endforeach
</div>

