<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        @if(Auth::check() && Auth::user()->level_id == 1)
        <li class="nav-item {{ (request()->is('inventary*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('inventary.index') }}">
                <i class="material-icons">web_asset</i>
                <p>Inventaries</p>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('borrow*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('borrow.index') }}">
                <i class="material-icons">list_alt</i>
                <p>Borrows</p>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('user*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="material-icons">person</i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('report*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('report.index') }}">
                <i class="material-icons">book</i>
                <p>Reports</p>
            </a>
        </li>

        @elseif(Auth::check() && Auth::user()->level_id == 2)
        <li class="nav-item {{ (request()->is('borrow*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('borrow.index') }}">
                <i class="material-icons">list_alt</i>
                <p>Borrows</p>
            </a>
        </li>
        <li class="nav-item {{ (request()->is('broken*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('broken.index') }}">
                <i class="material-icons">warning</i>
                <p>Brokens</p>
            </a>
        </li>
        @else
        <li class="nav-item {{ (request()->is('borrow*')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('borrow.index') }}">
                <i class="material-icons">list_alt</i>
                <p>Borrows</p>
            </a>
        </li>
        @endif
        <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
    </ul>
</div>
