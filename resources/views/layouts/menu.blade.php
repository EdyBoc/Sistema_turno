@if (\Illuminate\Support\Facades\Auth::user())
    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
        <a class="nav-link" href="/home">
            <i class="fas fa-home"></i><span>Inicio</span>
        </a>
        <a class="nav-link" href="/index_catalogo">
            <i class="fas fa-book"></i><span></span>
        </a>
        <a class="nav-link" href="/index_asignacion">
            <i class="fas fa-clipboard-list"></i><span></span>
        </a>
    </li>
@else
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i><span>Inicio</span>
    </a>
@endif
