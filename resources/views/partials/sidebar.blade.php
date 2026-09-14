<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-flex align-items-center gap-2 py-2">
            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width:32px;height:32px;flex-shrink:0;">
                <i class="cil-location-pin text-white"></i>
            </div>
            <span class="fw-semibold fs-5 text-white">Titik Rawan</span>
        </div>
    </div>

    <ul class="sidebar-nav" data-coreui="navigation">
        <li class="nav-title">Menu</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="nav-icon cil-speedometer"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('titik-rawan.*') ? 'active' : '' }}" href="{{ route('titik-rawan.index') }}">
                <i class="nav-icon cil-location-pin"></i> Data Titik Rawan
            </a>
        </li>
    </ul>
</div>
