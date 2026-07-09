<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@extends('layouts.app')

@section('content')

<!-- الهيدر الرئيسي مع الحركة -->
<div class="relative text-white py-24 px-6 text-center shadow-sm bg-cover bg-center animate__animated animate__fadeInDown"
     style="background-image: linear-gradient(to bottom, rgba(36, 77, 179, 0.3), rgba(36, 77, 179, 0.01), transparent), url('{{ asset('main-bg3.webp') }}');">
    
<!-- الشعار برابط مباشر ومعدل -->
<img src="https://lh3.googleusercontent.com/d/1dj3CPWWFiPQ4UGskuobTIgDE4YnzFbCj" 
     alt="شعار كفاءات" 
     style="width: 150px; height: auto;"
     class="mx-auto mb-6 drop-shadow-2xl relative z-10 animate__animated animate__zoomIn animate__delay-0.5s">
    
    <!-- العنوان يتحرك بنعومة -->
    <h1 class="text-4xl font-extrabold mb-3 relative z-10 animate__animated animate__fadeInUp animate__delay-0.8s">
        قياس رضا المستفيد
    </h1>
    
    <!-- الفقرة تتحرك مع تأخير بسيط لإعطاء فخامة -->
    <p class="text-lg font-medium relative z-10 animate__animated animate__fadeInUp animate__delay-1s">
        نسعى دائماً إلى تطوير برامجنا التدريبية.
    </p>
</div>
<!-- الاستبيان الكامل مع كل الحقول والحركة -->
<div class="max-w-2xl mx-auto px-4 -mt-10 relative z-20 animate__animated animate__fadeInUp animate__delay-0.5s">
    @if(session('success'))
        <div class="bg-green-50 text-green-800 p-4 rounded-xl mb-6 text-center font-medium shadow-sm animate__animated animate__bounceIn">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('survey.submit') }}" method="POST" class="space-y-6">
        @csrf

        <!-- 1. البيانات الأساسية -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 animate__animated animate__fadeInUp animate__delay-0.6s">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center"><span class="bg-yellow-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center ml-2">1</span> البيانات الأساسية</h3>
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="الاسم" class="border p-2 rounded-xl bg-gray-50 text-sm" required>
                <div class="flex gap-2">
                    <label class="flex-1 py-2 text-center border rounded-xl cursor-pointer hover:bg-gray-50 transition-all"><input type="radio" name="gender" value="ذكر" class="hidden"> ذكر</label>
                    <label class="flex-1 py-2 text-center border rounded-xl cursor-pointer hover:bg-gray-50 transition-all"><input type="radio" name="gender" value="أنثى" class="hidden"> أنثى</label>
                </div>
            </div>
        </div>

<!-- 2. مقياس الرضا (أضفنا كلاس scroll-animate) -->
<div class="scroll-animate bg-white p-6 rounded-2xl shadow-sm border border-gray-100 animate__animated">
    <h3 class="font-bold text-gray-800 mb-6 flex items-center">
        <span class="bg-yellow-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center ml-2">2</span> 
        مقياس الرضا
    </h3>
    
    @foreach(['وضوح الأهداف','ملاءمة التدريب لاحتياجك', 'جودة التدريب', 'كفاءة المدرب', 'التنظيم', 'التجربة العامة'] as $item)
    <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-2">
        <span class="text-sm text-gray-700">{{ $item }}</span>
        <div class="rating-stars flex flex-row-reverse text-gray-200 text-lg">
            @for($i=5; $i>=1; $i--)
            <input type="radio" id="star-{{md5($item)}}-{{$i}}" name="ratings[{{$item}}]" value="{{$i}}" class="hidden" required>
            <label for="star-{{md5($item)}}-{{$i}}" class="cursor-pointer px-1 hover:text-yellow-500 transition-colors"><i class="fa-solid fa-star"></i></label>
            @endfor
        </div>
    </div>
    @endforeach
</div>

<!-- 3. التوصية (أضفنا كلاس scroll-animate وأزلنا الحركة الثابتة) -->
<div class="scroll-animate bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center animate__animated">
    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
        <span class="bg-yellow-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center ml-2">3</span> 
        هل توصي بالتدريب؟
    </h3>
    <div class="flex justify-center gap-3 recommendation-group">
        @foreach(['نعم بشدة', 'ربما', 'لا'] as $opt)
        <label class="cursor-pointer px-5 py-1.5 border rounded-full text-xs transition-all duration-200 rec-option hover:bg-blue-50">
            <input type="radio" name="recommendation" value="{{$opt}}" class="hidden" required> {{$opt}}
        </label>
        @endforeach
    </div>
