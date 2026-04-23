<nav class="app-header navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-1 text-primary"></i> Admin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="bi bi-house me-1"></i>View Site
                    </a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a href="#" class="nav-link" id="adminClearCacheLink">
                        <i class="bi bi-trash me-1"></i>Clear cache
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-2 d-none d-md-block text-muted small">
                    {{ now()->format('M d, Y') }}
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="post" class="px-3 py-1">
                                @csrf
                                <button class="btn btn-link p-0 text-danger"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


