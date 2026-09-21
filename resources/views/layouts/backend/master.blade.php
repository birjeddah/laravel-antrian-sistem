<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - لوحة الإدارة</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Outfit:wght@700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --sidebar-w: 270px;
            --primary-color: #0f766e;
            --bg-color: #f8fafc;
        }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
            background-color: var(--bg-color) !important;
            margin: 0;
            color: #1e293b;
        }

        #sidebar {
            width: var(--sidebar-w);
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            background: #ffffff;
            border-left: 1px solid #e2e8f0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.03);
        }

        #main-area {
            margin-right: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2rem 2.5rem;
        }

        @media (max-width: 991.98px) {
            #sidebar {
                right: -100%;
                transition: 0.3s ease;
            }
            #sidebar.active-mobile {
                right: 0;
            }
            #main-area {
                margin-right: 0;
                padding: 1.2rem;
            }
        }

        .sidebar-brand {
            padding: 1.8rem 1.4rem;
            border-bottom: 1px solid #f1f5f9;
            text-align: center;
        }

        .sidebar-brand img {
            max-height: 52px;
            max-width: 100%;
            object-fit: contain;
        }

        .sidebar-links {
            list-style: none;
            padding: 1rem 0.8rem;
            margin: 0;
            flex-grow: 1;
        }

        .nav-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #94a3b8;
            padding: 1rem 1rem 0.4rem;
            text-transform: uppercase;
        }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 1.1rem;
            border-radius: 12px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }

        .nav-item-link i {
            font-size: 1.2rem;
            color: #64748b;
        }

        .nav-item-link:hover {
            background-color: #f0fdfa;
            color: var(--primary-color);
        }

        .nav-item-link:hover i {
            color: var(--primary-color);
        }

        .nav-li.active .nav-item-link {
            background: linear-gradient(135deg, #0f766e 0%, #0d5f57 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(15, 118, 110, 0.25);
        }

        .nav-li.active .nav-item-link i {
            color: #ffffff;
        }

        .top-navbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 1.2rem 1.8rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        }
    </style>

    @yield('styles')
</head>

<body>
    <aside id="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('v1') }}">
                <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" alt="الشعار">
            </a>
        </div>

        <ul class="sidebar-links">
            <li class="nav-label">الرئيسية</li>
            <li class="nav-li {{ request()->is('v1') ? 'active' : '' }}">
                <a href="{{ route('v1') }}" class="nav-item-link">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>لوحة التحكم</span>
                </a>
            </li>

            <li class="nav-label">إدارة الانتظار</li>
            <li class="nav-li {{ request()->is('v1/antrian*') ? 'active' : '' }}">
                <a href="{{ route('v1.antrian') }}" class="nav-item-link">
                    <i class="bi bi-megaphone-fill"></i>
                    <span>شاشة نداء الموظف</span>
                </a>
            </li>
            <li class="nav-li">
                <a href="{{ url('/') }}" target="_blank" class="nav-item-link">
                    <i class="bi bi-tv-fill"></i>
                    <span>شاشة العرض (التلفزيون)</span>
                </a>
            </li>

            <li class="nav-label">الإعدادات</li>
            <li class="nav-li {{ request()->is('v1/loket*') ? 'active' : '' }}">
                <a href="{{ route('v1.loket') }}" class="nav-item-link">
                    <i class="bi bi-display-fill"></i>
                    <span>إدارة الشبابيك</span>
                </a>
            </li>

            <li class="nav-label">الجلسة</li>
            <li class="nav-li">
                <a href="#" class="nav-item-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right text-danger"></i>
                    <span>تسجيل الخروج</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </aside>

    <div id="main-area">
        <main>
            <div class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1 text-dark">@yield('title')</h4>
                    <p class="text-muted small mb-0">نظام إدارة صالة الانتظار وخدمة المستفيدين</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-start">
                        <span class="d-block fw-bold small text-dark">{{ auth()->user()->name }}</span>
                        <span class="badge bg-light text-primary border px-2 py-1">مشرف النظام</span>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>

        <footer class="mt-4 pt-3 border-top d-flex justify-content-between text-muted small">
            <div>جميع الحقوق محفوظة &copy; {{ date('Y') }}</div>
            <div class="fw-semibold text-primary">جمعية البر بجدة</div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'عملية ناجحة',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#0f766e',
                confirmButtonText: 'حسناً'
            });
        </script>
    @endif

    @yield('scripts')
</body>

</html>
