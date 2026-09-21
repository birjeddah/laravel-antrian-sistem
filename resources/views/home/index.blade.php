<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>شاشة الانتظار | صالة المستفيدين</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@500;600;700;800&family=Outfit:wght@800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body {
            background-color: #0f172a;
            color: #f8fafc;
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            min-height: 100vh;
            padding: 1.5rem;
            overflow-x: hidden;
        }

        .header-bar {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 20px;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        .system-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #38bdf8;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .clock-container {
            text-align: left;
            direction: ltr;
        }

        #clock {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: #10b981;
            line-height: 1;
        }

        #day {
            font-size: 1rem;
            color: #94a3b8;
            font-weight: 600;
            direction: rtl;
        }

        .banner-container {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border: 1px solid #334155;
            border-radius: 20px;
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .timing-box {
            background: linear-gradient(145deg, #0f766e, #0d5f57);
            border-radius: 20px;
            padding: 1.8rem;
            color: #ffffff;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            box-shadow: 0 10px 30px rgba(15, 118, 110, 0.25);
            border: 1px solid #14b8a6;
        }

        .timing-box h4 {
            font-size: 1.2rem;
            color: #ccfbf1;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .timing-box h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .timing-box hr {
            border-color: rgba(255, 255, 255, 0.2);
            margin: 0.6rem 0 1rem;
        }

        .ticker-strip {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 0.8rem 1.5rem;
            color: #f1f5f9;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 1.5rem 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .ticker-strip i {
            color: #f59e0b;
            font-size: 1.4rem;
        }

        .queue-box {
            background: #1e293b;
            border: 2px solid #334155;
            border-radius: 24px;
            padding: 1.8rem 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .queue-box.active-call {
            border-color: #10b981;
            animation: pulse-border 1.5s infinite;
        }

        @keyframes pulse-border {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6); }
            70% { box-shadow: 0 0 0 18px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        .queue-box::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 6px;
            background: linear-gradient(90deg, #0ea5e9, #10b981);
        }

        .queue-label {
            color: #94a3b8;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .queue-number-value {
            font-family: 'Outfit', sans-serif;
            font-size: 4.8rem;
            font-weight: 900;
            color: #38bdf8;
            line-height: 1.1;
            margin-bottom: 0.8rem;
            letter-spacing: 2px;
            text-shadow: 0 0 25px rgba(56, 189, 248, 0.2);
        }

        .queue-window-title {
            display: inline-block;
            background: #0f172a;
            color: #f8fafc;
            border: 1px solid #475569;
            padding: 0.5rem 1.6rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.15rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid px-3">
        <header class="header-bar">
            <div class="system-title">
                <i class="fas fa-users-cog text-primary"></i>
                <span>نظام إدارة الانتظار وخدمة المستفيدين</span>
            </div>
            <div class="clock-container">
                <div id="clock">00:00:00</div>
                <div id="day">يتم التحميل...</div>
            </div>
        </header>

        <div class="row g-4 mb-3 align-items-stretch">
            <div class="col-lg-9">
                <div class="banner-container">
                    <h2 class="fw-bold mb-3 text-white">مرحباً بكم في صالة خدمة المستفيدين</h2>
                    <p class="fs-5 text-light opacity-75 mb-0">نسعد بخدمتكم وتلبية استفساراتكم. يرجى متابعة شاشة العرض لحين استدعاء رقم تذكرتكم والتوجه للشباك المحدد مباشرة.</p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="timing-box">
                    <h4>بداية الاستقبال</h4>
                    <h3>08:00 ص</h3>
                    <hr>
                    <h4>نهاية الخدمة</h4>
                    <h3>04:00 م</h3>
                </div>
            </div>
        </div>

        <div class="ticker-strip">
            <i class="fas fa-bullhorn"></i>
            <marquee direction="right" scrollamount="6">
                نسعد بخدمتكم.. يرجى تجهيز الأوراق المطلوبة والهوية الوطنية أو الإقامة عند مناداة رقمكم للتوجه إلى الشباك الموضح.
            </marquee>
        </div>

        <div class="row g-4 queue-grid">
            @foreach ($data as$item)
                <div class="col-md-6 col-lg-3">
                    <div class="queue-box" id="card-{{ $item->id }}">
                        <div class="queue-label">رقم الانتظار</div>
                        <div class="queue-number-value" id="nomor-{{ $item->id }}">---</div>
                        <div class="queue-window-title">
                            <i class="fas fa-desktop ms-1 text-info"></i>
                            {{ $item->tujuan }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function updateClock() {
            const now = new Date();
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            let h = now.getHours().toString().padStart(2, '0');
            let m = now.getMinutes().toString().padStart(2, '0');
            let s = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').textContent = `${h}:${m}:${s}`;
            document.getElementById('day').textContent = now.toLocaleDateString('ar-SA', dateOptions);
        }
        setInterval(updateClock, 1000);
        updateClock();

        function speakTicket(text) {
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                let msg = new SpeechSynthesisUtterance(text);
                msg.lang = 'ar-SA';
                msg.rate = 0.85;
                msg.pitch = 1.0;
                let voices = window.speechSynthesis.getVoices();
                let arVoice = voices.find(v => v.lang.includes('ar'));
                if (arVoice) msg.voice = arVoice;
                window.speechSynthesis.speak(msg);
            }
        }

        let loketData = [
            @foreach ($data as$d)
                { id: "{{ $d->id }}", title: "{{ $d->tujuan }}" },
            @endforeach
        ];

        let previousNumbers = {};

        $(document).ready(function() {$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setInterval(function() {
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

                                    if (previousNumbers[item.id] !== undefined && previousNumbers[item.id] !== newNumber) {
                                        let card = $('#card-' + item.id);
                                        card.addClass('active-call');
                                        setTimeout(() => card.removeClass('active-call'), 6000);
                                        speakTicket("الرقم " + newNumber + "، التوجه إلى " + item.title);
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
