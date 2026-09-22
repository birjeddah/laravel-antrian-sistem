<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>شاشة العرض | جمعية البر بجدة</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        
        body {
            background: linear-gradient(135deg, #022c22, #064e3b, #047857, #0f172a);
            background-size: 400% 400%;
            animation: royalGradient 20s ease infinite;
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            color: #ffffff;
            overflow: hidden; /* منع التمرير في شاشة التلفزيون */
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        @keyframes royalGradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* الشريط العلوي الفاخر */
        .header-bar {
            background: rgba(2, 44, 34, 0.75);
            backdrop-filter: blur(15px);
            border-bottom: 2px solid rgba(251, 191, 36, 0.3);
            border-radius: 25px;
            padding: 1.5rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        .system-title-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-logo {
            height: 85px;
            object-fit: contain;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,0.5));
        }

        .system-title h1 {
            font-size: 2.2rem;
            font-weight: 900;
            color: #ffffff;
            margin: 0;
            text-shadow: 0 2px 10px rgba(0,0,0,0.4);
        }

        .system-title p {
            color: #a7f3d0;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }

        .clock-container {
            text-align: left;
            direction: ltr;
        }

        #clock {
            font-family: 'Outfit', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: #fbbf24;
            line-height: 1;
            text-shadow: 0 0 20px rgba(251, 191, 36, 0.3);
        }

        #day {
            font-size: 1.2rem;
            color: #e2e8f0;
            font-weight: 700;
            direction: rtl;
        }

        /* منطقة المحتوى الأوسط */
        .middle-section {
            flex: 1;
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .banner-container {
            flex: 3;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(16, 185, 129, 0.2);
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: inset 0 0 50px rgba(0,0,0,0.3);
            padding: 2rem;
        }

        .banner-container h2 {
            font-size: 4rem;
            font-weight: 900;
            color: #34d399;
            margin-bottom: 1.5rem;
            text-shadow: 0 5px 15px rgba(0,0,0,0.4);
        }

        .banner-container p {
            font-size: 2rem;
            font-weight: 700;
            color: #e2e8f0;
            line-height: 1.6;
        }

        .timing-box {
            flex: 1;
            background: linear-gradient(145deg, #064e3b, #022c22);
            border: 2px solid rgba(251, 191, 36, 0.4);
            border-radius: 30px;
            padding: 2.5rem 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }

        .timing-box h4 {
            font-size: 1.6rem;
            color: #a7f3d0;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .timing-box h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            color: #ffffff;
            margin-bottom: 1.5rem;
        }

        .timing-box hr {
            width: 70%;
            border-color: rgba(251, 191, 36, 0.3);
            margin: 1rem 0 2rem;
        }

        /* شريط الأخبار السفلي */
        .ticker-strip {
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 1rem 2rem;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fbbf24;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        /* شبكة أرقام الانتظار */
        .queue-grid {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
        }

        .queue-box {
            flex: 1;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border: 3px solid rgba(16, 185, 129, 0.3);
            border-radius: 30px;
            padding: 2.5rem 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.4s ease;
        }

        .queue-box::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 8px;
            background: linear-gradient(90deg, #10b981, #38bdf8);
        }

        /* أنيميشن النداء القوي */
        .queue-box.active-call {
            background: rgba(2, 44, 34, 0.95);
            border-color: #fbbf24;
            transform: scale(1.05);
            animation: royalPulse 1s infinite alternate;
            z-index: 10;
        }

        @keyframes royalPulse {
            0% { box-shadow: 0 0 20px rgba(251, 191, 36, 0.4); }
            100% { box-shadow: 0 0 60px rgba(251, 191, 36, 0.8), inset 0 0 20px rgba(251, 191, 36, 0.2); }
        }

        .queue-label {
            color: #94a3b8;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .queue-number-value {
            font-family: 'Outfit', sans-serif;
            font-size: 7.5rem; /* تكبير الرقم ليكون مرئي جداً */
            font-weight: 900;
            color: #ffffff;
            line-height: 1;
            margin-bottom: 1.5rem;
            letter-spacing: 2px;
            text-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .active-call .queue-number-value {
            color: #fbbf24;
            text-shadow: 0 0 30px rgba(251, 191, 36, 0.6);
        }

        .queue-window-title {
            display: inline-block;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 2px solid rgba(16, 185, 129, 0.3);
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            font-weight: 800;
            font-size: 1.6rem;
        }

        .active-call .queue-window-title {
            background: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border-color: #fbbf24;
        }
    </style>
</head>

<body>
    <!-- الشريط العلوي الفاخر -->
    <header class="header-bar">
        <div class="system-title-container">
            <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="شعار الجمعية" class="header-logo">
            <div class="system-title">
                <h1>جمعية البر بجدة</h1>
                <p>إدارة صالة خدمة المستفيدين</p>
            </div>
        </div>
        <div class="clock-container">
            <div id="clock">00:00</div>
            <div id="day">يتم التحميل...</div>
        </div>
    </header>

    <!-- منطقة المحتوى الأوسط (ترحيب + أوقات عمل) -->
    <div class="middle-section">
        <div class="banner-container">
            <h2>نسعد بخدمتكم ونعتز بثقتكم</h2>
            <p>يرجى متابعة شاشة العرض لحين استدعاء رقم تذكرتكم والتوجه للشباك المحدد مباشرة.</p>
        </div>
        
        <div class="timing-box">
            <h4>بداية الاستقبال</h4>
            <h3>08:00 ص</h3>
            <hr>
            <h4>نهاية الخدمة</h4>
            <h3>04:00 م</h3>
        </div>
    </div>

    <!-- شريط الإعلانات أو التنبيهات المتحرك -->
    <div class="ticker-strip">
        <i class="fas fa-bell"></i>
        <marquee direction="right" scrollamount="8">
            أهلاً بكم ضيوف جمعية البر بجدة.. يرجى تجهيز الأوراق المطلوبة والهوية الوطنية عند مناداة رقمكم لاختصار وقتكم الثمين.
        </marquee>
    </div>

    <!-- شبكة الشبابيك والأرقام (بكود محمي ضد الأخطاء) -->
    <div class="queue-grid">
        <?php if (!empty($data)): ?>
            <?php foreach ($data as$item): ?>
                <div class="queue-box" id="card-<?php echo $item->id; ?>">
                    <div class="queue-label">رقم الانتظار</div>
                    <div class="queue-number-value" id="nomor-<?php echo $item->id; ?>">---</div>
                    <div class="queue-window-title">
                        <i class="fas fa-desktop ms-2"></i>
                        <?php echo htmlspecialchars($item->tujuan); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        // تحديث الساعة
        function updateClock() {
            const now = new Date();
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            let h = now.getHours().toString().padStart(2, '0');
            let m = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('clock').textContent = `${h}:${m}`;
            document.getElementById('day').textContent = now.toLocaleDateString('ar-SA', dateOptions);
        }
        setInterval(updateClock, 1000);
        updateClock();

        // نظام النطق الآلي
        function speakTicket(text) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                let msg = new SpeechSynthesisUtterance(text);
                msg.lang = 'ar-SA';
                msg.rate = 0.80; // سرعة نطق مناسبة وواضحة
                msg.pitch = 1.0;
                let voices = window.speechSynthesis.getVoices();
                let arVoice = voices.find(v => v.lang.includes('ar'));
                if (arVoice) msg.voice = arVoice;
                window.speechSynthesis.speak(msg);
            }
        }

        // جلب البيانات بشكل محمي
        let loketData = <?php echo json_encode(array_map(function($d) {
            return ['id' => $d->id, 'title' =>$d->tujuan];
        }, (isset($data) && count($data)) ?$data->all() : [])); ?>;

        let previousNumbers = {};

        $(document).ready(function() {$.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            setInterval(function() {
                if (!loketData || loketData.length === 0) return;

                loketData.forEach(function(item) {
                    $.ajax({
                        data: { nomor: item.id },
                        url: "/",
                        type: "POST",
                        dataType: 'json',
                        success: function(newNumber) {
                            if (newNumber && newNumber.toString().trim() !== '') {
                                let currentElem = $('#nomor-' + item.id);
                                let oldVal = currentElem.text().trim();

                                if (oldVal !== newNumber.toString().trim()) {
                                    currentElem.html(newNumber);

                                    // إذا لم يكن هذا هو التحميل الأول للصفحة
                                    if (previousNumbers[item.id] !== undefined && previousNumbers[item.id] !== newNumber) {
                                        let card = $('#card-' + item.id);
                                        
                                        // إضافة كلاس التميز والوميض
                                        card.addClass('active-call');
                                        
                                        // النطق
                                        speakTicket("الرقم " + newNumber + "، يرجى التوجه إلى " + item.title);
                                        
                                        // إزالة الوميض بعد 8 ثواني
                                        setTimeout(() => card.removeClass('active-call'), 8000);
                                    }
                                    previousNumbers[item.id] = newNumber;
                                }
                            }
                        }
                    });
                });
            }, 1500);
        });
    </script>
</body>
</html>
