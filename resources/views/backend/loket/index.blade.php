@extends('layouts.backend.master')

@section('title')
    إدارة شبابيك الخدمة
@endsection

@section('styles')
<style>
    .window-card {
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
    }

    .window-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15, 118, 110, 0.08);
        border-color: #cbd5e1;
    }

    .window-code-badge {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0f766e 0%, #0d5f57 100%);
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 1.8rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.03);
    }

    .form-control, .form-select {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e2e8f0;
        font-size: 0.95rem;
        color: #1e293b;
        background-color: #f8fafc;
    }

    .form-control:focus, .form-select:focus {
        background-color: #ffffff;
        border-color: #0f766e;
        box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
    }

    .btn-brand-primary {
        background: linear-gradient(135deg, #0f766e 0%, #0d5f57 100%);
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 700;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(15, 118, 110, 0.25);
        transition: all 0.2s ease;
    }

    .btn-brand-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(15, 118, 110, 0.35);
        color: #ffffff;
    }

    .empty-state {
        border: 2px dashed #cbd5e1;
        border-radius: 22px;
        background: #ffffff;
        padding: 4rem 2rem;
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-display ms-2 text-primary"></i>الشبابيك المسجلة</h5>
            <span class="badge bg-white text-primary border px-3 py-2 rounded-pill fw-bold">العدد الإجمالي: {{ count($data) }}</span>
        </div>

        <div class="row g-3">
            @forelse ($data as $item)
                <div class="col-md-6">
                    <div class="card window-card h-100 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="window-code-badge">{{ $item->kode }}</div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $item->tujuan }}</h6>
                                    <span class="text-muted small">المسؤول: <strong>{{ $item->user->name }}</strong></span>
                                </div>
                            </div>
                            @if($item->status == true)
                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1">مفعّل</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary px-2 py-1">معطل</span>
                            @endif
                        </div>

                        <form action="{{ route('v1.loket.destroy') }}" id="delete-form-{{ $item->id }}" method="POST">
                            @csrf @method('DELETE')
                            <input type="hidden" name="loket" value="{{ $item->id }}">
                        </form>

                        <form action="{{ route('v1.loket.update') }}" method="POST" class="border-top pt-3 mt-2">
                            @csrf @method('PATCH')
                            <input type="hidden" name="loket" value="{{ $item->id }}">

                            <div class="mb-2">
                                <label class="small text-muted mb-1">تغيير الموظف المسؤول:</label>
                                <select class="form-select form-select-sm" name="user_id">
                                    @foreach ($user as $usrs)
                                        <option value="{{ $usrs->id }}" {{ $item->user_id == $usrs->id ? 'selected' : '' }}>
                                            {{ $usrs->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="small text-muted">حالة الشباك:</span>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" name="status" value="true" {{ $item->status == true ? 'checked' : '' }}>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-outline-danger btn-sm deleteBtn" data-id="{{ $item->id }}">
                                    <i class="bi bi-trash ms-1"></i>حذف
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-check2 ms-1"></i>تحديث
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-display text-muted" style="font-size: 3.5rem;"></i>
                        <h5 class="fw-bold text-dark mt-3">لا توجد شبابيك مسجلة حالياً</h5>
                        <p class="text-muted small mb-0">يرجى إضافة أول شباك خدمة من النموذج الجانبي لتظهر الأرقام بالشاشة.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-panel">
            <h5 class="fw-bold text-dark mb-1"><i class="bi bi-plus-circle ms-2 text-primary"></i>إضافة شباك جديد</h5>
            <p class="text-muted small mb-4">تهيئة منافذ الخدمة ومسؤوليها</p>

            <form action="{{ route('v1.loket.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark">اسم الشباك</label>
                    <input type="text" class="form-control" name="title" placeholder="مثال: خدمة المستفيدين 1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark">رمز الشباك</label>
                    <input type="text" maxlength="2" class="form-control" name="kode" placeholder="مثال: A أو B" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-dark">الموظف المسؤول</label>
                    <select class="form-select" name="user" required>
                        <option value="" selected disabled>اختر الموظف...</option>
                        @foreach ($user as $usr)
                            <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                    <span class="small fw-bold text-dark">تفعيل فوري للشباك</span>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" name="status" value="true" checked>
                    </div>
                </div>

                <button type="submit" class="btn btn-brand-primary w-100">
                    <i class="bi bi-check-circle ms-2"></i>حفظ وإضافة الشباك
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.deleteBtn').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'هل تريد حذف هذا الشباك؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f766e',
            cancelButtonColor: '#dc2626',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-' + id).submit();
            }
        });
    });
</script>
@endsection
