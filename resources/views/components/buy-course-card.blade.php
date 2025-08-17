@props(['course'])

<div>


    <div class="w-80 space-y-6 mt-19 hidden md:block">
        {{-- Progress --}}

        <div class="mx-auto px-4 py-8 sm:hidden md:block">

            <div
                class="rounded-2xl border border-primary-orange p-6 shadow-xs ring-1 ring-primary-orange sm:order-last sm:px-6 lg:p-8">
                <div class="text-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        Pricing
                        <span class="sr-only">Plan</span>
                    </h2>

                    <p class="mt-2 sm:mt-4">

                        <strong class="text-3xl font-bold text-primary-orange sm:text-4xl">
                            {{ round($course->price) }}$
                        </strong>

                        <span
                            class="text-sm font-medium text-gray-600 line-through">{{ round($course->price) + 250 }}$</span>
                    </p>
                </div>

                <ul class="mt-6 space-y-4">

                    <li class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span class="text-gray-700">{{ __('Lifetime access to purchased courses') }}</span>
                    </li>

                    <li class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span class="text-gray-700">{{ __('Certificates upon completion') }}</span>
                    </li>

                    <li class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span class="text-gray-700">{{ __('Access to downloadable resources') }}</span>
                    </li>

                    <li class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span class="text-gray-700">{{ __('Direct Q&A with instructors') }}</span>
                    </li>

                    <li class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5 text-indigo-700 shadow-sm">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span class="text-gray-700">{{ __('Join an active learning community') }}</span>
                    </li>
                </ul>

                <div class="" x-data="{ modalIsOpen: false }">
                    <button x-on:click="modalIsOpen = true" type="button"
                        class="mt-8 mx-auto block rounded-full border border-primary-orange bg-primary-orange px-12 py-3 text-center text-sm font-medium text-white hover:bg-orange-700 hover:ring-orange-700 focus:ring-3 focus:outline-hidden">
                        Buy Now</button>
                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                        x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false"
                        x-on:click.self="modalIsOpen = false"
                        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                        <!-- Modal Dialog -->
                        <div x-show="modalIsOpen"
                            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                            class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                            <!-- Dialog Header -->
                            <div
                                class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                                <h3 id="defaultModalTitle"
                                    class="font-semibold tracking-wide text-neutral-900 dark:text-white">Buying
                                    {{ $course->title }}</h3>
                                </h3>
                                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                        stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Dialog Body -->
                            <div class="px-4 py-8">
                                <p>You are about to pay <span class="font-bold">${{ $course->price }}</span> for this
                                    course, are you sure you want to continue?</p>
                            </div>
                            <!-- Dialog Footer -->
                            <div
                                class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
                                <button x-on:click="modalIsOpen = false" type="button"
                                    class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">Cancel</button>
                                <form action="{{ route('courses.purchase', $course->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button x-on:click="modalIsOpen = false" type="submit"
                                        class="whitespace-nowrap rounded-sm bg-black border border-black dark:border-white px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">
                                        Purchase now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>



    </div>

</div>
