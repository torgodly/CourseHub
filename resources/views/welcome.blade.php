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
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($courses->slice(0,4) as $course)
                    <x-course-card :$course/>
                @endforeach

            </div>
            <div
                class="w-full flex items-center justify-center ">
                <a class="px-4 py-3 font-bold mt-6 bg-orange-500 rounded-md text-white"
                   href="{{route('courses.index')}}">عرض جميع الدورات</a>
            </div>

        </div>
    </div>

@endsection
