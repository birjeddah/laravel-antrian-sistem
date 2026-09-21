@extends('layouts.backend.master')

@section('title')
    إدارة الشبابيك
@endsection

@section('styles')
<style>
    .loket-card {
        border-radius: 20px !important;
        border: 1px solid rgba(226, 232, 240, 0.8) !important;
        background: #ffffff !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        position: relative;
        overflow: hidden;
    }

    .loket-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(13, 95, 87, 0.12), 0 8px 10px -6px rgba(13, 95, 87, 0.08) !important;
    }

    .loket-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 5px;
        background: linear-gradient(90deg, #0d5f57, #10b981);
    }

    .code-badge {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0d5f57 0%, #064e3b 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(13, 95, 87, 0.25);
    }

    .form-card {
        border-radius: 24px !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05) !important;
    }

    .form-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.5rem 1.8rem 1rem;
    }

    .form-control, .form-select {
        border-radius: 12px !important;
        padding: 0.75rem 1rem !important;
        border: 1.5px solid #e2e8f0 !important;
        font-size: 0.95rem !important;
        transition: all 0.25s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d5f57 !important;
        box-shadow: 0 0 0 4px rgba(13, 95, 87, 0.1) !important;
    }

    .empty-box {
        border: 2px dashed #cbd5e1;
        border-radius: 24px;
        background: #f8fafc;
        padding: 3rem 1.5rem;
    }

    .status-pill {
        font-size: 0.8rem;
        padding: 0.35rem 0.8rem;
        border-radius: 50px;
        font-weight: 600;
    }

    .btn-update {
        background: #f0fdfa;
        color: #0d5f57;
        border: 1px solid #ccfbf1;
        font-weight: 600;
        border-radius: 10px;
        padding: 0.45rem 0.9rem;
        transition: all 0.2s ease;
    }

    .btn-update:hover {
        background: #0d5f57;
        color: #ffffff;
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        font-weight: 600;
        border-radius: 10px;
        padding: 0.45rem 0.9rem;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
    }
</style>
@endsection

@section('content')
    <section class="row">
        <!-- قسم قائمة الشبابيك المسجلة -->
        <div class="col-lg-8 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-display ms-2 text-primary"></i>الشبابيك المفعلة حالياً
                </h5>
                <span class="badge bg-light-primary text-primary px-3 py-2 rounded-pill fw-semibold">
                    إجمالي الشبابيك: {{ count($data) }}
                </span>
            </div>

            <div class="row">
                @forelse ($data as $item)
                    <div class="col-md-6 mb-4">
                        <div class="card loket-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="code-badge">
                                            {{ $item->kode }}
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-1 text-dark">{{ $item->tujuan }}</h5>
                                            <span class="text-muted small">الموظف: <strong>{{ $item->user->name }}</strong></span>
                                        </div>
                                    </div>
                                    @if($item->status == true)
                                        <span class="status-pill bg-success-subtle text-success border border-success-subtle">
                                            <i class="bi bi-check-circle ms-1"></i>مفعّل
                                        </span>
                                    @else
                                        <span class="status-pill bg-secondary-subtle text-secondary border border-secondary-subtle">
                                            <i class="bi bi-dash-circle ms-1"></i>معطّل
                                        </span>
                                    @endif
                                </div>

                                <form action="{{ route('v1.loket.destroy') }}" id="delete-form-{{ $item->id }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="text" hidden name="loket" value="{{ $item->id }}">
                                </form>

                                <form action="{{ route('v1.loket.update') }}" method="POST" class="mt-3 pt-3 border-top">
                                    @csrf @method('PATCH')
                                    <input type="text" name="loket" hidden value="{{ $item->id }}">

                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold text-muted mb-1">تعيين موظف آخر للشباك:</label>
                                        <select class="form-select form-select-sm" name="user_id">
                                            @foreach ($user as $usrs)
                                                <option value="{{ $usrs->id }}" {{ $item->user_id == $usrs->id ? 'selected' : '' }}>
                                                    {{ $usrs->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="small fw-semibold text-muted">حالة الشباك:</span>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input cursor-pointer" type="checkbox" name="status"
                                                value="true" id="switchStatus{{ $item->id }}"
                                                {{ $item->status == true ? 'checked' : '' }}>
                                            <label class="form-check-label small fw-bold" for="switchStatus{{ $item->id }}">
                                                {{ $item->status == true ? 'نشط' : 'إيقاف' }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-end pt-2">
                                        <button type="button" class="btn btn-delete btn-sm deleteBtn" data-id="{{ $item->id }}">
                                            <i class="bi bi-trash ms-1"></i>حذف
                                        </button>
                                        <button type="submit" class="btn btn-update btn-sm">
                                            <i class="bi bi-check2-circle ms-1"></i>تحديث البيانات
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-box text-center">
                            <div class="mb-3">
                                <i class="bi bi-layers text-muted opacity-50" style="font-size: 3.5rem;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">لا توجد شبابيك خدمة مسجلة</h5>
                            <p class="text-muted small mb-0">قم بإضافة وتفعيل أول شباك خدمة من النموذج الجانبي لبدء استقبال المراجعين.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- نموذج إضافة شباك جديد -->
        <div class="col-lg-4">
            <div class="card form-card sticky-top" style="top: 2rem;">
                <div class="card-header">
                    <h5 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-plus-circle-fill text-primary ms-2"></i>إضافة شباك خدمة جديد
                    </h5>
                    <p class="text-muted small mb-0 mt-1">تحديد مسمى الشباك ورمزه والموظف المكلّف</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('v1.loket.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">اسم الشباك</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" name="title" placeholder="مثال: شباك 1 أو خدمة المستفيدين">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">رمز الشباك (حرف أو رقم)</label>
                            <input type="text" maxlength="2" class="form-control @error('kode') is-invalid @enderror"
                                name="kode" value="{{ old('kode') }}" placeholder="مثال: A أو B">
                            @error('kode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-dark mb-1">الموظف المسؤول (PJ Loket)</label>
                            <select class="form-select @error('user') is-invalid @enderror" name="user">
                                <option value="" selected disabled>اختر الموظف المسؤول...</option>
                                @foreach ($user as $usr)
                                    <option value="{{ $usr->id }}" {{ old('user') == $usr->id ? 'selected' : '' }}>
                                        {{ $usr->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4 p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-block fw-semibold small text-dark">حالة التفعيل الفوري</span>
                                <span class="text-muted" style="font-size: 0.78rem;">هل ترغب بظهور الشباك في شاشة العرض الآن؟</span>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input cursor-pointer" type="checkbox" name="status" value="true" checked id="statusSwitch">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2 fw-bold">
                                <i class="bi bi-cloud-arrow-up ms-2"></i>حفظ وإضافة الشباك
                            </button>
                            <button type="reset" class="btn btn-light text-muted py-2">
                                تفريغ الحقول
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.deleteBtn').click(function(event) {
            var id = $(this).attr('data-id');
            var form = $('#delete-form-' + id);
            event.preventDefault();

            Swal.fire({
                title: 'هل أنت متأكد من الحذف؟',
                text: "سيتم حذف شباك الخدمة نهائياً من النظام وشاشة العرض!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d5f57',
                cancelButtonColor: '#dc2626',
                confirmButtonText: 'نعم، قم بالحذف',
                cancelButtonText: 'إلغاء الأمر',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
