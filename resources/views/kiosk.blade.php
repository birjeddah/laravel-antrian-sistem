<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>جمعية البر بجدة | خدمة المستفيدين</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #022c22, #064e3b, #047857, #0f172a);
            background-size: 400% 400%;
            animation: royalGradient 18s ease infinite;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            user-select: none;
            overflow-x: hidden;
            margin: 0;
        }

        @keyframes royalGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .royal-header {
            background: rgba(2, 44, 34, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
            padding: 2.5rem 1rem;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        .royal-logo {
            height: 90px;
            object-fit: contain;
            margin-bottom: 1.2rem;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.4));
        }

        .welcome-title {
            font-size: 2.8rem;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 0.4rem;
            text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
        }

        .welcome-title span {
            color: #fbbf24;
        }

        .welcome-subtitle {
            font-size: 1.4rem;
            color: #a7f3d0;
            font-weight: 700;
            margin-bottom: 0;
        }

        .main-container {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 3rem 1.5rem;
        }

        .section-prompt {
            font-size: 1.6rem;
            font-weight: 800;
            color: #f1f5f9;
            text-align: center;
            margin-bottom: 3rem;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .department-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(14px);
            border: 2px solid rgba(20, 184, 166, 0.3);
            border-radius: 32px;
            padding: 3rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .department-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 6px;
            background: linear-gradient(90deg, #10b981, #fbbf24, #38bdf8);
        }

        .department-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: #fbbf24;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 30px 60px rgba(16, 185, 129, 0.3);
        }

        .department-icon {
            width: 90px;
            height: 90px;
            background: rgba(16, 185, 129, 0.15);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem auto;
            font-size: 2.5rem;
            color: #34d399;
            transition: all 0.4s ease;
        }

        .department-card:hover .department-icon {
            background: rgba(251, 191, 36, 0.2);
            border-color: #fbbf24;
            color: #fbbf24;
            transform: rotate(10deg) scale(1.1);
        }

        .department-title {
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1.5rem;
        }

        .queue-status-badge {
            background: rgba(2, 44, 34, 0.9);
            border: 1px solid rgba(20, 184, 166, 0.4);
            border-radius: 50px;
            padding: 0.8rem 1.6rem;
            font-size: 1.15rem;
            font-weight: 700;
            color: #e2e8f0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.3);
            margin: 0 auto;
        }

        .waiting-number-val {
            color: #fbbf24;
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 900;
        }

        #ticket-print-area {
            display: none;
        }

        @media print {
            body * {
                visibility: hidden !important;
                display: none !important;
            }
            #ticket-print-area, #ticket-print-area * {
                visibility: visible !important;
                display: block !important;
            }
            #ticket-print-area {
                position: fixed !important;
                left: 0 !important;
                top: 0 !important;
                width: 76mm !important;
                margin: 0 auto !important;
                padding: 4mm !important;
                text-align: center !important;
                color: #000 !important;
                background: #fff !important;
                z-index: 999999 !important;
            }
            .ticket-header { font-size: 15px; font-weight: bold; margin-bottom: 2px; }
            .ticket-sub { font-size: 10px; margin-bottom: 6px; font-weight: bold; color: #064e3b; }
            .ticket-department { font-size: 16px; font-weight: bold; padding: 4px 0; border-top: 1px dashed #000; border-bottom: 1px dashed #000; margin-bottom: 6px; }
            .ticket-number { font-family: 'Outfit', sans-serif; font-size: 44px; font-weight: 900; margin: 4px 0; line-height: 1; }
            .ticket-info { font-size: 10px; margin-bottom: 3px; }
            .ticket-footer { font-size: 9px; margin-top: 8px; border-top: 1px solid #ccc; padding-top: 4px; }
        }
    </style>
</head>
<body>

    <header class="royal-header">
        <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="شعار جمعية البر بجدة" class="royal-logo">
        <h1 class="welcome-title">أهلاً بكم في <span>جمعية البر بجدة</span></h1>
        <p class="welcome-subtitle">نسعد بخدمتكم، ونعتز بثقتكم الدائمة</p>
    </header>

    <main class="main-container container">
        <div class="w-100">
            <h2 class="section-prompt">الرجاء اختيار القسم المطلوب لسحب التذكرة</h2>
            
            <div class="row g-5 justify-content-center">
                @forelse($lokets as $loket)
                    @php
                        $today = \Carbon\Carbon::today();
                        $issuedKey = 'kiosk_issued_' . $loket->id . '_' . date('Y-m-d');
                        $totalIssued = cache()->get($issuedKey, 0);
                        $dbCount = \App\Models\Antrian::where('loket_id', $loket->id)
                            ->whereDate('created_at', $today)
                            ->count();
                        $countWaiting = max(0, $totalIssued - $dbCount);
                    @endphp
                    <div class="col-md-6 col-lg-5">
                        <div class="department-card" onclick="issueTicket({{ $loket->id }})">
                            <div>
                                the department-icon">
                                <div class="department-icon">
                                    <i class="fas fa-hand-point-down"></i>
                                </div>
                                <h3 class="department-title">{{ $loket->tujuan }}</h3>
                            </div>
                            <div>
                                <div class="queue-status-badge">
                                    <span>المستفيدين في الانتظار:</span>
                                    <span class="waiting-number-val" id="count-{{ $loket->id }}">{{ $countWaiting }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-warning fs-4 p-5 rounded-4 shadow-lg border-0 bg-dark text-light">
                            لا توجد أقسام مفعلة حالياً. يرجى إعداد الشبابيك من لوحة التحكم.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- قالب الطباعة الحرارية -->
    <div id="ticket-print-area">
        <div class="ticket-header">جمعية البر بجدة</div>
        <div class="ticket-sub">نسعد بخدمتكم ونعتز بثقتكم</div>
        <div class="ticket-department" id="p-loket">-</div>
        <div class="ticket-number" id="p-nomor">-</div>
        <div class="ticket-info">أمامك في الانتظار: <strong id="p-waiting">-</strong> مراجع</div>
        <div class="ticket-info" id="p-time">-</div>
        <div class="ticket-footer">يرجى الانتظار حتى ظهور رقمكم على شاشات العرض</div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function playChime() {
            try {
                let ctx = new (window.AudioContext || window.webkitAudioContext)();
                let osc = ctx.createOscillator();
                let gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(659.25, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15);
                gain.gain.setValueAtTime(0.4, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.45);
                osc.start();
                osc.stop(ctx.currentTime + 0.5);
            } catch(e) {}
        }

        // نصيحة سريعة لمتصفح الكروم لتجاوز زر الطباعة نهائياً في جهاز الكيوسك:
        // افتح صفحة الكيوسك، اضغط Ctrl+P مرة واحدة، اختر الطابعة الحرارية، وفي خيارات إضافية ألغِ تفعيل "Headers and footers" وتأكد أن الطابعة الافتراضية معتمدة، في المرات القادمة ستطبع فوراً دون مربعات حوار مزعجة.

        function issueTicket(id) {
            playChime();

            $.ajax({
                url: '/kiosk/ticket/' + id,
                type: 'GET',
                success: function(res) {
                    $('#p-nomor').text(res.nomor);
                    $('#p-loket').text(res.loket);
                    $('#p-waiting').text(res.waiting);
                    $('#p-time').text(res.time);
                    
                    $('#count-' + id).text(res.waiting);

                    // أمر الطباعة المباشر
                    window.print();
                },
                error: function(xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
