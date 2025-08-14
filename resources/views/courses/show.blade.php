@extends('layouts.app')

@section('content')
    <div class="p-6 flex gap-6 ">
        {{-- Left: Course Content --}}
        <div class="flex-1 mt-4">

            {{-- Breadcrumbs --}}
            <div class="text-gray-500 text-sm mb-4">
                {{ $course->title }} < <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
                    < <a href="{{ route('welcome') }}">{{ __('Home') }}</a>
            </div>

            {{-- Title --}}
            <h1 class="text-4xl font-bold mb-4"> {{ $course->title }} </h1>

            {{-- Video --}}
            <div class="rounded-xl overflow-hidden shadow mb-6">
                <img src="https://placehold.co/800x450" alt="Course Thumbnail" class="w-full">
                <div class="bg-gray-900 text-white px-4 py-2 flex justify-between items-center">
                    <span>⏯ 12:30 / 1:20:00</span>
                </div>
            </div>


            <div class="flex items-center justify-between ">
                {{-- Author --}}
                <div class="flex items-center gap-3 mb-6">
                    {{-- <img src="{{ asset($course->trainer->avatar) ?? 'https://placehold.co/50x50' }}" class="rounded-full" --}}
                    <img src="{{ 'https://placehold.co/50x50' }}" class="rounded-full" alt="Mentor">
                    <div>
                        <p class="font-semibold"> {{ $course->trainer->name }} </p>
                        <p class="text-sm text-gray-500">Mentor • {{ $course->trainer->profession }} Works at Google </p>
                    </div>
                </div>

                {{-- Favorite Button --}}
                <div class="save">
                    @auth
                        {{-- Favorite Icon --}}
                        <form method="POST" action="{{ route('courses.favorite.toggle', $course) }}">
                            @csrf
                            <button type="submit">
                                @if ($course->isFavoritedBy(auth()->user()))
                                    <x-heroicon-s-heart class="w-10 h-10 text-red-500" />
                                @else
                                    <x-heroicon-s-heart class="w-10 h-10 text-gray-500" />
                                @endif

                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            {{-- About --}}
            <div class="mb-6">
                <h2 class="font-bold text-lg mb-2">About This Course</h2>
                <p class="text-gray-700">
                    Unlock your creative potential with our Beginner-Level Illustrator Course! ...
                    {{ $course->description }}
                </p>
            </div>

            {{-- Suit For --}}
            <div>
                <h2 class="font-bold text-lg mb-2">This Course Suit For:</h2>
                <ul class="list-disc pl-6 mr-3 text-gray-700 space-y-1">
                    <li>Anyone who wants to start their career ...</li>
                    <li>This course is for beginners ...</li>
                    <li>For anyone who needs to add Illustration ...</li>
                    <li>Aimed at people new to the world ...</li>
                </ul>
            </div>

            <div class="mx-auto px-4 py-8 sm:px-6 sm:py-12 lg:px-8 block md:hidden">

                <div
                    class="rounded-2xl border border-indigo-600 p-6 shadow-xs ring-1 ring-indigo-600 sm:order-last sm:px-8 lg:p-12">
                    <div class="text-center">
                        <h2 class="text-lg font-medium text-gray-900">
                            Pro
                            <span class="sr-only">Plan</span>
                        </h2>

                        <p class="mt-2 sm:mt-4">
                            <strong class="text-3xl font-bold text-gray-900 sm:text-4xl"> 30$ </strong>

                            <span class="text-sm font-medium text-gray-700">/month</span>
                        </p>
                    </div>

                    <ul class="mt-6 space-y-2">
                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> 20 users included </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> 5GB of storage </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Email support </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Help center access </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Phone support </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Community access </span>
                        </li>
                    </ul>

                    <a href="#"
                        class="mt-8 block rounded-full border border-indigo-600 bg-indigo-600 px-12 py-3 text-center text-sm font-medium text-white hover:bg-indigo-700 hover:ring-1 hover:ring-indigo-700 focus:ring-3 focus:outline-hidden">
                        Get Started
                    </a>
                </div>


            </div>
            <x-accordion :course="$course" />
        </div>

        {{-- Right: Progress + Lessons --}}
        <div class="w-80 space-y-6 mt-19 hidden md:block">
            {{-- Progress --}}

            <div class="mx-auto px-4 py-8 sm:hidden md:block">

                <div
                    class="rounded-2xl border border-indigo-600 p-6 shadow-xs ring-1 ring-indigo-600 sm:order-last sm:px-8 lg:p-12">
                    <div class="text-center">
                        <h2 class="text-lg font-medium text-gray-900">
                            Pro
                            <span class="sr-only">Plan</span>
                        </h2>

                        <p class="mt-2 sm:mt-4">
                            <strong class="text-3xl font-bold text-gray-900 sm:text-4xl"> 30$ </strong>

                            <span class="text-sm font-medium text-gray-700">/month</span>
                        </p>
                    </div>

                    <ul class="mt-6 space-y-2">
                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> 20 users included </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> 5GB of storage </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Email support </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Help center access </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Phone support </span>
                        </li>

                        <li class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>

                            <span class="text-gray-700"> Community access </span>
                        </li>
                    </ul>

                    <a href="#"
                        class="mt-8 block rounded-full border border-indigo-600 bg-indigo-600 px-12 py-3 text-center text-sm font-medium text-white hover:bg-indigo-700 hover:ring-1 hover:ring-indigo-700 focus:ring-3 focus:outline-hidden">
                        Get Started
                    </a>
                </div>


            </div>


        </div>


    </div>
@endsection
