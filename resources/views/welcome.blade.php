
@extends('layouts.app')

@section('content')


        <div class="pt-[120px] pb-[40px] flex items-center justify-center container mx-auto ">
            <div class="w-[550px] mt-12">
                <h2 class="text-3xl font-bold text-[#333]">تعلم، تطوّر، انطلق!</h2>
                <h3 class="text-2xl text-[#333] mt-2 mb-4">انضم إلى منصتنا التعليمية واكتسب المعرفة من خلال دورات
                    أونلاين تفاعلية تمنحك تجربة تعلم ممتعة ومرنة. ابدأ رحلتك اليوم واكتشف آفاقًا جديدة من التطور
                    والإبداع.</h3>
                <a href="#courses"
                    class="inline-block px-6 py-2 bg-myRed hover:bg-myRedd active:bg-myRed text-white text-2xl rounded-full ">تصفح</a>
            </div>
            <img src="images/background1.png" alt="bg" class="w-[620px] h-auto">
        </div>
        <div class="bg-[#f6f6f6] py-[40px]" id="courses">
            <div class="container mx-auto">
                <h2 class="text-3xl text-[#333] font-bold">
                    <span>الدورات </span>
                    <span class="text-myRed">التدربية</span>
                </h2>
                <ul class="flex gap-x-2 py-5 text-xl text-[#333]">
                    <li><a href="#">أحدث الدورات -</a></li>
                    <li><a href="#">الأكثر مبيعاً -</a></li>
                    <li><a href="#">الدورات المجانية</a></li>
                </ul>
                <div class="flex flex-wrap gap-4">
                    @foreach ($courses as $course)
                        <div class="w-[260px] h-[300px] shadow-lg rounded-xl bg-white relative overflow-hidden">
                            <img src="{{ asset('storage/' . $course->cover_image) }}" alt="course image"
                                class=" w-full h-1/2 object-cover ">
                            <div class="absolute top-3 right-2 left-2 flex items-center justify-between px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.6" stroke="currentColor" class="size-7 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                                <span
                                    class="bg-[#f7e4d6] text-myRed text-xs font-semibold px-4 py-1 rounded-full shadow">
                                    HTML
                                </span>
                            </div>
                            <div class="py-3 px-4 flex flex-col gap-3">
                                <div
                                    class="flex items-center gap-2 pb-3 border border-x-transparent border-t-transparent">
                                    <img src="{{ asset('storage/' . $course->trainer->avatar) }}" alt="profile photo"
                                        class="rounded-full w-[45px] h-[45px] object-cover aspect-square flex-shrink-0">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 line-clamp-1">{{ $course->title }}</h3>
                                        <p class="text-gray-500 text-xs">{{ $course->trainer->name }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="font-bold">{{ $course->price }}</span>
                                        <span class="text-xs font-semibold">د.ل</span>
                                    </div>
                                    <a href="#"
                                        class="py-2 px-3 bg-[#ededed] rounded-lg text-xs font-semibold">أضف للسلة</a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="pt-8">
                    {{-- {{ $courses->links() }} --}}
                </div>

            </div>
        </div>

@endsection
