<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-clock') }}"></use>
            </svg>
            {{ __('Appointments') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/patient" target="_top">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-note-add') }}"></use>
            </svg>
            Admission
        </a>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-shield-alt') }}"></use>
            </svg>
            Security
        </a>
        <ul class="nav-group-items" style="height: 0px;">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-group') }}"></use>
            </svg>
            {{ __('Roles') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('permissions*') ? 'active' : ''}}" href="{{ route('permissions.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-room') }}"></use>
            </svg>
            {{ __('Permissions') }}
        </a>
    </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-group') }}"></use>
            </svg>
            Staff
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="/doctors" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-healing') }}"></use>
                    </svg>
                    Doctor(s)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/nurses" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-medical-cross') }}"></use>
                    </svg>
                    Nurses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/subs" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-tags') }}"></use>
                    </svg>
                    Sub-ordinate
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/technicians" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-fork') }}"></use>
                    </svg>
                    Technicians
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Departments
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-drop') }}"></use>
                    </svg>
                    Laboratory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-leaf') }}"></use>
                    </svg>
                    Pharmacy
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-lightbulb') }}"></use>
                    </svg>
                    X-Ray
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-hospital') }}"></use>
            </svg>
            Hospital
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="/administration" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-drop') }}"></use>
                    </svg>
                    Administration
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
                    </svg>
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-lightbulb') }}"></use>
                    </svg>
                    More..
                </a>
            </li>
        </ul>
    </li>
    <hr>
    <li class="nav-item">
        <a class="nav-link" href="#" target="_top">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-info') }}"></use>
            </svg>
            About
        </a>
    </li>
</ul>