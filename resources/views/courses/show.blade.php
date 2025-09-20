@extends('layouts.app')

@section('content')
    <div class="py-8 sm:py-12" x-data="courseData({{ $course->id }})"> {{-- Pass course ID to Alpine --}}
        <div class=" mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md border border-gray-200 rounded-lg overflow-hidden mb-6 sm:mb-8">
                <div class="px-4 py-4 sm:px-6 sm:py-5">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <div
                                class="w-10 h-10 bg-primary-orange rounded-lg flex items-center justify-center flex-shrink-0">
                                <x-tabler-school class="w-6 h-6 text-white absolute"/>
                            </div>
                            <div>
                                <h1 class="text-lg sm:text-xl font-bold text-gray-900 leading-tight">{{$course->title}}</h1>
                                <p class="text-xs text-gray-600">{{$course->description}}</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 sm:space-x-4 rtl:space-x-reverse gap-3">
                            {{-- Star rating display --}}
                            <div
                                class="flex items-center bg-gray-50 rounded-lg px-3 py-2 flex-shrink-0 cursor-pointer"
                                @click="showRatingModal = true"
                            >
                                <div class="flex text-yellow-400 text-sm" x-html="renderStars(courseRating)"></div>
                                <span class="ml-2 rtl:ml-0 rtl:mr-2 text-sm text-gray-700 font-medium"
                                      x-text="`${courseRating.toFixed(1)} (${totalReviews})`"></span>
                            </div>
                            {{-- Progress indicator --}}
                            <div
                                class="bg-primary-orange text-white px-2 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-semibold flex-shrink-0">
                                <span x-text="completedEpisodes"></span>/<span x-text="totalEpisodes"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('message'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    {{ session('error') }}
                </div>
            @endif



            <!-- Main Content Area - Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                {{-- Left Column for Video Player and Resources --}}
                <div class="lg:col-span-2 space-y-6 lg:space-y-8">
                    <!-- Video Player Card -->
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="relative bg-black aspect-video">
                            <video
                                x-ref="videoPlayer"
                                class="w-full h-full object-cover"
                                controls
                                :src="currentEpisode.url"
                                :poster="currentEpisode.thumbnail"
                                @ended="markCurrentEpisodeAsCompleted" {{-- Automatically mark as complete when video ends --}}
                            >
                                Your browser does not support the video tag.
                            </video>
                            {{-- Episode number overlay --}}
                            <div
                                class="absolute top-2 left-2 rtl:left-auto rtl:right-2 bg-black/70 text-white px-2 py-1 rounded text-xs font-semibold">
                                Episode <span x-text="currentEpisode.number"></span>
                            </div>
                        </div>

                        <!-- Video Info Section -->
                        <div class="p-4 sm:p-6">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2 leading-tight"
                                x-text="currentEpisode.title"></h2>
                            <p class="text-gray-600 text-sm sm:text-base mb-4 leading-relaxed"
                               x-text="currentEpisode.description"></p>

                            @if(auth()->check() && auth()->user()->paid($course))
                                <div
                                    class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-gray-50 rounded-lg p-4 gap-4">
                                    {{-- Episode stats using a grid for better mobile alignment --}}
                                    <div class="grid grid-cols-3 gap-4 text-sm w-full sm:w-auto">
                                        <div class="text-center">
                                            <div class="font-bold text-primary-orange"
                                                 x-text="currentEpisode.duration"></div>
                                            <div class="text-xs text-gray-500">Duration</div>
                                        </div>
                                    </div>

                                    {{-- Mark Complete button --}}
                                    <button
                                        @click="toggleCompleted(currentEpisode.id)"
                                        :class="currentEpisode.completed ? 'bg-green-600 hover:bg-green-700' : 'bg-primary-orange hover:bg-orange-700'"
                                        class="w-full sm:w-auto px-4 py-2 text-white rounded-lg transition-colors font-semibold text-sm flex items-center justify-center
                                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-orange"
                                    >
                                        <template x-if="currentEpisode.completed">
                                            <x-tabler-check class="mr-2 rtl:mr-0 rtl:ml-2"/>
                                        </template>
                                        <template x-if="!currentEpisode.completed">
                                            <x-tabler-player-play class="mr-2 rtl:mr-0 rtl:ml-2"/>
                                        </template>
                                        <span
                                            x-text="currentEpisode.completed ? 'Mark as not completed' : 'Mark Complete'"></span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Course Resources Section -->
                    @if(auth()->check() && auth()->user()->paid($course))

                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 sm:p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-accent-blue rounded-lg flex items-center justify-center mr-3 rtl:mr-0 rtl:ml-3 flex-shrink-0">
                                    <x-tabler-file-download class="w-6 h-6 "/>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 leading-tight">{{__('Course Resources')}}</h3>
                                    <p class="text-sm text-gray-600">{{__('Download materials and source code')}}</p>
                                </div>
                            </div>

                            {{-- Use currentEpisodeResources() for iterating --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3"
                                 x-show="currentEpisodeResources().length > 0">
                                <template x-for="file in currentEpisodeResources()"
                                          :key="file.uuid"> {{-- Use file.uuid for unique key --}}
                                    {{-- Using <a> tag for semantic correctness of a download link --}}
                                    <a :href="file.original_url" @click.prevent="downloadFile(file)"
                                       class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors flex items-center justify-between
                                          focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-orange"
                                    >
                                        <div class="flex items-center min-w-0 flex-1">
                                            <div
                                                class="w-8 h-8 rounded flex items-center justify-center mr-3 rtl:mr-0 rtl:ml-3 flex-shrink-0">
                                                {{-- Use dynamic icon based on file type --}}
                                                <div class="w-full h-full rounded flex items-center justify-center">
                                                    <x-tabler-file-type-pdf class="w-6 h-6 "/>
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="font-semibold text-gray-900 text-sm truncate"
                                                   x-text="file.name"></p>
                                                {{-- Display size, convert bytes to KB/MB --}}
                                                <p class="text-xs text-gray-500"
                                                   x-text="`${(file.size / 1024 / 1024).toFixed(2)} MB`"></p>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-primary-orange hover:bg-orange-700 text-white p-2 rounded transition-colors flex-shrink-0 ml-2 rtl:ml-0 rtl:mr-2"
                                            aria-label="Download file"
                                        >
                                            <x-tabler-file-download class="w-4 h-4"/>
                                        </div>
                                    </a>
                                </template>
                            </div>
                            <div x-show="currentEpisodeResources().length === 0" class="text-gray-600 text-center py-4">
                                {{__('No resources available for this episode.')}}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar / Episode List -->
                <div class="lg:col-span-1">
                    {{-- Sticky positioning for the sidebar on larger screens --}}
                    <div
                        class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden lg:sticky lg:top-8">
                        <div class="bg-primary-orange text-white p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-bold text-lg">{{__('Course Episodes')}}</h3>
                                    <p class="text-orange-100 text-sm">
                                        <span x-text="totalEpisodes"></span> {{__('episodes')}} • <span
                                            x-text="totalDuration"></span>
                                    </p>
                                </div>
                                <div class="w-8 h-8 bg-white/20 rounded flex items-center justify-center flex-shrink-0">
                                    <x-tabler-list class="w-6 h-6 text-white "/>
                                </div>
                            </div>
                        </div>

                        <!-- Episodes List -->
                        {{-- Custom scrollbar styling added for better appearance --}}
                        <div class="max-h-96 lg:max-h-[calc(100vh-200px)] overflow-y-auto custom-scrollbar">
                            <template x-for="(episode, index) in episodes" :key="episode.id">
                                <div class="border-b border-gray-100 last:border-b-0">
                                    <button
                                        :disabled="episode.locked" {{-- Disable based on the 'locked' key --}}
                                    @click="playEpisode(episode)"
                                        :class="{
                                            'cursor-not-allowed bg-gray-50 opacity-75': episode.locked,
                                            'hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-orange focus:ring-offset-2': !episode.locked,
                                            'bg-gray-100': currentEpisode.id === episode.id && !episode.locked // Highlight current episode
                                        }"
                                        class="w-full p-4 text-left transition-colors"
                                    >
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 mr-3 rtl:mr-0 rtl:ml-3">
                                                <div
                                                    :class="{
                                                        'bg-green-600': episode.completed, // Green if completed
                                                        'bg-primary-orange': !episode.completed && !episode.locked, // Orange if not completed and not locked
                                                        'bg-gray-300': episode.locked // Gray if locked
                                                    }"
                                                    class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs"
                                                >
                                                    <template x-if="episode.completed">
                                                        <x-tabler-check class="w-4 h-4 text-white"/>
                                                    </template>
                                                    <template x-if="!episode.completed && !episode.locked">
                                                        <span x-text="episode.number"></span>
                                                    </template>
                                                    <template x-if="episode.locked">
                                                        <x-tabler-lock class="w-4 h-4 text-white"/>
                                                    </template>
                                                </div>
                                            </div>

                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-start justify-between mb-1">
                                                    <h4
                                                        :class="episode.locked ? 'text-gray-500' : 'text-gray-900 font-semibold'"
                                                        {{-- Gray out text if locked --}}
                                                        class="text-sm leading-tight pr-2 rtl:pr-0 rtl:pl-2 line-clamp-2"
                                                        x-text="episode.title"
                                                    ></h4>
                                                </div>

                                                <div
                                                    :class="episode.locked ? 'text-gray-400' : 'text-gray-500'"
                                                    {{-- Gray out duration if locked --}}
                                                    class="flex items-center justify-between text-xs"
                                                >
                                                    <span class="font-medium" x-text="episode.duration"></span>
                                                    <template
                                                        x-if="episode.locked"> {{-- Only show "Locked" text and icon if truly locked --}}
                                                        <div class="flex items-center ml-2 text-gray-500">
                                                            <x-tabler-lock class="w-4 h-4 mr-1"/>
                                                            <span>{{__('Locked')}}</span>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <!-- Call to Action for non-enrolled users -->
                        @if(auth()->check() && !auth()->user()->paid($course))
                            <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                                <p class="text-sm text-gray-700 mb-3">{{__('Enroll now to unlock all episodes and track your progress!')}}</p>
                                <form action="{{ route('courses.purchase.course', $course) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-orange hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-orange">
                                        {{__('Purchase this Courses')}}
                                    </button>
                                </form>
                            </div>
                        @elseif(!auth()->check())
                            <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                                <p class="text-sm text-gray-700 mb-3">{{__('Please log in to enroll and access course content.')}}</p>
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-orange hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-orange">
                                    {{__('Login')}}
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- START: Fixed Ratings Section -->
            <div class="mt-8 lg:mt-12">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4 sm:p-6 lg:p-8">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-10 h-10 bg-accent-blue rounded-lg flex items-center justify-center mr-3 rtl:mr-0 rtl:ml-3 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 leading-tight">{{__('Student Feedback')}}</h3>
                            <p class="text-sm text-gray-600">{{__('Ratings and reviews from students')}}</p>
                        </div>
                    </div>

                    @if($totalReviews > 0)
                        @php
                            // Calculate distribution for the rating bars
                            $distribution = collect([5, 4, 3, 2, 1])->mapWithKeys(function ($star) use ($course, $totalReviews) {
                                $count = $course->ratings->where('pivot.rating', $star)->count();
                                return [
                                    $star => [
                                        'count' => $count,
                                        'percentage' => $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0,
                                    ]
                                ];
                            });
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Left Side: Overall Rating Summary -->
                            <div
                                class="md:col-span-1 border-b md:border-b-0 md:border-e border-gray-200 pb-6 md:pb-0 md:pe-8 rtl:md:border-e-0 rtl:md:border-s rtl:md:pe-0 rtl:md:ps-8">
                                <div class="text-center flex flex-col items-center">
                                    <p class="text-sm text-gray-600">{{ __('Overall Rating') }}</p>
                                    <div
                                        class="text-5xl font-bold text-gray-900 my-2">{{ number_format($averageRating, 1) }}</div>
                                    <div class="flex justify-center mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg
                                                class="w-5 h-5 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-500">
                                        {{ trans_choice(__('{1} :count review|[2,*] :count reviews'), $totalReviews, ['count' => $totalReviews]) }}
                                    </p>
                                </div>

                                <!-- Rating Distribution Bars -->
                                <div class="mt-6 space-y-2">
                                    @foreach($distribution as $star => $data)
                                        <div class="flex items-center gap-x-3">
                                            <span class="text-xs font-medium text-gray-600 w-12 text-end">{{ $star }}&nbsp;★</span>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-400 h-2 rounded-full"
                                                     style="width: {{ $data['percentage'] }}%"></div>
                                            </div>
                                            <span class="text-xs font-medium text-gray-500 w-8 text-start">{{ round($data['percentage']) }}%</span>
                                        </div>
                                    @endforeach
                                </div>
                                @if(auth()->check() && auth()->user()->paid($course))
                                    <button @click="showRatingModal = true"
                                            class="mt-6 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-orange hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-orange">
                                        <svg class="w-5 h-5 mr-2 rtl:mr-0 rtl:ml-2 -ml-1" fill="currentColor"
                                             viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/>
                                        </svg>
                                        {{ __('Write a Review') }}
                                    </button>
                                @endif
                            </div>

                            <!-- Right Side: Reviews List -->
                            <div class="md:col-span-2 space-y-6 max-h-96 overflow-y-auto custom-scrollbar pr-2">
                                @foreach($course->ratings as $review)
                                    <div class="flex gap-3 space-x-4 rtl:space-x-reverse">
                                        <img
                                            class="h-10 w-10 rounded-full object-cover flex-shrink-0"
                                            src="{{ $review->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->name) . '&background=random&color=fff' }}"
                                            alt="{{ $review->name }}">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h4 class="text-sm font-semibold text-gray-900">{{ $review->name }}</h4>
                                                    <p class="text-xs text-gray-500">{{ $review->pivot->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="flex items-center flex-shrink-0">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg
                                                            class="w-4 h-4 {{ $i <= $review->pivot->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            @if($review->pivot->comment)
                                                <p class="mt-3 text-sm text-gray-700 leading-relaxed prose prose-sm max-w-none">
                                                    {{ $review->pivot->comment }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <hr class="border-gray-100">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800">{{ __('No Reviews Yet') }}</h4>
                            <p class="text-gray-500 mt-1">{{ __('Be the first to share your thoughts on this course!') }}</p>
                            @if(auth()->check() && auth()->user()->paid($course))
                                <button @click="showRatingModal = true"
                                        class="mt-4 inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-orange hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-orange">
                                    <svg class="w-5 h-5 mr-2 rtl:mr-0 rtl:ml-2 -ml-1" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/>
                                    </svg>
                                    {{ __('Write a Review') }}
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- END: Fixed Ratings Section -->

        </div>

        <!-- Custom Scrollbar Styling (add this to your main CSS file for production) -->
        <style>
            .custom-scrollbar::-webkit-scrollbar {
                width: 8px;
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 10px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            /* For Firefox */
            .custom-scrollbar {
                scrollbar-width: thin;
                scrollbar-color: #888 #f1f1f1;
            }
        </style>

        <!-- Alpine.js Data & Logic -->
        <script>
            function courseData(courseId) {
                return {
                    showRatingModal: false,
                    userRating: 0,
                    userReview: '',


                    courseId: courseId,
                    courseRating: {{ (float) $averageRating }},
                    totalReviews: {{ $totalReviews }},
                    completedEpisodes: 0,
                    totalEpisodes: 0,
                    totalDuration: "0h 0m",
                    currentEpisode: {},
                    episodes: @json($episodes),

                    init() {
                        this.episodes = this.episodes.map(episode => ({
                            ...episode,
                            completed: false // Initialize 'completed' property for each episode
                        }));

                        this.totalEpisodes = this.episodes.length;
                        this.calculateTotalDuration();
                        this.loadProgress(); // Load progress AFTER initializing 'completed' property
                        this.updateProgress();

                        // Set the first episode as current by default, or an empty object if no episodes
                        if (this.episodes.length > 0) {
                            // Find the first uncompleted episode, or default to the first one if all are completed
                            let firstUncompletedEpisode = this.episodes.find(e => !e.completed);
                            this.currentEpisode = {...(firstUncompletedEpisode || this.episodes[0])};
                            // Ensure resources are an array for iteration
                            this.currentEpisode.resources = Object.values(this.currentEpisode.resources || {});
                        } else {
                            this.currentEpisode = {resources: []};
                        }
                    },

                    // Helper to generate the localStorage key
                    getStorageKey() {
                        // Use a key unique per user if authentication status is known and user is logged in
                        // For a public course, a common key or per-course key is fine.
                        // For user-specific progress, consider `course_progress_${this.courseId}_${userId}`
                        return `course_progress_${this.courseId}`;
                    },

                    // Saves the completed status of episodes to localStorage
                    saveProgress() {
                        try {
                            const completedStatuses = this.episodes.map(e => ({
                                id: e.id,
                                completed: e.completed
                            }));
                            localStorage.setItem(this.getStorageKey(), JSON.stringify(completedStatuses));
                        } catch (e) {
                            console.error("Failed to save progress to localStorage:", e);
                        }
                    },

                    // Loads completed status from localStorage and applies it to episodes
                    loadProgress() {
                        try {
                            const storedProgress = localStorage.getItem(this.getStorageKey());
                            if (storedProgress) {
                                const completedStatuses = JSON.parse(storedProgress);
                                completedStatuses.forEach(storedEp => {
                                    const episode = this.episodes.find(e => e.id === storedEp.id);
                                    if (episode) {
                                        // Update the reactive property directly
                                        episode.completed = storedEp.completed || false;
                                    }
                                });
                            }
                        } catch (e) {
                            console.error("Failed to load progress from localStorage:", e);
                            // Clear corrupted data if parsing fails
                            localStorage.removeItem(this.getStorageKey());
                        }
                    },

                    calculateTotalDuration() {
                        let totalSeconds = 0;
                        this.episodes.forEach(episode => {
                            const parts = episode.duration.split(':').map(Number);
                            if (parts.length === 3) { // HH:MM:SS
                                totalSeconds += parts[0] * 3600 + parts[1] * 60 + parts[2];
                            } else if (parts.length === 2) { // MM:SS
                                totalSeconds += parts[0] * 60 + parts[1];
                            }
                        });

                        const hours = Math.floor(totalSeconds / 3600);
                        const minutes = Math.floor((totalSeconds % 3600) / 60);
                        this.totalDuration = `${hours}h ${minutes}m`;
                    },

                    updateProgress() {
                        this.completedEpisodes = this.episodes.filter(e => e.completed).length;
                    },

                    playEpisode(episode) {
                        if (episode.locked) {
                            // Optionally show a message or do nothing if episode is locked
                            return;
                        }
                        this.currentEpisode = {...episode};
                        this.currentEpisode.resources = Object.values(this.currentEpisode.resources || {});

                        this.$nextTick(() => {
                            if (this.$refs.videoPlayer) {
                                this.$refs.videoPlayer.scrollIntoView({behavior: 'smooth', block: 'start'});
                                this.$refs.videoPlayer.load(); // Load the new video source
                                this.$refs.videoPlayer.play();
                            }
                        });
                    },

                    markCurrentEpisodeAsCompleted() {
                        // Find the actual episode object in the 'episodes' array to ensure reactivity
                        const episodeToUpdate = this.episodes.find(e => e.id === this.currentEpisode.id);

                        if (episodeToUpdate && !episodeToUpdate.completed) {
                            episodeToUpdate.completed = true; // Mark as completed in the main array
                            this.currentEpisode.completed = true; // Also update the currentEpisode object
                            this.updateProgress();
                            this.saveProgress();

                            // Optional: Auto-play next episode if not the last one and not locked
                            const currentIndex = this.episodes.findIndex(e => e.id === this.currentEpisode.id);
                            const nextEpisodeIndex = currentIndex + 1;
                            if (nextEpisodeIndex < this.episodes.length) {
                                const nextEpisode = this.episodes[nextEpisodeIndex];
                                if (!nextEpisode.locked) { // Only auto-play if the next episode is not locked
                                    this.playEpisode(nextEpisode);
                                }
                            }
                        }
                    },

                    toggleCompleted(episodeId) {
                        const episode = this.episodes.find(e => e.id === episodeId);
                        if (episode) {
                            episode.completed = !episode.completed; // Toggle the completed status
                            // If the toggled episode is the one currently playing, update its status as well
                            if (this.currentEpisode.id === episodeId) {
                                this.currentEpisode.completed = episode.completed;
                            }
                            this.updateProgress();
                            this.saveProgress();
                        }
                    },

                    renderStars(rating) {
                        let stars = '';
                        const fullStars = Math.floor(rating);
                        const halfStar = rating % 1 >= 0.5;

                        for (let i = 0; i < 5; i++) {
                            if (i < fullStars) {
                                stars += '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/></svg>';
                            } else {
                                stars += '<svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/></svg>';
                            }
                        }
                        return stars;
                    },

                    downloadFile(file) {
                        window.open(file.original_url, '_blank');
                    },

                    currentEpisodeResources() {
                        return this.currentEpisode.resources || [];
                    },

                    submitReview() {
                        console.log('Rating:', this.userRating, 'Review:', this.userReview);
                        this.showRatingModal = false;
                    }
                }
            }
        </script>
        <!-- Rating Modal -->
        <div
            x-show="showRatingModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                @click.away="showRatingModal = false"
                class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative rtl:text-right ltr:text-left"
            >
                <!-- Close button -->
                <button
                    @click="showRatingModal = false"
                    class="absolute top-3 right-3 rtl:left-3 rtl:right-auto text-gray-400 hover:text-gray-600"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Title -->
                <h2 class="text-xl font-bold text-gray-900 mb-5 text-center">
                    {{ __('Rate this Course') }}
                </h2>

                <!-- Form -->
                <form method="POST" action="{{ route('courses.rate', $course) }}">
                    @csrf
                    <input type="hidden" name="rating" x-model.number="userRating">

                    <!-- Star rating -->
                    <div class="flex justify-center space-x-2 rtl:space-x-reverse mb-5" x-data="{ hoverRating: 0 }">
                        <template x-for="i in 5" :key="i">
                            <svg
                                @mouseover="hoverRating = i"
                                @mouseleave="hoverRating = 0"
                                @click="userRating = i"
                                :class="{
                            'text-yellow-400 scale-110': i <= (hoverRating || userRating),
                            'text-gray-300': i > (hoverRating || userRating)
                        }"
                                class="w-10 h-10 cursor-pointer transition-all duration-150"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118l-3.385-2.46c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/>
                            </svg>
                        </template>
                    </div>

                    <!-- Textarea -->
                    <textarea
                        name="comment"
                        x-model="userReview"
                        rows="5"
                        class="w-full border border-gray-300 rounded-xl p-3 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-orange focus:border-primary-orange transition-colors"
                        placeholder="{{ __('Write your feedback...') }}"
                    ></textarea>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 rtl:space-x-reverse mt-6 gap-3">
                        <button
                            type="button"
                            @click="showRatingModal = false"
                            class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"
                        >
                            {{ __('Cancel') }}
                        </button>
                        <button
                            type="submit"
                            :disabled="userRating === 0"
                            class="px-4 py-2 rounded-lg bg-primary-orange text-white hover:bg-orange-700 transition disabled:bg-orange-300 disabled:cursor-not-allowed"
                        >
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
