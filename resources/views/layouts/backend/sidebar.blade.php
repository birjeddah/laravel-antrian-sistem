<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">الرئيسية</li>

        <li class="sidebar-item {{ request()->is('v1') ? 'active' : '' }}">
            <a href="{{ route('v1') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>لوحة التحكم</span>
            </a>
        </li>

        <li class="sidebar-title">إدارة الانتظار</li>

        <li class="sidebar-item {{ request()->is('v1/antrian*') ? 'active' : '' }}">
            <a href="{{ route('v1.antrian') }}" class='sidebar-link'>
                <i class="bi bi-megaphone-fill"></i>
                <span>شاشة نداء الموظف</span>
            </a>
        </li>

        <li class="sidebar-item {{ request()->is('home*') || request()->is('/') ? 'active' : '' }}">
            <a href="{{ url('/') }}" target="_blank" class='sidebar-link'>
                <i class="bi bi-tv-fill"></i>
                <span>شاشة العرض (التلفزيون)</span>
            </a>
        </li>

        <li class="sidebar-title">الإعدادات والتهيئة</li>

        <li class="sidebar-item {{ request()->is('v1/loket*') ? 'active' : '' }}">
            <a href="{{ route('v1.loket') }}" class='sidebar-link'>
                <i class="bi bi-ui-checks-grid"></i>
                <span>إدارة الشبابيك</span>
            </a>
        </li>

        <li class="sidebar-title">الحساب</li>

        <li class="sidebar-item">
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class='sidebar-link text-danger'>
                <i class="bi bi-box-arrow-right text-danger"></i>
                <span>تسجيل الخروج</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
