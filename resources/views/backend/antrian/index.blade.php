@extends('layouts.backend.master')

@section('title')
    شاشة نداء الموظف
@endsection

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@500;600;700&family=Outfit:wght@800;900&display=swap" rel="stylesheet">
    <style>
        .queue-display-card {
            border-radius: 24px !important;
            border: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
            overflow: hidden;
            position: relative;
        }

        .queue-display-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 6px;
            background: linear-gradient(90deg, #0f766e, #10b981);
        }

        .antri-number {
            font-family: 'Outfit', sans-serif;
            font-weight: 900;
            font-size: 6.5rem;
            color: #0f766e;
            letter-spacing: 4px;
            line-height: 1.1;
            text-shadow: 0 8px 25px rgba(15, 118, 110, 0.15);
            margin: 1.5rem 0;
        }

        .control-card {
            border-radius: 24px !important;
            border: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
        }

        .btn-call-next {
            background: linear-gradient(135deg, #0f766e 0%, #0d5f57 100%) !important;
            border: none !important;
            border-radius: 16px !important;
            padding: 1.2rem 1.5rem !important;
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(15, 118, 110, 0.28) !important;
            transition: all 0.25s ease !important;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .btn-call-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(15, 118, 110, 0.38) !important;
            color: #ffffff !important;
        }

        .btn-call-repeat {
            background: #fffbeb !important;
            color: #b45309 !important;
            border: 1.5px solid #fde68a !important;
            border-radius: 16px !important;
            padding: 1rem 1.5rem !important;
            font-size: 1.05rem !important;
            font-weight: 700 !important;
            transition: all 0.25s ease !important;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-call-repeat:hover {
            background: #fef3c7 !important;
            color: #92400e !important;
            transform: translateY(-2px);
        }

        .counter-badge {
            background: #f0fdfa;
            color: #0f766e;
            border: 1px solid #ccfbf1;
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="row g-4 align-items-stretch">
        <div class="col-lg-7">
            <div class="card queue-display-card h-100 text-center">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <span class="text-muted fw-semibold small">
                        <i class="bi bi-person-check ms-1 text-primary"></i> الرقم قيد الاستقبال حالياً
                    </span>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-4">
                    <div class="antri-number">
                        {{ $data->nomor }}
                    </div>
                    <div class="counter-badge mt-2">
                        <i class="bi bi-display"></i>
                        <span>{{ $data->loket->tujuan }}</span>
                        <span class="text-muted opacity-75">| الرمز: {{ $data->loket->kode }}</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top py-3">
                    <span class="text-muted small">
                        الموظف المسؤول: <strong>{{ auth()->user()->name }}</strong>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card control-card h-100 d-flex flex-column justify-content-between">
                <div class="card-header bg-transparent border-bottom py-3">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-sliders ms-2 text-primary"></i>لوحة نداء المراجعين
                    </h5>
                    <p class="text-muted small mb-0 mt-1">التحكم في تسلسل الأرقام واستدعاء الشباك</p>
                </div>

                <div class="card-body p-4 d-flex flex-column justify-content-center">
                    <form action="{{ route('v1.antrian.next') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="antrian" value="{{ $data->nomor }}">
                        <input type="hidden" name="kode" value="{{ $data->loket->kode }}">
                        <button type="submit" class="btn w-100 btn-call-next">
                            <span>استدعاء الرقم التالي</span>
                            <i class="bi bi-arrow-left-circle-fill fs-4"></i>
                        </button>
                    </form>

                    <button type="button" id="ulangi" class="btn w-100 btn-call-repeat">
                        <i class="bi bi-arrow-repeat fs-5"></i>
                        <span>إعادة النداء الصوتي</span>
                    </button>
                </div>

                <div class="card-footer bg-light border-0 p-3 m-3 rounded-3 text-center">
                    <p class="small text-muted mb-0 lh-base">
                        <i class="bi bi-info-circle text-primary ms-1"></i>
                        عند الضغط على <strong>"استدعاء الرقم التالي"</strong> سيتم تحديث شاشة التلفزيون الصالة فوراً ونطق الرقم صوتياً.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>
    @if (session('finish'))
        <script>
            $(document).ready(function() {
                responsiveVoice.speak(
                    "الرقم، " + "{{ $data->nomor }}" + "، التوجه إلى، " + "{{ $data->loket->tujuan }}",
                    "Arabic Female", {
                        rate: 0.85,
                        pitch: 1,
                        volume: 1
                    }
                );
            });
        </script>
    @endif
    <script>
        $('#ulangi').click(function() {
            responsiveVoice.speak(
                "نكرر النداء، الرقم، " + "{{ $data->nomor }}" + "، التوجه إلى، " + "{{ $data->loket->tujuan }}",
                "Arabic Female", {
                    rate: 0.85,
                    pitch: 1,
                    volume: 1
                }
            );
        });
    </script>
@endsection
