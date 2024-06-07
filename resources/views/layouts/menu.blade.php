@if (\Illuminate\Support\Facades\Auth::user())
    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
        <a class="nav-link" href="/home">
            <i class="fas fa-home"></i><span>Inicio</span>
        </a>
    </li>
@else
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i><span>Inicio</span>
    </a>
@endif
