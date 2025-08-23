@extends('layouts.app')

@section('content')
    <div class="container min-h-[52vh] mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">{{ __('Your Purchased Courses') }}</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ __('Browse the courses you have successfully purchased and start learning.') }}
            </p>
        </div>

        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($purchasedCourses as $course)
                    <x-course-card :$course />
                @empty
                    <div class="col-span-full text-center">
                        <p class="text-gray-500">{{ __('You have not purchased any courses yet.') }}</p>
                        <a href="{{ route('courses.index') }}"
                           class="text-primary-color underline cursor-pointer">{{ __('Browse Courses') }}</a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- <div class="mt-6">{{ $purchasedCourses->links() }}</div> --}}

    </div>
@endsection
