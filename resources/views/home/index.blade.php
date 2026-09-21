<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>شاشة صالة خدمة المستفيدين</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- الخطوط -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;600;700;800&family=Outfit:wght@800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --brand-dark: #042f2e;
            --brand-primary: #0f766e;
            --brand-emerald: #059669;
            --brand-accent: #f59e0b;
            --bg-deep: #021a17;
            --card-glass: rgba(255, 255, 255, 0.05);
            --border-glass: rgba(255, 255, 255, 0.12);
        }

        * {
            box-sizing: border-box;
            user-select: none;
        }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            background: radial-gradient(circle at 10% 10%, #0d3832 0%, var(--bg-deep) 60%, #010d0b 100%);
            min-height: 100vh;
            color: #ffffff;
            margin: 0;
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
        }

        /* ترويسة الشاشة */
        .tv-top-bar {
            background: var(--card-glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 1.2rem 2.2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .brand-logo {
            max-height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.5));
        }

        .title-divider {
            border-right: 2px solid rgba(255, 255, 255, 0.2);
            padding-right: 1.8rem;
            margin-right: 1.8rem;
        }

        .clock-num {
            font-family: 'Outfit', sans-serif;
            font-size: 3.2rem;
            font-weight: 900;
            letter-spacing: 2px;
            color: #34d399;
            text-shadow: 0 0 25px rgba(52, 211, 153, 0.45);
            line-height: 1;
        }

        .date-txt {
            color: #94a3b8;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 5px;
        }

        /* رسالة الترحيب وأوقات الدوام */
        .banner-panel {
            background: linear-gradient(135deg, rgba(15, 118, 110, 0.35) 0%, rgba(5, 150, 105, 0.15) 100%);
            border: 1.5px solid rgba(52, 211, 153, 0.3);
            border-radius: 26px;
            padding: 2.2rem;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(15px);
        }

        .hours-badge {
            background: rgba(52, 211, 153, 0.18);
            color: #34d399;
            font-weight: 700;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.95rem;
            display: inline-block;
        }

        /* بطاقات عرض أرقام الانتظار */
        .counter-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.07) 0%, rgba(255, 255, 255, 0.02) 100%);
            border: 2px solid var(--border-glass);
            border-radius: 28px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(20px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .counter-card.call-pulse {
            border-color: #34d399;
            box-shadow: 0 0 50px rgba(52, 211, 153, 0.6);
            transform: scale(1.03);
        }

        .counter-name {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1.6rem;
            border-radius: 50px;
            font-size: 1.15rem;
            font-weight: 800;
            color: #f1f5f9;
            display: inline-block;
            margin-bottom: 1.2rem;
        }

        .queue-num {
            font-family: 'Outfit', sans-serif;
            font-size: 5.5rem;
            font-weight: 900;
            color: var(--brand-accent);
            text-shadow: 0 0 35px rgba(245, 158, 11, 0.45);
            line-height: 1;
            margin: 0.8rem 0;
            letter-spacing: 3px;
        }

        .staff-label {
            color: #38bdf8;
            font-size: 1.05rem;
            font-weight: 700;
            margin-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 0.9rem;
        }

        /* شريط الأخبار السفلي */
        .bottom-ticker {
            background: rgba(4, 47, 46, 0.65);
            border: 1.5px solid rgba(52, 211, 153, 0.35);
            border-radius: 20px;
            padding: 0.9rem 1.8rem;
            display: flex;
            align-items: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(15px);
        }

        .ticker-pill {
            background: var(--brand-primary);
            color: #ffffff;
            font-weight: 800;
            padding: 0.4rem 1.2rem;
            border-radius: 12px;
            font-size: 0.95rem;
            margin-left: 1.5rem;
            white-space: nowrap;
        }

        marquee {
            font-size: 1.25rem;
            font-weight: 600;
            color: #f8fafc;
        }
    </style>
</head>

<body>
    <header class="tv-top-bar mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" class="brand-logo" alt="شعار الجمعية">
                <div class="title-divider d-none d-md-block">
                    <h3 class="fw-bold mb-1 text-white">صالة خدمة المستفيدين</h3>
                    <p class="mb-0 text-white-50 fs-6">شاشة عرض ومتابعة أرقام الانتظار</p>
                </div>
            </div>

            <div class="text-start">
                <div id="clock" class="clock-num">00:00:00</div>
                <div id="day" class="date-txt">جاري المزامنة...</div>
            </div>
        </div>
    </header>

    <section class="container-fluid px-0 mb-4">
        <div class="row g-4">
            <div class="col-lg-9">
                <div class="banner-panel">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold fs-6">
                            <i class="fa-solid fa-bullhorn ms-1"></i> إشعار للمراجعين
                        </span>
                    </div>
                    <h2 class="fw-bold text-white mb-2">أهلاً وسهلاً بكم | نسعد بتقديم أفضل وأسرع خدمة</h2>
                    <p class="text-white-50 fs-5 mb-0">
                        يرجى الجلوس في مقاعد الانتظار ومتابعة رقمكم على الشاشة؛ والتوجه مباشرة إلى الشباك الموضح فور استدعاء الرقم.
                    </p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="banner-panel text-center d-flex flex-column justify-content-center h-100">
                    <span class="hours-badge mx-auto mb-2"><i class="fa-regular fa-clock ms-1"></i> أوقات استقبال المراجعين</span>
                    <h3 class="fw-bold mb-1 text-white" style="font-family: 'Outfit';">08:00 AM - 02:30 PM</h3>
                    <span class="text-success fw-bold fs-6 mt-1"><i class="fa-solid fa-circle-check ms-1"></i> الصالة مفتوحة حالياً</span>
                </div>
            </div>
        </div>
    </section>

    <main class="container-fluid px-0 my-auto">
        <div class="row g-4 justify-content-center">
            @forelse ($data as$item)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="counter-card" id="card-box-{{ $item->id }}">
                        <div class="counter-name">
                            <i class="fa-solid fa-desktop ms-1 text-emerald"></i> {{ $item->tujuan }}
                        </div>
                        <div class="text-white-50 fw-semibold fs-6 mb-1">الرقم قيد الخدمة</div>
                        <div class="queue-num" id="nomor-{{ $item->id }}">-</div>
                        <div class="staff-label">
                            <i class="fa-solid fa-user-tie ms-1"></i> {{ $item->user->name ?? 'موظف الخدمة' }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 rounded-4" style="background: rgba(255,255,255,0.03); border: 2px dashed rgba(255,255,255,0.15);">
                        <i class="fa-solid fa-tv text-white-50 mb-3" style="font-size: 4rem;"></i>
                        <h3 class="text-white fw-bold">لا توجد شبابيك مفعلة حالياً</h3>
                        <p class="text-white-50 fs-5 mb-0">يرجى تفعيل شبابيك الخدمة من لوحة التحكم لتظهر أرقام الانتظار هنا مباشرة.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bottom-ticker mt-auto">
        <span class="ticker-pill"><i class="fa-solid fa-circle-info ms-1"></i> إعلان</span>
        <marquee direction="right" scrollamount="6">
            أهلاً بكم في صالة خدمة المستفيدين — نرجو من مراجعينا الكرام تجهيز الهوية الوطنية والوثائق المطلوبة لسرعة إنهاء الإجراءات — نسعد دائماً بخدمتكم.
        </marquee>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateLiveTime() {
            const now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;

            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('day').textContent = now.toLocaleDateString('ar-SA', options);
        }
        setInterval(updateLiveTime, 1000);
        updateLiveTime();
    </script>

    @foreach ($data as$js)
        <script>
            $(document).ready(function() {
                var lastVal = '';
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
                                if (lastVal !== '' && lastVal !== data) {
                                    card.addClass('call-pulse');
                                    setTimeout(() => card.removeClass('call-pulse'), 3500);
                                }
                                target.html(data);
                                lastVal = data;
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
