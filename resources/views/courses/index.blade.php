@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl text-primary-orange font-bold mb-2">{{ __('courses.title') }}</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ __('courses.description') }}
            </p>
        </div>

        {{-- Tabs --}}
        <x-course-tabs :active="$active" />

        {{-- Filters --}}
        {{-- <x-course-filters /> --}}

        {{-- Courses Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($courses as $course)
                <x-course-card :$course />
            @endforeach

        </div>

        <div class="mt-6">{{ $courses->links() }}</div>

    </div>
@endsection
