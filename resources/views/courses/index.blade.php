@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 mt-20">

        {{-- Title & Description --}}
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">الدورات</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                نرافقك خطوة بخطوة بدورات تدريبية شاملة تعتمد على التطبيق العملي لاكتساب المهارات الحقيقية
                التي تؤهلك لسوق العمل بثقة وجاهزية كاملة.
            </p>
        </div>

        {{-- Tabs --}}
        <x-course-tabs active="all" />

        {{-- Filters --}}
        <x-course-filters />

        {{-- Courses Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <x-course-card
                image="/images/course1.jpg"
                tag="UX Writing Basics"
                title="كتابة تجربة المستخدم"
                description="اكسب مهارات كتابة النصوص التي توجه المستخدم داخل التطبيق أو الموقع."
                students="+500"
                weeks="4"
                lessons="14"
                rating="4.5"
                price="150"
                instructor="محمود عبده"
                instructorImage="/images/instructor1.jpg"
            />

            <x-course-card
                image="/images/course2.jpg"
                tag="Prototyping"
                title="تصميم النماذج التفاعلية باستخدام Figma"
                description="بناء نماذج تفاعلية عالية الجودة باستخدام أداة Figma."
                students="+1.5K"
                weeks="8"
                lessons="25"
                rating="4.5"
                price="310"
                instructor="إيهاب فايز"
                instructorImage="/images/instructor2.jpg"
            />

            <x-course-card
                image="/images/course3.jpg"
                tag="UX Fundamentals"
                title="أساسيات تصميم تجربة المستخدم"
                description="مقدمة شاملة لتصميم تجربة المستخدم."
                students="+1.1K"
                weeks="7"
                lessons="15"
                rating="4.1"
                price="400"
                instructor="م. أحمد الصواري"
                instructorImage="/images/instructor3.jpg"
            />

            <x-course-card
                image="/images/course3.jpg"
                tag="UX Fundamentals"
                title="أساسيات تصميم تجربة المستخدم"
                description="مقدمة شاملة لتصميم تجربة المستخدم."
                students="+1.1K"
                weeks="7"
                lessons="15"
                rating="4.1"
                price="400"
                instructor="م. أحمد الصواري"
                instructorImage="/images/instructor3.jpg"
            />
        </div>

    </div>

@endsection
