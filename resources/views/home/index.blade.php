<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>شاشة عرض الانتظار | صالة خدمة المستفيدين</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts: IBM Plex Sans Arabic & Outfit for Numbers -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #064e3b;
            --primary-emerald: #0d5f57;
            --primary-light: #10b981;
            --accent-gold: #d97706;
            --bg-canvas: #0f172a;
            --card-glass: rgba(255, 255, 255, 0.04);
            --card-border: rgba(255, 255, 255, 0.1);
            --text-glow: 0 0 20px rgba(16, 185, 129, 0.3);
        }

        * {
            box-sizing: border-box;
            user-select: none;
        }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            background: radial-gradient(circle at 10% 20%, #0d2824 0%, #081a17 50%, #040e0c 100%);
            min-height: 100vh;
            color: #ffffff;
            margin: 0;
            padding: 1.5rem;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* رأس الشاشة */
        .tv-header {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 1rem 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .brand-box img {
            max-height: 65px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4));
        }

        .brand-box .title-text {
            border-right: 2px solid rgba(255, 255, 255, 0.2);
            padding-right: 1.5rem;
            margin-right: 1.5rem;
        }

        .clock-container {
            text-align: left;
        }

        .clock-container #clock {
            font-family: 'Outfit', sans-serif;
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: 2px;
            color: #34d399;
            text-shadow: 0 0 15px rgba(52, 211, 153, 0.4);
            line-height: 1;
        }

        .clock-container #day {
            color: #94a3b8;
            font-size: 1rem;
            font-weight: 500;
            margin-top: 4px;
        }

        /* بطاقة رسالة الاستقبال والترحيب */
        .welcome-hero-card {
            background: linear-gradient(135deg, rgba(13, 95, 87, 0.35) 0%, rgba(6, 78, 59, 0.2) 100%);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 24px;
            padding: 2.2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(12px);
        }

        .welcome-hero-card::after {
            content: '\f4b8';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: -20px;
            bottom: -30px;
            font-size: 10rem;
            color: rgba(255, 255, 255, 0.025);
            pointer-events: none;
        }

        /* بطاقة أوقات العمل */
        .hours-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 1.8rem;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            backdrop-filter: blur(12px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .hours-badge {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            font-weight: 700;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 0.8rem;
        }

        .time-box h4 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #f8fafc;
            margin-bottom: 0;
        }

        /* بطاقات شبابيك الانتظار */
        .queue-grid {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .loket-tv-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
            border: 1.5px solid var(--card-border);
            border-radius: 26px;
            padding: 1.8rem 1.2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.35s ease;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(16px);
        }

        .loket-tv-card.active-pulse {
            border-color: #34d399;
            box-shadow: 0 0 35px rgba(16, 185, 129, 0.35);
            transform: scale(1.02);
        }

        .loket-tv-card .window-tag {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            color: #e2e8f0;
            display: inline-block;
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
        }

        .loket-tv-card .ticket-label {
            font-size: 0.95rem;
            color: #94a3b8;
            font-weight: 500;
            margin-bottom: 0.3rem;
            text-transform: uppercase;
        }

        .loket-tv-card .current-number {
            font-family: 'Outfit', sans-serif;
            font-size: 4.8rem;
            font-weight: 900;
            color: #facc15;
            text-shadow: 0 0 25px rgba(250, 204, 21, 0.35);
            line-height: 1;
            margin: 0.8rem 0;
            letter-spacing: 2px;
        }

        .loket-tv-card .officer-name {
            color: #38bdf8;
            font-size: 0.95rem;
            font-weight: 600;
            margin-top: 0.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 0.8rem;
        }

        /* شريط الأخبار السفلي */
        .ticker-bar {
            background: rgba(6, 78, 59, 0.4);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 18px;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .ticker-badge {
            background: var(--primary-emerald);
            color: #ffffff;
            font-weight: 700;
            padding: 0.3rem 0.9rem;
            border-radius: 10px;
            font-size: 0.88rem;
            margin-left: 1rem;
            white-space: nowrap;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        marquee {
            font-size: 1.15rem;
            font-weight: 600;
            color: #f1f5f9;
        }
    </style>
</head>

<body>
    <!-- ترويسة الشاشة -->
    <header class="tv-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center brand-box">
                <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="شعار الجمعية">
                <div class="title-text d-none d-md-block">
                    <h4 class="fw-bold mb-1 text-white">منظومة إدارة وخدمة المستفيدين</h4>
                    <p class="mb-0 text-white-50 small">أهلاً وسهلاً بكم | نسعد بتقديم أفضل وأسرع خدمة لكم</p>
                </div>
            </div>

            <div class="clock-container">
                <div id="clock">00:00:00</div>
                <div id="day">جاري ضبط الوقت...</div>
            </div>
        </div>
    </header>

    <!-- منطقة العرض والتعريف بأوقات العمل -->
    <section class="container-fluid px-0">
        <div class="row g-4">
            <div class="col-lg-9">
                <div class="welcome-hero-card">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                            <i class="fa-solid fa-bullhorn ms-1"></i> تنبيه للمراجعين
                        </span>
                    </div>
                    <h2 class="fw-bold text-white mb-2">نعمل على خدمتكم وتسهيل إجراءاتكم بكل عناية</h2>
                    <p class="text-white-50 fs-5 mb-0" style="max-width: 800px;">
                        يرجى الجلوس في صالة الانتظار ومتابعة رقم تذكرتكم على الشاشات، وسيتم نداء رقمكم والتوجه فوراً إلى الشباك المخصص.
                    </p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="hours-card">
                    <span class="hours-badge"><i class="fa-regular fa-clock ms-1"></i> ساعات استقبال المراجعين</span>
                    <div class="time-box my-1">
                        <span class="text-white-50 small d-block">الفترة الصباحية</span>
                        <h4>08:00 ص - 02:30 م</h4>
                    </div>
                    <div class="text-success small fw-semibold mt-2">
                        <i class="fa-solid fa-circle-check ms-1"></i> الصالة متاحة لاستقبالكم الآن
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- بطاقات الشبابيك وأرقام الانتظار الحالية -->
    <main class="container-fluid px-0 queue-grid my-auto">
        <div class="row g-4 justify-content-center">
            @forelse ($data as$item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="loket-tv-card" id="card-box-{{ $item->id }}">
                        <div class="window-tag">
                            <i class="fa-solid fa-desktop ms-1 text-emerald"></i> {{ $item->tujuan }}
                        </div>
                        <div class="ticket-label">الرقم الحالي قيد الخدمة</div>
                        <div class="current-number" id="nomor-{{ $item->id }}">-</div>
                        <div class="officer-name">
                            <i class="fa-solid fa-user-tie ms-1"></i> {{ $item->user->name ?? 'موظف الخدمة' }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px dashed rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-tv text-white-50 mb-3" style="font-size: 3.5rem;"></i>
                        <h4 class="text-white fw-bold">لا توجد شبابيك مفعلة حالياً</h4>
                        <p class="text-white-50 mb-0">يرجى تفعيل شبابيك الخدمة من لوحة التحكم لتظهر أرقام الانتظار هنا.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- شريط الإعلانات والأخبار المتحرك -->
    <footer class="ticker-bar mt-auto">
        <span class="ticker-badge"><i class="fa-solid fa-info-circle ms-1"></i> إعلان هام</span>
        <marquee direction="right" scrollamount="6">
            أهلاً وسهلاً بكم في صالة خدمة المستفيدين — نرجو من مراجعينا الكرام التأكد من إحضار كافة المستندات المطلوبة لإتمام المعاملة بكل يسر وسهولة — نسعد دائماً بخدمتكم.
        </marquee>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- تحديث الساعة والتاريخ العربي اللحظي -->
    <script>
        function updateLiveTime() {
            const now = new Date();
            
            // الوقت بنظام 12 ساعة مع AM/PM
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

            // التاريخ بالعربية
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = now.toLocaleDateString('ar-SA', options);
            document.getElementById('day').textContent = formattedDate;
        }
        setInterval(updateLiveTime, 1000);
        updateLiveTime();
    </script>

    <!-- مزامنة أرقام الانتظار وتأثير الحركة عند النداء -->
    @foreach ($data as$js)
        <script>
            $(document).ready(function() {
                var lastNumber = '';
                setInterval(function() {
                    var nomor = '{{ $js->id }}';$.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        data: { nomor: nomor },
                        url: "/",
                        type: "POST",
                        dataType: 'json',
                        success: function(data) {
                            var target = $('#nomor-' + nomor);
                            var cardBox = $('#card-box-' + nomor);
                            
                            if (data !== null && data !== '') {
                                if (lastNumber !== '' && lastNumber !== data) {
                                    // حركة وميض وتنبيه عند تغير الرقم
                                    cardBox.addClass('active-pulse');
                                    setTimeout(() => cardBox.removeClass('active-pulse'), 4000);
                                }
                                target.html(data);
                                lastNumber = data;
                            } else {
                                target.html('-');
                            }
                        }
                    });
                }, 1500);
            });
        </script>
    @endforeach
</body>

</html>
