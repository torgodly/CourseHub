@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">الدورات المسجلة</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                نرافقك خطوة بخطوة بدورات تدريبية شاملة تعتمد على التطبيق العملي لاكتساب المهارات الحقيقية
                التي تؤهلك لسوق العمل بثقة وجاهزية كاملة.
            </p>
        </div>

        <div>
            <div class="grid gap-4">
                @forelse ($purchasedCourses as $course)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden border border-color-neutral-gray flex flex-col sm:flex-row">

                        {{-- Course Image --}}
                        <img src="https://placehold.co/600x400/000000/FFF" alt="{{ $course->title }}"
                            class="w-full sm:w-48 h-40 sm:h-auto object-cover bg-amber-50">

                        {{-- Content --}}
                        <div class="p-4 flex flex-col flex-grow">
                            {{-- Title --}}
                            <h3 class="text-lg font-semibold text-primary-orange mb-1">
                                <a href="{{ route('courses.show', $course->slug) }}"
                                    class="hover:text-primaryOrange transition-colors">
                                    {{ $course->title }}
                                </a>
                            </h3>

                            {{-- Description --}}
                            <p class="text-sm text-gray-500 mb-4">
                                {{ Str::words($course->description ?? '', 15, '...') }}
                            </p>

                            {{-- Instructor --}}
                            <div class="flex items-center gap-2 mt-auto">
                                <img src="{{ $course->trainer->image ?? 'https://placehold.co/40x40' }}"
                                    class="w-6 h-6 bg-primary-orange rounded-full object-cover"
                                    alt="{{ $course->trainer->name ?? 'المدرب' }}">
                                <span class="text-xs text-gray-600">
                                    {{ $course->trainer->name ?? 'غير معروف' }}
                                </span>
                            </div>
                        </div>

                        {{-- Favorite Icon --}}
                        @auth
                            <form class="self-center sm:ml-10 sm:mb-0 mb-4" method="POST"
                                action="{{ route('courses.favorite.toggle', $course) }}">
                                @csrf
                                <button type="submit" x-data="{ isFavorite: {{ $course->isFavoritedBy(auth()->user()) ? 'true' : 'false' }} }"
                                    :class="isFavorite ? 'text-red-500' : 'text-gray-400'"
                                    class="p-2 rounded-full bg-black text-white transition-colors duration-300 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                        class="w-6 h-6">
                                        <path
                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2
                                                                                                                                                                                                                                                                                                                            12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74
                                                                                                                                                                                                                                                                                                                            0 3.41.81 4.5 2.09C13.09 3.81 14.76
                                                                                                                                                                                                                                                                                                                            3 16.5 3 19.58 3 22 5.42 22 8.5c0
                                                                                                                                                                                                                                                                                                                            3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                    </svg>
                                </button>
                            </form>
                        @endauth
                    </div>
                @empty
                    {{-- No Favorites Message --}}
                    <div class="text-center  mt-4 flex gap-2 items-center justify-center">
                        <p class="text-gray-500"> لا توجد دورات مسجلة بعد.</p><a
                            class="text-primary-color underline cursor-pointer" href="{{ route('courses.index') }}">الانتقال
                            إلى صفحة الدورات</a>
                    </div>
                @endforelse

            </div>
        </div>



        {{-- <div class="mt-6">{{ $purchasedCourses->links() }}</div> --}}

    </div>
@endsection
