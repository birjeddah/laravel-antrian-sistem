<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>شاشة عرض الانتظار | صالة خدمة المستفيدين</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- الخطوط: IBM Plex Sans Arabic للأيقونات والنصوص و Outfit للأرقام -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL & FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #064e3b;
            --primary-emerald: #0d5f57;
            --primary-light: #10b981;
            --accent-gold: #d97706;
            --bg-canvas: #040e0c;
            --card-glass: rgba(255, 255, 255, 0.04);
            --card-border: rgba(255, 255, 255, 0.09);
        }

        * {
            box-sizing: border-box;
            user-select: none;
        }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            background: radial-gradient(circle at 15% 15%, #0d2824 0%, #071916 45%, #030a08 100%);
            min-height: 100vh;
            color: #ffffff;
            margin: 0;
            padding: 1.5rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
        }

        /* ترويسة الشاشة */
        .tv-header {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(18px);
            border: 1px solid var(--card-border);
            border-radius: 22px;
            padding: 1rem 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }

        .brand-box img {
            max-height: 60px;
            object-fit: contain;
            filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.4));
        }

        .brand-box .title-text {
            border-right: 2px solid rgba(255, 255, 255, 0.15);
            padding-right: 1.5rem;
            margin-right: 1.5rem;
        }

        .clock-container {
            text-align: left;
        }

        .clock-container #clock {
            font-family: 'Outfit', sans-serif;
            font-size: 2.7rem;
            font-weight: 800;
            letter-spacing: 2px;
            color: #34d399;
            text-shadow: 0 0 20px rgba(52, 211, 153, 0.35);
            line-height: 1;
        }

        .clock-container #day {
            color: #94a3b8;
            font-size: 0.95rem;
            font-weight: 500;
            margin-top: 4px;
        }

        /* رسالة الترحيب */
        .hero-banner {
            background: linear-gradient(135deg, rgba(13, 95, 87, 0.4) 0%, rgba(6, 78, 59, 0.2) 100%);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 22px;
            padding: 1.8rem 2.2rem;
            position: relative;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(12px);
        }

        .hours-badge {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            font-weight: 700;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            font-size: 0.82rem;
            display: inline-block;
        }

        /* بطاقات أرقام الانتظار */
        .loket-card-tv {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
            border: 1.5px solid var(--card-border);
            border-radius: 24px;
            padding: 1.6rem 1.2rem;
            text-align: center;
            transition: all 0.35s ease;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(14px);
        }

        .loket-card-tv.pulse {
            border-color: #34d399;
            box-shadow: 0 0 35px rgba(16, 185, 129, 0.4);
            transform: scale(1.02);
        }

        .window-badge {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.35rem 1.2rem;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 700;
            color: #e2e8f0;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .ticket-title {
            font-size: 0.9rem;
            color: #94a3b8;
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .ticket-number {
            font-family: 'Outfit', sans-serif;
            font-size: 4.5rem;
            font-weight: 900;
            color: #facc15;
            text-shadow: 0 0 25px rgba(250, 204, 21, 0.35);
            line-height: 1;
            margin: 0.6rem 0;
            letter-spacing: 2px;
        }

        .officer-info {
            color: #38bdf8;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 0.8rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 0.7rem;
        }

        /* شريط الأخبار السفلي */
        .ticker-bar {
            background: rgba(6, 78, 59, 0.45);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 16px;
            padding: 0.7rem 1.4rem;
            display: flex;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .ticker-tag {
            background: var(--primary-emerald);
            color: #ffffff;
            font-weight: 700;
            padding: 0.3rem 0.9rem;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-left: 1rem;
            white-space: nowrap;
        }

        marquee {
            font-size: 1.1rem;
            font-weight: 600;
            color: #f8fafc;
        }
    </style>
</head>

<body>
    <!-- الترويسة -->
    <header class="tv-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center brand-box">
                <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="شعار الجمعية">
                <div class="title-text d-none d-md-block">
                    <h4 class="fw-bold mb-1 text-white">منظومة إدارة وخدمة المستفيدين</h4>
                    <p class="mb-0 text-white-50 small">صالة الاستقبال والانتظار الرقمية</p>
                </div>
            </div>

            <div class="clock-container">
                <div id="clock">00:00:00</div>
                <div id="day">جاري الضبط...</div>
            </div>
        </div>
    </header>

    <!-- رسالة ترحيبية وأوقات العمل -->
    <section class="container-fluid px-0 mb-4">
        <div class="row g-4">
            <div class="col-lg-9">
                <div class="hero-banner">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold">
                            <i class="fa-solid fa-bullhorn ms-1"></i> إشعار
                        </span>
                    </div>
                    <h3 class="fw-bold text-white mb-2">نسعد بخدمتكم وتسهيل معاملاتكم بكل رحابة واهتمام</h3>
                    <p class="text-white-50 fs-6 mb-0">
                        يرجى الجلوس ومتابعة رقم تذكرتكم على الشاشة، والتوجه إلى الشباك الموضح فور ظهور الرقم.
                    </p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="hero-banner text-center d-flex flex-column justify-content-center h-100">
                    <span class="hours-badge mx-auto mb-2"><i class="fa-regular fa-clock ms-1"></i> أوقات استقبال المراجعين</span>
                    <h4 class="fw-bold mb-0 text-white" style="font-family: 'Outfit';">08:00 AM - 02:30 PM</h4>
                    <span class="text-success small fw-semibold mt-1"><i class="fa-solid fa-circle-check ms-1"></i> الصالة تستقبلكم الآن</span>
                </div>
            </div>
        </div>
    </section>

    <!-- شبكة الشبابيك -->
    <main class="container-fluid px-0 my-auto">
        <div class="row g-4 justify-content-center">
            @forelse ($data as$item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="loket-card-tv" id="card-box-{{ $item->id }}">
                        <div class="window-badge">
                            <i class="fa-solid fa-desktop ms-1 text-emerald"></i> {{ $item->tujuan }}
                        </div>
                        <div class="ticket-title">الرقم قيد الخدمة</div>
                        <div class="ticket-number" id="nomor-{{ $item->id }}">-</div>
                        <div class="officer-info">
                            <i class="fa-solid fa-user-tie ms-1"></i> {{ $item->user->name ?? 'موظف الخدمة' }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 rounded-4" style="background: rgba(255,255,255,0.02); border: 1px dashed rgba(255,255,255,0.1);">
                        <i class="fa-solid fa-tv text-white-50 mb-3" style="font-size: 3.5rem;"></i>
                        <h4 class="text-white fw-bold">لا توجد شبابيك مفعلة حالياً</h4>
                        <p class="text-white-50 mb-0">يرجى تفعيل شبابيك الخدمة من لوحة التحكم لتظهر أرقام النداء هنا.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- الشريط الإخباري المتحرك -->
    <footer class="ticker-bar mt-auto">
        <span class="ticker-tag"><i class="fa-solid fa-info-circle ms-1"></i> تنبيه</span>
        <marquee direction="right" scrollamount="6">
            أهلاً بكم في صالة خدمة المستفيدين — نرجو من مراجعينا الكرام التأكد من إحضار كافة المستندات المطلوبة لإتمام المعاملة بكل يسر وسهولة — نسعد دائماً بخدمتكم.
        </marquee>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateClock() {
            const now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('day').textContent = now.toLocaleDateString('ar-SA', options);
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

    @foreach ($data as$js)
        <script>
            $(document).ready(function() {
                var lastNum = '';
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
                            var card = $('#card-box-' + nomor);
                            if (data !== null && data !== '') {
                                if (lastNum !== '' && lastNum !== data) {
                                    card.addClass('pulse');
                                    setTimeout(() => card.removeClass('pulse'), 3500);
                                }
                                target.html(data);
                                lastNum = data;
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
