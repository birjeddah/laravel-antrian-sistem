@extends('layouts.backend.master')

@section('title')
    إدارة الشبابيك والأقسام
@endsection

@section('content')
    <section class="row">
        <div class="col-md-8">
            <div class="row">
                @forelse ($data as $item)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple mb-2">
                                            <i class="bi bi-door-open"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="text-muted font-semibold">{{ $item->tujuan }}</h6>
                                            <h6 class="text-muted font-semibold">الرمز : {{ $item->kode }}</h6>
                                        </div>
                                        <h6 class="font-extrabold mb-0">{{ $item->user->name }}</h6>
                                    </div>
                                </div>

                                <form action="{{ route('v1.loket.destroy') }}" id="delete-form-{{ $item->id }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <input type="text" hidden name="loket" value="{{ $item->id }}">
                                </form>

                                <form action="{{ route('v1.loket.update') }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="text" name="loket" hidden value="{{ $item->id }}">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>الحالة</td>
                                                <td>:</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            value="true" id="flexSwitchCheckChecked-{{ $item->id }}"
                                                            {{ $item->status == true ? 'checked' : null }}>
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckChecked-{{ $item->id }}">{{ $item->status == true ? 'مفعّل' : 'معطّل' }}</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>المسؤول</td>
                                                <td>:</td>
                                                <td>
                                                    <fieldset class="form-group">
                                                        <select class="form-select" id="basicSelect" name="user_id">
                                                            @foreach ($user as $usrs)
                                                                <option value="{{ $usrs->id }}"
                                                                    {{ $item->user_id == $usrs->id ? 'selected' : null }}>
                                                                    {{ $usrs->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    الإجراء
                                                </td>
                                                <td>:</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                                        data-id="{{ $item->id }}"><i class="bi bi-trash-fill"></i>
                                                        حذف</button>
                                                    <button type="submit" class="btn btn-sm btn-info text-white"><i
                                                            class="bi bi-arrow-up-square-fill"></i> تحديث</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card p-3">
                            <p class="text-center text-muted mb-0">لا توجد شبابيك مسجلة حالياً</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">إضافة شباك جديد</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('v1.loket.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="basicInput" class="mb-2">اسم الشباك / القسم</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" name="title" id="basicInput" placeholder="مثال: الاستقبال أو المالية">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput" class="mb-2">رمز الشباك</label>
                            <input type="text" max="1" class="form-control @error('kode') is-invalid @enderror"
                                name="kode" id="basicInput" placeholder="مثال: A أو 1">
                            @error('kode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput" class="mb-2">الموظف المسؤول</label>
                            <fieldset class="form-group">
                                <select class="form-select @error('user') is-invalid @enderror" value="{{ old('user') }}"
                                    name="user" id="basicSelect">
                                    @foreach ($user as $usr)
                                        <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                    @endforeach
                                </select>
                                @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="true" id="newStatusSwitch">
                                <label class="form-check-label" for="newStatusSwitch">تفعيل الشباك مباشرة</label>
                            </div>
                        </div>
                        <button type="reset" class="btn btn-outline-secondary">إعادة تعيين</button>
                        <button type="submit" class="btn btn-primary">حفظ وإضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // استبدال الشعار في القائمة الجانبية بشعار الجمعية
            let albirLogo = 'https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75';
            $('img[alt*="logo"], .sidebar-brand img, .brand-image, .app-brand img').attr('src', albirLogo).css({
                'max-height': '55px',
                'width': 'auto',
                'display': 'block',
                'margin': '0 auto'
            });

            // إخفاء عبارة القهوة الإندونيسية القديمة إن ظهرت
            $('p, h1, h2, header').each(function() {
                if ($(this).text().includes('Minum') || $(this).text().includes('Jangan')) {
                    $(this).hide();
                }
            });

            // إخفاء الفوتر الإندونيسي
            $('footer, .main-footer').hide();
        });

        $('.deleteBtn').click(function(event) {
            var id = $(this).attr('data-id');
            var title = '#delete-form-' + id;
            var form = $(title).closest("form");
            event.preventDefault();

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من استعادة هذا الشباك بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
