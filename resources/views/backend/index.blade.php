@extends('layouts.backend.master')

@section('title')
    لوحة التحكم | جمعية البر بجدة
@endsection

@section('content')
    @php
        $today = \Carbon\Carbon::today();
        // إجمالي تذاكر اليوم
        $totalTicketsToday = \App\Models\Antrian::whereDate('created_at', $today)->count();
        // عدد الشبابيك المفعلة
        $activeLokets = \App\Models\Loket::where('status', true)->count();
        // التذاكر المكتملة
        $finishedToday = \App\Models\Antrian::whereDate('created_at', $today)->where('status', 'finish')->count();
        // عدد الموظفين المسجلين في النظام
        $totalStaff = \App\Models\User::count();
    @endphp

    <div class="row">
        <!-- الكرت الأول: إجمالي التذاكر -->
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="bi bi-ticket-perforated-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">تذاكر اليوم</h6>
                            <h6 class="font-extrabold mb-0">{{ number_format($totalTicketsToday) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الكرت الثاني: الشبابيك النشطة -->
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="bi bi-display"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">الشبابيك النشطة</h6>
                            <h6 class="font-extrabold mb-0">{{ number_format($activeLokets) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الكرت الثالث: المراجعين المنجزين -->
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon green mb-2">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">تمت خدمتهم</h6>
                            <h6 class="font-extrabold mb-0">{{ number_format($finishedToday) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الكرت الرابع: الموظفين -->
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">الموظفين</h6>
                            <h6 class="font-extrabold mb-0">{{ number_format($totalStaff) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الرسم البياني -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>إحصائيات توافد المراجعين</h4>
                </div>
                <div class="card-body">
                    <div id="chart-profile-visit"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // استبدال الشعار في القائمة الجانبية بشعار الجمعية الرسمي
            let albirLogo = 'https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75';
            $('img[alt*="logo"], .sidebar-brand img, .brand-image, .app-brand img').attr('src', albirLogo).css({
                'max-height': '55px',
                'width': 'auto',
                'display': 'block',
                'margin': '0 auto'
            });

            // إخفاء عبارة القهوة الإندونيسية القديمة إن وجدت في الترويسة
            $('p, h1, h2, header').each(function() {
                if ($(this).text().includes('Minum') || $(this).text().includes('Jangan')) {
                    $(this).hide();
                }
            });

            // إخفاء الفوتر الإندونيسي
            $('footer, .main-footer').hide();
        });
    </script>
@endsection
