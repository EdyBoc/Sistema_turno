@if (\Illuminate\Support\Facades\Auth::user())
    <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
        <a class="nav-link" href="/home">
            <i class="fas fa-home"></i><span>Inicio</span>
        </a>
        <a class="nav-link" href="/index_catalogo">
            <i class="fas fa-book"></i><span>Catálogo</span>
        </a>
        <a class="nav-link" href="/index_asignacion">
            <i class="fas fa-clipboard-list"></i><span>Asignación</span>
        </a>
        <a class="nav-link" href="/index_perfil">
            <i class="fas fa-walking"></i><span>Trabajador</span>
        </a>
        <a class="nav-link" href="index_listar">
            <i class="fas fa-paperclip"></i><span>Recursos Humanos</span>
        </a>
        <a class="nav-link" href="index_reporte">
            <i class="fas fa-paperclip"></i><span>Repostería</span>
        </a>
    </li>
@else
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i><span>Inicio</span>
    </a>
@endif
