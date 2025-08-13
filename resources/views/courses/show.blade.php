@extends('layouts.app')

@section('content')
    {{-- Breadcrumbs --}}
    <div class="text-gray-500 text-sm mb-4 mt-20">
        {{ $course->title }} < <a href="{{ route('courses.index') }}">{{ __('Courses') }}</a>
            < <a href="{{ route('welcome') }}">{{ __('Home') }}</a>
    </div>

    {{-- Course Hero Section --}}
    <div class="lg:flex justify-between items-start mx-auto p-6 bg-white shadow-lg rounded-lg mb-8">

        {{-- Course Details --}}
        <div class="lg:w-3/4">
            <div>
                <h1 class="text-4xl font-bold text-primary-orange">The complete advanced 6-week UI/UX design bootcamp</h1>
                <div class="flex items-center text-gray-500 mt-2 gap-4 ">
                    <span class="mr-4">⭐ {{ $course->average_rating }} ({{ $course->ratings->count() }})</span>
                    <span class="mr-4">👥 {{ $course->enrollments->count() }} students</span>
                    <span>👨‍🏫 {{ $course->trainer->name }}</span>
                </div>
                <p class="text-gray-700 mt-4">{{ $course->description }}</p>
            </div>

            <div>
                {{-- Course Curriculum Section --}}
                <div class="mt-8 pl-10 ">
                    <h2 class="text-2xl font-bold text-primary-orange">Course content</h2>
                    <p class="text-gray-500 text-right">{{ $course->sections->count() }} sections</p>
                    {{-- 490 lectures • 65h 33m total
                        length --}}
                    <button class="text-primary-orange">Expand all sections</button>
                    <div x-data="{ openSection: null }">
                        @foreach ($course->sections as $index => $section)
                            <div class="border-b border-gray-300 py-4">
                                <button
                                    @click="openSection = openSection === {{ $index }} ? null : {{ $index }}"
                                    class="w-full text-right text-lg font-bold text-primary-orange">
                                    {{ $section->title }}
                                </button>
                                <div x-show="openSection === {{ $index }}" class="mt-2 text-gray-700">
                                    {{ $section->description }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
        <div class="lg:w-1/4 bg-background-light p-4 rounded-lg">
            <img src="https://placehold.co/600x400/000000/FFF" alt="Course Thumbnail" class="rounded-lg mb-4">
            <div class="text-2xl font-bold text-primary-orange">$549.00 <span
                    class="text-gray-500 line-through text-lg">$600.00</span>
            </div>
            <!-- Modal -->
            <!-- An Alpine.js and Tailwind CSS component by https://pinemix.com -->
            <div x-data="{ open: false }" x-on:keydown.esc.prevent="open = false">
                <!-- Modal Toggle Button -->
                <div class="w-full flex justify-center mt-4">

                    <button x-on:click="open = true" type="button"
                        class="inline-flex items-center justify-center gap-2 rounded-lg cursor-pointer bg-primary-orange text-white px-4 py-2 text-sm font-semibold ">
                        اشترك الآن
                    </button>
                </div>
                <!-- END Modal Toggle Button -->

                <!-- Modal Backdrop -->
                <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" x-bind:aria-hidden="!open" tabindex="-1" role="dialog"
                    class="z-90 fixed inset-0 overflow-y-auto overflow-x-hidden bg-zinc-900/75 p-4 backdrop-blur-xs will-change-auto lg:p-8">
                    <!-- Modal Dialog -->
                    <div x-cloak x-show="open" x-on:click.away="open = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90 -translate-y-full"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-125 translate-y-full" role="document"
                        class="mx-auto flex w-full max-w-md flex-col overflow-hidden rounded-lg bg-white shadow-xs will-change-auto dark:bg-zinc-800 dark:text-zinc-100">
                        <div class="flex items-center justify-between bg-zinc-50 px-5 py-4 dark:bg-zinc-700/20">
                            <h3 class="text-lg font-bold">Modal Title</h3>
                            <div class="-my-4">
                                <button x-on:click="open = false" type="button"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-200 bg-white px-3 py-2 text-xs font-semibold leading-5 text-zinc-800 hover:border-zinc-300 hover:text-zinc-900 hover:shadow-xs focus:ring-zinc-300/25 active:border-zinc-200 active:shadow-none dark:border-zinc-700 dark:bg-transparent dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-zinc-200 dark:focus:ring-zinc-600/50 dark:active:border-zinc-700">
                                    <svg class="hi-solid hi-x -mx-1 inline-block size-4" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="grow p-5">
                            <p class="text-sm/relaxed">Are you sure you want to purchase this Course?</p>
                        </div>
                        <div
                            class="flex items-center justify-end gap-1.5 border-t border-zinc-100 px-5 py-4 dark:border-zinc-700/50">
                            <button x-on:click="open = false" type="button"
                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm font-semibold leading-5 text-zinc-800 hover:border-zinc-300 hover:text-zinc-900 hover:shadow-xs focus:ring-zinc-300/25 active:border-zinc-200 active:shadow-none dark:border-zinc-700 dark:bg-transparent dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-zinc-200 dark:focus:ring-zinc-600/50 dark:active:border-zinc-700">
                                Close
                            </button>
                            <form method="POST" action="{{ route('courses.purchase', $course) }}">
                                @csrf
                                @method('POST')

                                <button x-on:click="open = false" type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-800 bg-zinc-800 px-3 py-2 text-sm font-medium leading-5 text-white hover:border-zinc-900 hover:bg-zinc-900 hover:text-white focus:outline-hidden focus:ring-2 focus:ring-zinc-500/50 active:border-zinc-700 active:bg-zinc-700 dark:border-zinc-700/50 dark:bg-zinc-700/50 dark:ring-zinc-700/50 dark:hover:border-zinc-700 dark:hover:bg-zinc-700/75 dark:active:border-zinc-700/50 dark:active:bg-zinc-700/50">
                                    Purchase
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- END Modal Dialog -->
                </div>
                <!-- END Modal Backdrop -->
            </div>
            <!-- END Modal -->

            <div class="mt-4">
                <h3 class="text-lg font-bold text-primary-orange">This course includes</h3>
                <ul class="list-disc text-gray-700 px-8 py-3">
                    <li>65 hours on-demand video</li>
                    <li>49 downloadable resources</li>
                    <li>Access on mobile and TV</li>
                    <li>86 articles</li>
                    <li>8 coding exercises</li>
                    <li>Certificate of completion</li>
                </ul>
            </div>
        </div>

    </div>
@endsection
