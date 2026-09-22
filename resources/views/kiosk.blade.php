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
        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100vh;
            max-height: 100vh;
            overflow: hidden; /* يمنع ظهور شريط التمرير نهائياً */
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #022c22, #064e3b, #047857, #0f172a);
            background-size: 400% 400%;
            animation: royalGradient 18s ease infinite;
            font-family: 'Cairo', sans-serif;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            user-select: none;
        }

        @keyframes royalGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* الترويسة العلوية */
        .royal-header {
            background: rgba(2, 44, 34, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
            padding: 1rem 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }

        .royal-logo {
            height: clamp(50px, 6vh, 75px);
            object-fit: contain;
            margin-bottom: 0.4rem;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4));
        }

        .welcome-title {
            font-size: clamp(1.4rem, 2.4vh, 2.2rem);
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 0.2rem;
            line-height: 1.2;
        }

        .welcome-title span {
            color: #fbbf24;
        }

        .welcome-subtitle {
            font-size: clamp(0.95rem, 1.5vh, 1.2rem);
            color: #a7f3d0;
            font-weight: 700;
            margin-bottom: 0;
        }

        /* الحاوية الرئيسية المرنة */
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.2rem 2rem 1.5rem;
            min-height: 0; /* يسمح للعناصر الداخلية بالتصغير التلقائي داخل الـ Flex */
        }

        .section-prompt {
            font-size: clamp(1.1rem, 2vh, 1.5rem);
            font-weight: 800;
            color: #f1f5f9;
            text-align: center;
            margin-bottom: 1rem;
            flex-shrink: 0;
            text-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        /* شبكة ديناميكية تتكيف مع أي عدد من الشبابيك */
        .dynamic-departments-grid {
            flex: 1;
            display: grid;
            gap: 1.2rem;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            align-content: stretch;
            min-height: 0;
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
        }

        /* بطاقة القسم الذكية */
        .department-card {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(14px);
            border: 2px solid rgba(20, 184, 166, 0.3);
            border-radius: 24px;
            padding: 1.2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
            height: 100%;
        }

        .department-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #10b981, #fbbf24, #38bdf8);
        }

        .department-card:hover {
            transform: translateY(-4px) scale(1.015);
            border-color: #fbbf24;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.3);
        }

        .department-icon {
            width: clamp(55px, 8vh, 80px);
            height: clamp(55px, 8vh, 80px);
            background: rgba(16, 185, 129, 0.15);
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: clamp(1.6rem, 3.5vh, 2.4rem);
            color: #34d399;
            transition: all 0.3s ease;
        }

        .department-card:hover .department-icon {
            background: rgba(251, 191, 36, 0.2);
            border-color: #fbbf24;
            color: #fbbf24;
            transform: scale(1.08);
        }

        .department-title {
            font-size: clamp(1.3rem, 2.6vh, 2rem);
            font-weight: 800;
            color: #ffffff;
            margin: 0.5rem 0;
            line-height: 1.2;
        }

        .queue-status-badge {
            background: rgba(2, 44, 34, 0.9);
            border: 1px solid rgba(20, 184, 166, 0.4);
            border-radius: 50px;
            padding: 0.4rem 1.2rem;
            font-size: clamp(0.85rem, 1.4vh, 1.05rem);
            font-weight: 700;
            color: #e2e8f0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.3);
        }

        .waiting-number-val {
            color: #fbbf24;
            font-family: 'Outfit', sans-serif;
            font-size: clamp(1.1rem, 2vh, 1.4rem);
            font-weight: 900;
        }

        /* قالب الطباعة الحرارية */
        #ticket-print-area {
            display: none;
        }

        @media print {
            @page {
                size: 80mm auto;
                margin: 0mm;
            }
            body, html {
                width: 80mm !important;
                margin: 0 !important;
                padding: 0 !important;
                background: #fff !important;
            }
            body * {
                visibility: hidden !important;
                display: none !important;
            }
            #ticket-print-area, #ticket-print-area * {
                visibility: visible !important;
                display: block !important;
            }
            #ticket-print-area {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 72mm !important;
                margin: 0 auto !important;
                padding: 4mm !important;
                text-align: center !important;
                color: #000 !important;
                background: #fff !important;
                font-family: 'Cairo', sans-serif !important;
            }
            .t-title { font-size: 14px; font-weight: 800; margin-bottom: 2px; }
            .t-sub { font-size: 9px; margin-bottom: 6px; font-weight: 700; color: #064e3b; }
            .t-dept { font-size: 15px; font-weight: 800; padding: 4px 0; border-top: 1px dashed #000; border-bottom: 1px dashed #000; margin-bottom: 6px; }
            .t-num { font-family: 'Outfit', sans-serif; font-size: 42px; font-weight: 900; margin: 4px 0; line-height: 1; }
            .t-inf { font-size: 9px; margin-bottom: 3px; }
            .t-foot { font-size: 8px; margin-top: 8px; border-top: 1px solid #ccc; padding-top: 4px; }
        }
    </style>
</head>
<body>

    <header class="royal-header">
        <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="شعار جمعية البر بجدة" class="royal-logo">
        <h1 class="welcome-title">أهلاً بكم في <span>جمعية البر بجدة</span></h1>
        <p class="welcome-subtitle">نسعد بخدمتكم، ونعتز بثقتكم الدائمة</p>
    </header>

    <main class="main-container">
        <h2 class="section-prompt">الرجاء اختيار القسم المطلوب لسحب التذكرة</h2>
        
        <div class="dynamic-departments-grid">
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
                <div class="department-card" onclick="issueTicket({{ $loket->id }})">
                    <div class="department-icon">
                        <i class="fas fa-hand-point-down"></i>
                    </div>
                    <h3 class="department-title">{{ $loket->tujuan }}</h3>
                    <div class="queue-status-badge">
                        <span>في الانتظار:</span>
                        <span class="waiting-number-val" id="count-{{ $loket->id }}">{{ $countWaiting }}</span>
                    </div>
                </div>
            @empty
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="alert alert-warning fs-5 p-4 rounded-4 shadow-lg border-0 bg-dark text-light text-center">
                        لا توجد أقسام مفعلة حالياً.
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- قالب التذكرة الحرارية -->
    <div id="ticket-print-area">
        <div class="t-title">جمعية البر بجدة</div>
        <div class="t-sub">نسعد بخدمتكم ونعتز بثقتكم</div>
        <div class="t-dept" id="p-loket">-</div>
        <div class="t-num" id="p-nomor">-</div>
        <div class="t-inf">أمامك في الانتظار: <strong id="p-waiting">-</strong> مراجع</div>
        <div class="t-inf" id="p-time">-</div>
        <div class="t-foot">يرجى الانتظار حتى ظهور رقمكم على شاشات العرض</div>
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
