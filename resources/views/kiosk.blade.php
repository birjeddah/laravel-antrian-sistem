<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>بوابة الخدمة الذاتية | سحب التذاكر</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;600;700;800&family=Outfit:wght@800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #0f172a;
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            min-height: 100vh;
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            user-select: none;
        }

        .header-section {
            background: #1e293b;
            border-bottom: 2px solid #334155;
            padding: 2.5rem 1rem;
            text-align: center;
        }

        .header-section h1 {
            font-size: 2.6rem;
            font-weight: 800;
            color: #38bdf8;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            font-size: 1.5rem;
            color: #10b981;
            font-weight: 700;
            margin-bottom: 0;
        }

        .kiosk-card {
            background: #1e293b;
            border: 3px solid #334155;
            border-radius: 28px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 280px;
        }

        .kiosk-card:hover, .kiosk-card:active {
            transform: scale(1.03);
            border-color: #38bdf8;
            background: #24344d;
            box-shadow: 0 15px 35px rgba(56, 189, 248, 0.25);
        }

        .kiosk-card i {
            font-size: 4rem;
            color: #38bdf8;
            margin-bottom: 1rem;
        }

        .kiosk-card h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .waiting-badge {
            background: #0f172a;
            border: 1px solid #475569;
            border-radius: 50px;
            padding: 0.6rem 1.2rem;
            font-size: 1.1rem;
            font-weight: 700;
            color: #cbd5e1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .waiting-count {
            color: #f59e0b;
            font-family: 'Outfit', sans-serif;
            font-size: 1.3rem;
            font-weight: 900;
        }

        /* إخفاء عنصر الطباعة بشكل طبيعي في الشاشة العادية */
        #ticket-print-area {
            display: none;
        }

        /* تنسيق الطباعة الحرارية الصارمة */
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
                padding: 5mm !important;
                text-align: center !important;
                color: #000 !important;
                background: #fff !important;
                z-index: 999999 !important;
            }
            .ticket-header { font-size: 14px; font-weight: bold; margin-bottom: 2px; }
            .ticket-sub { font-size: 10px; margin-bottom: 8px; }
            .ticket-department { font-size: 15px; font-weight: bold; padding: 4px 0; border-top: 1px dashed #000; border-bottom: 1px dashed #000; margin-bottom: 6px; }
            .ticket-number { font-family: 'Outfit', sans-serif; font-size: 42px; font-weight: 900; margin: 5px 0; line-height: 1; }
            .ticket-info { font-size: 10px; margin-bottom: 3px; }
            .ticket-footer { font-size: 9px; margin-top: 8px; }
        }
    </style>
</head>
<body>

    <header class="header-section">
        <h1>بوابة الخدمة الذاتية</h1>
        <p>نسعد بخدمتكم ونعتز بثقتكم</p>
    </header>

    <main class="container my-auto py-5">
        <h3 class="text-center text-light mb-5 fw-bold">الرجاء اختيار القسم المطلوب لسحب التذكرة</h3>
        
        <div class="row g-4 justify-content-center">
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
                <div class="col-md-6 col-lg-4">
                    <div class="kiosk-card" onclick="issueTicket({{ $loket->id }})">
                        <div>
                            <i class="fas fa-hand-pointer"></i>
                            <h3>{{ $loket->tujuan }}</h3>
                        </div>
                        <div>
                            <div class="waiting-badge">
                                <span>في الانتظار:</span>
                                <span class="waiting-count" id="count-{{ $loket->id }}">{{ $countWaiting }}</span>
                                <span>مراجع</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="alert alert-warning fs-5 p-4 rounded-4">
                        لا توجد أقسام مسجلة في النظام حالياً. يرجى إضافة شبابيك من لوحة التحكم.
                    </div>
                </div>
            @endforelse
        </div>
    </main>

    <!-- منطقة طباعة التذكرة -->
    <div id="ticket-print-area">
        <div class="ticket-header">جمعية البر بجدة</div>
        <div class="ticket-sub">نسعد بخدمتكم ونعتز بثقتكم</div>
        <div class="ticket-department" id="p-loket">-</div>
        <div class="ticket-number" id="p-nomor">-</div>
        <div class="ticket-info">العملاء في الانتظار: <strong id="p-waiting">-</strong></div>
        <div class="ticket-info" id="p-time">-</div>
        <div class="ticket-footer">يرجى الانتظار حتى ظهور رقمكم على شاشة العرض</div>
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
                osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.12);
                gain.gain.setValueAtTime(0.4, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.4);
                osc.start();
                osc.stop(ctx.currentTime + 0.45);
            } catch(e) {}
        }

        function issueTicket(id) {
            playChime();

            Swal.fire({
                title: 'جاري طباعة التذكرة...',
                text: 'فضلاً انتظر خروج التذكرة',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            $.ajax({
                url: '/kiosk/ticket/' + id,
                type: 'GET',
                success: function(res) {
                    $('#p-nomor').text(res.nomor);
                    $('#p-loket').text(res.loket);
                    $('#p-waiting').text(res.waiting);
                    $('#p-time').text(res.time);
                    
                    $('#count-' + id).text(res.waiting);

                    Swal.close();
                    
                    // تأخير بسيط لضمان تحديث النص داخل عنصر الطباعة قبل فتح أمر الطباعة
                    setTimeout(function() {
                        window.print();
                    }, 200);

                    Swal.fire({
                        icon: 'success',
                        title: 'رقمك: ' + res.nomor,
                        html: '<p class="mb-1">القسم: <b>' + res.loket + '</b></p><p>أمامك في الانتظار: <b>' + res.waiting + '</b> مراجع</p>',
                        timer: 3500,
                        showConfirmButton: false
                    });
                },
                error: function(xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                    Swal.fire('خطأ', 'تعذر إصدار التذكرة، يرجى المحاولة ثانية', 'error');
                }
            });
        }
    </script>
</body>
</html>