</div>

        <!-- 4. التقييم العام -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 animate__animated animate__fadeInUp animate__delay-0.9s">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center"><span class="bg-yellow-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center ml-2">4</span> التقييم العام</h3>
            <div class="rating-stars flex flex-row-reverse justify-center text-gray-200 text-2xl">
                @for($i=5; $i>=1; $i--)
                <input type="radio" id="ov-{{$i}}" name="overall_rating" value="{{$i}}" class="hidden" required>
                <label for="ov-{{$i}}" class="cursor-pointer px-2 hover:text-yellow-500 transition-colors"><i class="fa-solid fa-star"></i></label>
                @endfor
            </div>
        </div>

        <!-- 5. ملاحظات -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 animate__animated animate__fadeInUp animate__delay-1s">
            <h3 class="font-bold text-gray-800 mb-4 flex items-center"><span class="bg-yellow-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center ml-2">5</span> مساحة لك</h3>
            <textarea name="notes" placeholder="اكتب ملاحظاتك..." class="w-full h-24 p-3 border rounded-xl bg-gray-50 text-sm focus:ring-2 focus:ring-blue-500 transition-all"></textarea>
        </div>

        <!-- زر الإرسال -->
<button type="submit" 
        class="w-full bg-yellow-500 text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition-all duration-300 transform hover:scale-105 animate__animated animate__pulse animate__infinite">
    إرسال الاستبيان
</button>
    </form>
</div>
<script>
    // 1. تفعيل النجوم (تأشير وتثبيت)
    document.querySelectorAll('.rating-stars').forEach(group => {
        const labels = group.querySelectorAll('label');

        labels.forEach(label => {
            // عند التأشير (Hover)
            label.addEventListener('mouseover', function() {
                resetStars(group);
                highlightStars(this);
            });

            // عند الضغط (Click) - تثبيت الاختيار
            label.addEventListener('click', function() {
                group.querySelectorAll('label').forEach(l => l.classList.remove('selected'));
                this.classList.add('selected');
                highlightStars(this);
            });
        });

        // عند خروج الماوس، استرجع التقييم المثبت فقط
        group.addEventListener('mouseleave', function() {
            resetStars(group);
            const selected = group.querySelector('label.selected');
            if (selected) highlightStars(selected);
        });
    });

    function highlightStars(label) {
        label.style.color = '#f59e0b';
        let next = label.nextElementSibling;
        while (next) {
            if (next.tagName === 'LABEL') next.style.color = '#f59e0b';
            next = next.nextElementSibling;
        }
    }

    function resetStars(group) {
        group.querySelectorAll('label').forEach(l => {
            if (!l.classList.contains('selected')) l.style.color = '#e5e7eb';
        });
    }

    // 2. تفعيل اختيار الجنس
    document.querySelectorAll('input[name="gender"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('input[name="gender"]').forEach(r => {
                r.parentElement.style.backgroundColor = 'transparent';
                r.parentElement.style.borderColor = '#e5e7eb';
                r.parentElement.style.color = '#374151';
            });
            this.parentElement.style.backgroundColor = '#eff6ff';
            this.parentElement.style.borderColor = '#244cb3';
            this.parentElement.style.color = '#244cb3';
        });
    });
    // تفعيل اختيار "التوصية"
document.querySelectorAll('.rec-option').forEach(label => {
    label.addEventListener('click', function() {
        // إزالة التحديد من جميع الخيارات في نفس المجموعة
        this.parentElement.querySelectorAll('.rec-option').forEach(el => {
            el.style.backgroundColor = 'transparent';
            el.style.color = '#374151'; // لون النص الأصلي
            el.style.borderColor = '#e5e7eb'; // اللون الرمادي
        });
        
        // تلوين الخيار المختار
        this.style.backgroundColor = '#2563eb'; // لون الأزرق
        this.style.color = '#ffffff'; // نص أبيض
        this.style.borderColor = '#2563eb';
    });
});

// تفعيل الحركة عند التمرير (Scroll)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__fadeInUp'); // نوع الحركة
                entry.target.style.opacity = 1;
            }
        });
    });

    // العناصر اللي تبيها تتحرك (أعطي كل جزء من الفورم كلاس .scroll-animate)
    document.querySelectorAll('.scroll-animate').forEach((el) => {
        el.style.opacity = 0; // إخفاء العنصر مبدئياً
        observer.observe(el);
    });
</script>
@endsection