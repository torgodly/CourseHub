@extends('layouts.app')

@section('content')
    <div class="pt-[120px] pb-[40px] flex items-center justify-center container mx-auto ">
        <div class="w-[550px] mt-12">
            <h2 class="text-3xl font-bold text-color-primary-orange">تعلم، تطوّر، انطلق!</h2>
            <h3 class="text-2xl text-color-neutral-gray mt-2 mb-4">انضم إلى منصتنا التعليمية واكتسب المعرفة من خلال دورات
                أونلاين تفاعلية تمنحك تجربة تعلم ممتعة ومرنة. ابدأ رحلتك اليوم واكتشف آفاقًا جديدة من التطور
                والإبداع.</h3>
            <a href="#courses"
                class="inline-block px-6 py-2 bg-color-primary-orange hover:bg-color-accent-purple active:bg-color-yellow text-white text-2xl rounded-full ">تصفح</a>
        </div>
        <img src="images/background1.png" alt="bg" class="w-[620px] h-auto">
    </div>
    <div class="bg-color-background-light py-[40px]" id="courses">
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($courses->slice(0, 4) as $course)
                    <x-course-card :$course />
                @endforeach
            </div>

            <div class="pt-8">
                <a href="" />
            </div>

        </div>
    </div>
@endsection
