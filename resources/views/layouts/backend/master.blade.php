<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | نظام إدارة الانتظار والخدمات</title>

    <!-- Google Fonts: IBM Plex Sans Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0d5f57 0%, #064e3b 100%);
            --accent-gold: #d97706;
            --surface-bg: #f8fafc;
            --card-glass: rgba(255, 255, 255, 0.92);
            --sidebar-bg: #ffffff;
            --shadow-subtle: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.03);
            --shadow-hover: 0 20px 25px -5px rgba(13, 95, 87, 0.12), 0 8px 10px -6px rgba(13, 95, 87, 0.08);
        }

        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
            background-color: var(--surface-bg) !important;
            color: #1e293b;
            letter-spacing: -0.01em;
        }

        h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, textarea, .badge {
            font-family: 'IBM Plex Sans Arabic', sans-serif !important;
        }

        /* تخطيط الـ RTL وضبط المسافات */
        [dir="rtl"] #sidebar {
            right: 0 !important;
            left: auto !important;
            border-left: 1px solid rgba(226, 232, 240, 0.8);
            border-right: none !important;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.02);
            background: var(--sidebar-bg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        [dir="rtl"] #main {
            margin-right: 300px !important;
            margin-left: 0 !important;
            padding: 2.2rem 2.5rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media (max-width: 1199.98px) {
            [dir="rtl"] #main {
                margin-right: 0 !important;
                padding: 1.2rem;
            }
        }

        /* تنسيق الشعار العلوي */
        .sidebar-header {
            padding: 1.8rem 1.4rem 1.4rem;
            background: linear-gradient(180deg, #f0fdfa 0%, #ffffff 100%);
            border-bottom: 1px solid #e2e8f0;
            border-radius: 0 0 16px 16px;
            margin-bottom: 1.2rem;
        }

        .sidebar-header .logo-container img {
            transition: transform 0.3s ease;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.05));
        }

        .sidebar-header .logo-container img:hover {
            transform: scale(1.03);
        }

        /* تصميم القوائم الجانبية */
        .sidebar-menu .sidebar-title {
            font-size: 0.78rem !important;
            font-weight: 700 !important;
            color: #64748b !important;
            text-transform: uppercase;
            padding: 1.2rem 1.6rem 0.5rem !important;
            letter-spacing: 0.05em;
        }

        .sidebar-menu .sidebar-link {
            border-radius: 12px !important;
            margin: 0.2rem 1rem !important;
            padding: 0.85rem 1.2rem !important;
            font-weight: 500 !important;
            color: #334155 !important;
            transition: all 0.25s ease !important;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-menu .sidebar-link i {
            font-size: 1.25rem !important;
            color: #0d5f57;
            transition: transform 0.25s ease;
        }

        .sidebar-menu .sidebar-link:hover {
            background-color: #f0fdfa !important;
            color: #0d5f57 !important;
            transform: translateX(-4px);
        }

        .sidebar-menu .sidebar-link:hover i {
            transform: scale(1.15);
        }

        .sidebar-menu .sidebar-item.active .sidebar-link {
            background: var(--primary-gradient) !important;
            color: #ffffff !important;
            box-shadow: 0 8px 18px rgba(13, 95, 87, 0.25) !important;
        }

        .sidebar-menu .sidebar-item.active .sidebar-link i {
            color: #ffffff !important;
        }

        /* رأس الصفحة الفاخر */
        header .page-heading {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            padding: 1.2rem 1.8rem;
            border-radius: 18px;
            box-shadow: var(--shadow-subtle);
            border: 1px solid rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
        }

        .header-title-box h3 {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.45rem;
        }

        .header-title-box p {
            color: #64748b;
            font-size: 0.9rem;
            margin-top: 3px;
        }

        /* صندوق المستخدم */
        .user-dropdown {
            background: #ffffff;
            padding: 0.45rem 0.9rem 0.45rem 1.1rem;
            border-radius: 50px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            text-decoration: none !important;
        }

        .user-dropdown:hover {
            box-shadow: var(--shadow-hover);
            border-color: #cbd5e1;
        }

        .user-dropdown .avatar img {
            border: 2px solid #0d5f57;
            box-shadow: 0 2px 6px rgba(13, 95, 87, 0.2);
        }

        .user-dropdown .text {
            text-align: right;
            margin-right: 12px;
            margin-left: 6px;
        }

        .user-dropdown-name {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
        }

        .user-dropdown-status {
            font-size: 0.78rem;
            color: #0d5f57;
            font-weight: 600;
        }

        .dropdown-menu {
            border-radius: 16px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08) !important;
            padding: 0.6rem !important;
            text-align: right !important;
        }

        .dropdown-item {
            border-radius: 10px !important;
            padding: 0.65rem 1rem !important;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #fef2f2 !important;
            color: #dc2626 !important;
        }

        /* لمسات للبطاقات العامة والأزرار */
        .card {
            border-radius: 18px !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-shadow: var(--shadow-subtle) !important;
            background: #ffffff !important;
            transition: transform 0.25s ease, box-shadow 0.25s ease !important;
        }

        .card:hover {
            box-shadow: var(--shadow-hover) !important;
        }

        .btn-primary {
            background: var(--primary-gradient) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 0.7rem 1.6rem !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(13, 95, 87, 0.25) !important;
            transition: all 0.25s ease !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(13, 95, 87, 0.35) !important;
        }

        /* تذييل الصفحة */
        footer {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid #e2e8f0;
            margin-top: 3rem;
            border-radius: 14px;
            background: #ffffff;
            font-size: 0.88rem;
        }
    </style>

    @yield('styles')
