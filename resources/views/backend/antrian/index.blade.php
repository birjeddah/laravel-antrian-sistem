@extends('layouts.backend.master')

@section('title')
    شاشة نداء الموظف | جمعية البر بجدة
@endsection

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Outfit:wght@800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .employee-panel {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
        }

        /* ترويسة الشاشة وشعار الجمعية */
        .brand-header-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 1.2rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
        }

        .brand-header-info {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .albir-logo {
            height: 65px;
            object-fit: contain;
        }

        /* بطاقة عرض الرقم الملكية */
        .queue-display-card {
            border-radius: 24px !important;
            border: 2px solid rgba(251, 191, 36, 0.4) !important;
            background: linear-gradient(135deg, #022c22 0%, #064e3b 60%, #047857 100%) !important;
            box-shadow: 0 15px 35px rgba(2, 44, 34, 0.25) !important;
            overflow: hidden;
            position: relative;
            color: #ffffff !important;
        }

        .queue-display-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 6px;
            background: linear-gradient(90deg, #10b981, #fbbf24, #38bdf8);
        }

        .antri-number {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 7rem;
            color: #fbbf24;
            letter-spacing: 4px;
            line-height: 1;
            text-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            margin: 1.5rem 0;
        }

        .counter-badge {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.15rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        /* بطاقة التحكم بالأزرار */
        .control-card {
            border-radius: 24px !important;
            border: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
        }

        .btn-call-next {
            background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
            border: none !important;
            border-radius: 18px !important;
            padding: 1.3rem 1.5rem !important;
            font-size: 1.35rem !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            box-shadow: 0 8px 25px rgba(4, 120, 87, 0.35) !important;
            transition: all 0.3s ease !important;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .btn-call-next:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(4, 120, 87, 0.45) !important;
            color: #ffffff !important;
        }

        .btn-call-repeat {
            background: #fffbeb !important;
            color: #92400e !important;
            border: 2px solid #fde68a !important;
            border-radius: 18px !important;
            padding: 1.1rem 1.5rem !important;
            font-size: 1.15rem !important;
            font-weight: 700 !important;
            transition: all 0.25s ease !important;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-call-repeat:hover {
            background: #fef3c7 !important;
            border-color: #f59e0b !important;
            color: #78350f !important;
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
<div class="employee-panel">
    <!-- ترويسة داخلية رسمية بهوية الجمعية -->
    <div class="brand-header-box">
        <div class="brand-header-info">
            <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="شعار جمعية البر بجدة" class="albir-logo">
            <div>
                <h4 class="fw-bold mb-0 text-dark">جمعية البر بجدة</h4>
                <p class="text-muted small mb-0 fw-semibold">صالة خدمة المستفيدين | نافذة نداء المراجعين</p>
            </div>
        </div>
        <div class="d-none d-md-block text-start">
            <span class="badge bg-light text-success border border-success p-2 px-3 rounded-pill fw-bold">
                <i class="fas fa-circle text-success ms-1 small"></i> النظام متصل ونشط
            </span>
        </div>
    </div>

    <div class="row g-4 align-items-stretch">
        <!-- بطاقة الرقم المستدعى حالياً -->
        <div class="col-lg-7">
            <div class="card queue-display-card h-100 text-center">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <span class="text-light opacity-75 fw-bold fs-6">
                        <i class="fas fa-user-check ms-1 text-warning"></i> الرقم قيد الاستقبال حالياً
                    </span>
                </div>
                
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <div class="antri-number">
                        {{ $data ? $data->nomor : '---' }}
                    </div>
                    
                    <div class="counter-badge mt-2">
                        <i class="fas fa-desktop text-warning"></i>
                        <span>{{ $data && $data->loket ? $data->loket->tujuan : 'القسم' }}</span>
                        <span class="opacity-75">| الرمز: {{ $data && $data->loket ? $data->loket->kode : '-' }}</span>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent border-top py-3" style="border-color: rgba(255,255,255,0.15) !important;">
                    <span class="text-light opacity-90 fw-semibold">
                        الموظف المسؤول: <strong class="text-warning">{{ auth()->user()->name }}</strong>
                    </span>
                </div>
            </div>
        </div>

        <!-- لوحة التحكم واستدعاء الرقم التالي -->
        <div class="col-lg-5">
            <div class="card control-card h-100 d-flex flex-column justify-content-between">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-sliders-h ms-2 text-success"></i>لوحة نداء المراجعين
                    </h5>
                    <p class="text-muted small mb-0 mt-1">التحكم في تسلسل الأرقام واستدعاء الشباك</p>
                </div>

                <div class="card-body p-4 d-flex flex-column justify-content-center">
                    <form action="{{ route('v1.antrian.next') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="antrian" value="{{ $data ? $data->nomor : '' }}">
                        <input type="hidden" name="kode" value="{{ $data && $data->loket ? $data->loket->kode : '' }}">
                        <button type="submit" class="btn w-100 btn-call-next">
                            <span>استدعاء الرقم التالي</span>
                            <i class="fas fa-arrow-left-long fs-5"></i>
                        </button>
                    </form>

                    <button type="button" id="ulangi" class="btn w-100 btn-call-repeat">
                        <i class="fas fa-rotate fs-6"></i>
                        <span>إعادة النداء الصوتي</span>
                    </button>
                </div>

                <div class="card-footer bg-light border-0 p-3 m-3 rounded-4 text-center">
                    <p class="small text-muted mb-0 lh-base fw-semibold">
                        <i class="fas fa-circle-info text-success ms-1"></i>
                        عند الضغط على <strong>"استدعاء الرقم التالي"</strong> سيتم تحديث شاشات الصالة فوراً ونطق الرقم صوتياً للمستفيدين.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // تنظيف الواجهة واستبدال شعار القائمة الجانبية وإزالة العبارات الإندونيسية
    $(document).ready(function() {
        let logo = 'https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75';
        
        // استبدال الشعار في القائمة الجانبية
        $('img[alt*="logo"], .brand-image, .sidebar-brand img').attr('src', logo).css({
            'max-height': '55px',
            'width': 'auto',
            'display': 'block',
            'margin': '0 auto'
        });

        // إخفاء العبارة القديمة في الترويسة السابقة
        $('header p, .content-header p').each(function() {
            if ($(this).text().includes('Minum') || $(this).text().includes('Jangan')) {
                $(this).hide();
            }
        });

        // إخفاء حقوق الفوتر السفلية القديمة
        $('footer, .main-footer').hide();
    });

    function playQueueAnnouncement(text) {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();

            let utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'ar-SA';
            utterance.rate = 0.85;
            utterance.pitch = 1.0;

            let voices = window.speechSynthesis.getVoices();
            let arVoice = voices.find(v => v.lang.includes('ar'));
            if (arVoice) {
                utterance.voice = arVoice;
            }

            try {
                let audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                let osc = audioCtx.createOscillator();
                let gain = audioCtx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(587.33, audioCtx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(880, audioCtx.currentTime + 0.15);
                gain.gain.setValueAtTime(0.2, audioCtx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 0.4);
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                osc.start();
                osc.stop(audioCtx.currentTime + 0.45);

                setTimeout(() => {
                    window.speechSynthesis.speak(utterance);
                }, 450);
            } catch (e) {
                window.speechSynthesis.speak(utterance);
            }
        }
    }

    if ('speechSynthesis' in window) {
        window.speechSynthesis.onvoiceschanged = function() {
            window.speechSynthesis.getVoices();
        };
    }

    @if (session('finish') && $data && $data->loket)
        $(document).ready(function() {
            let msg = "الرقم {{ $data->nomor }}، التوجه إلى {{ $data->loket->tujuan }}";
            playQueueAnnouncement(msg);
        });
    @endif

    $('#ulangi').click(function() {
        @if($data && $data->loket)
            let msg = "نكرر النداء، الرقم {{ $data->nomor }}، التوجه إلى {{ $data->loket->tujuan }}";
            playQueueAnnouncement(msg);
        @endif
    });
</script>
@endsection
