<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button
            class="header-toggler"
            type="button"
            onclick="toggleSidebar()"
            aria-label="Toggle sidebar"
        >
            <i class="cil-menu icon icon-lg"></i>
        </button>

        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link py-0 d-flex align-items-center gap-2" data-coreui-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <div class="avatar avatar-sm bg-primary text-white d-flex align-items-center justify-content-center rounded-circle" style="width:32px;height:32px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="d-none d-md-inline text-body">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold py-2">
                        {{ auth()->user()->name }}
                    </div>
                    <span class="dropdown-item-text text-body-secondary small">
                        {{ auth()->user()->email }}
                    </span>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="cil-account-logout me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>

    <div class="header-divider"></div>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title', 'Dashboard')</li>
            </ol>
        </nav>
    </div>
</header>