</head>

<body>
    <div id="app">
        <!-- القائمة الجانبية -->
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo-container">
                            <a href="{{ route('v1') }}">
                                <img src="https://albir.sa/_next/image?url=https%3A%2F%2Fapi.albir.sa%2Fuploads%2Falbir%2Fsetting%2Fimage%2Fee19ab72-b329-42b1-9bae-47989433545e.png&w=640&q=75" 
                                     alt="شعار الجمعية" 
                                     style="max-height: 52px; width: auto; object-fit: contain;">
                            </a>
                        </div>
                        <div class="theme-toggle d-flex gap-2 align-items-center">
                            <div class="form-check form-switch fs-6 mb-0">
                                <input class="form-check-input me-0 cursor-pointer" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                        </div>
                        <div class="sidebar-toggler x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle fs-4"></i></a>
                        </div>
                    </div>
                </div>

                @include('layouts.backend.sidebar')
            </div>
        </div>

        <!-- المحتوى الرئيسي -->
        <div id="main">
            <header class="mb-2">
                <div class="page-heading">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <a href="#" class="burger-btn d-block d-xl-none text-primary">
                                <i class="bi bi-justify fs-2"></i>
                            </a>
                            <div class="header-title-box">
                                <h3 class="mb-0">@yield('title')</h3>
                                <p class="mb-0">منظومة إدارة الاستقبال وخدمة المستفيدين</p>
                            </div>
                        </div>

                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown"
                                    class="user-dropdown d-flex align-items-center dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="الصورة الشخصية" class="rounded-circle" width="40" height="40">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name mb-0">{{ auth()->user()->name }}</h6>
                                        <span class="user-dropdown-status">مشرف النظام</span>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                    <li>
                                        <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                            <i class="bi bi-box-arrow-right fs-5"></i>
                                            <span>تسجيل الخروج</span>
                                        </a>
                                        <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <p class="mb-0">جميع الحقوق محفوظة &copy; {{ date('Y') }}</p>
                    </div>
                    <div>
                        <p class="mb-0 fw-semibold text-primary">منصة إدارة الخدمات وصالات الانتظار</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- SweetAlert2 الإشعارات الفاخرة -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: 'عملية ناجحة',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#0d5f57',
                confirmButtonText: 'حسناً',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        </script>
    @endif
    @if (session('galat'))
        <script type="text/javascript">
            Swal.fire({
                title: 'تنبيه',
                text: '{{ session('galat') }}',
                icon: 'warning',
                confirmButtonColor: '#d97706',
                confirmButtonText: 'موافق',
                customClass: {
                    popup: 'rounded-4'
                }
            });
        </script>
    @endif
    @yield('scripts')
</body>

</html>
