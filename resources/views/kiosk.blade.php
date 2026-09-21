<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>بوابة الخدمة الذاتية | جمعية البر بجدة</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;600;700&family=Outfit:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
    
    <!-- مكتبة التنبيهات المنبثقة -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #fff;
        }

        .header-title {
            text-align: center;
            padding: 3rem 1rem;
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .header-title h1 {
            font-weight: 700;
            color: #38bdf8;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .header-title p {
            font-size: 1.4rem;
            color: #10b981;
            font-weight: 600;
            margin-bottom: 0;
        }

        .departments-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .loket-card {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }

        .loket-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.1);
            border-color: #38bdf8;
            box-shadow: 0 15px 35px rgba(56, 189, 248, 0.2);
        }

        .loket-card i {
            font-size: 4rem;
            color: #38bdf8;
        }

        .loket-card h2 {
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        /* تنسيق الطباعة للطابعة الحرارية 80mm */
        @media print {
            body * { visibility: hidden; }
            #ticket-print-area, #ticket-print-area * { visibility: visible; }
            #ticket-print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 80mm;
                padding: 10px;
                text-align: center;
                color: #000;
                font-family: 'IBM Plex Sans Arabic', sans-serif;
                background: white;
            }
            .ticket-header { font-size: 16px; font-weight: bold; margin-bottom: 5px; }
            .ticket-subtitle { font-size: 12px; margin-bottom: 15px; }
            .ticket-tujuan { font-size: 18px; font-weight: bold; padding: 5px; border-top: 1px dashed #000; border-bottom: 1px dashed #000; margin-bottom: 10px;}
            .ticket-number { font-family: 'Outfit', sans-serif; font-size: 45px; font-weight: 900; margin-bottom: 10px; line-height: 1;}
            .ticket-footer { font-size: 10px; color: #555; }
        }
    </style>
</head>
<body>

    <div class="header-title no-print">
        <h1>بوابة الخدمة الذاتية | جمعية البر بجدة</h1>
        <p>نسعد بخدمتكم ونعتز بثقتكم</p>
    </div>

    <div class="departments-container no-print">
        <div class="container">
            <h4 class="text-center text-white mb-5">الرجاء اختيار القسم المطلوب لسحب التذكرة</h4>
            <div class="row g-4 justify-content-center">
                @foreach($lokets as $loket)
                    <div class="col-md-4 col-lg-3">
                        <div class="loket-card" onclick="printTicket({{ $loket->id }})">
                            <i class="fas fa-hand-pointer"></i>
                            <h2>{{ $loket->tujuan }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- القالب المخفي الذي سيتم طباعته على الطابعة الحرارية -->
    <div id="ticket-print-area" style="display: none;">
        <div class="ticket-header">جمعية البر بجدة</div>
        <div class="ticket-subtitle">نسعد بخدمتكم ونعتز بثقتكم</div>
        <div class="ticket-tujuan" id="print-tujuan">القسم</div>
        <div class="ticket-number" id="print-nomor">A000</div>
        <div class="ticket-footer" id="print-time">التاريخ والوقت</div>
        <div class="ticket-footer" style="margin-top: 10px;">يرجى الانتظار حتى يتم استدعاء رقمك</div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // مؤثر صوتي مميز عند الضغط
        function playChime() {
            try {
                let ctx = new (window.AudioContext || window.webkitAudioContext)();
                let osc = ctx.createOscillator();
                let gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.type = 'sine';
                osc.frequency.setValueAtTime(880, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(1760, ctx.currentTime + 0.15);
                gain.gain.setValueAtTime(0.5, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.5);
                osc.start();
                osc.stop(ctx.currentTime + 0.5);
            } catch(e) {}
        }

        function printTicket(loketId) {
            playChime();
            
            Swal.fire({
                title: 'جاري إصدار التذكرة...',
                html: 'الرجاء الانتظار وسحب التذكرة من الطابعة',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            $.ajax({
                url: '/kiosk/ticket/' + loketId,
                type: 'GET',
                success: function(response) {
                    // تعبئة التذكرة بالبيانات
                    $('#print-nomor').text(response.nomor);
                    $('#print-tujuan').text(response.loket);
                    $('#print-time').text(response.time);
                    
                    // إظهار منطقة الطباعة مؤقتاً للطباعة
                    $('#ticket-print-area').show();
                    
                    Swal.close();
                    
                    // بدء الطباعة
                    window.print();
                    
                    // إخفاء منطقة الطباعة بعد الأمر
                    $('#ticket-print-area').hide();

                    Swal.fire({
                        icon: 'success',
                        title: 'تم سحب التذكرة!',
                        text: 'رقمك هو: ' + response.nomor,
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                error: function() {
                    Swal.fire('خطأ', 'حدث مشكلة أثناء إصدار التذكرة، يرجى المحاولة مرة أخرى', 'error');
                }
            });
        }
    </script>
</body>
</html>
