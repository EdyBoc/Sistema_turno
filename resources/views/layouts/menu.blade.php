@if (\Illuminate\Support\Facades\Auth::user())
    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
        <a class="nav-link" href="/home">
            <i class="fas fa-home"></i><span>Inicio</span>
        </a>
        <a class="nav-link" href="/index_catalogo">
            <i class="fas fa-book"></i><span>Catálogo</span>
        </a>
        <a class="nav-link" href="/index_usuarios">
            <i class="fas fa-users-cog"></i><span>Usuarios</span>
        </a>
        <a class="nav-link" href="/index_asignacion">
            <i class="fas fa-clipboard-list"></i><span>Asignaciones</span>
        </a>
        <a class="nav-link" href="/index_perfil">
            <i class="fas fa-walking"></i><span>Trabajador</span>
        </a>
        <a class="nav-link" href="/index_vacaciones">
            <i class="fas fa-umbrella-beach"></i><span>Vacaciones</span>
        </a>
        <a class="nav-link" href="index_listar">
            <i class="fas fa-paperclip"></i><span>RRHH</span>
        </a>
    </li>
@else
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i><span>Inicio</span>
    </a>
@endif
