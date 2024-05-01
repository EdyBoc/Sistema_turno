<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i><span>Incio</span>
    </a>
    <a class="nav-link" href="/index_catalogo">
        <i class="fas fa-book"></i><span>Catalogo</span>
    </a>
    <a class="nav-link" href="/index_usuarios">
        <i class="fas fa-users-cog"></i><span>Usuarios</span>
    </a>

    @isset($rol_usuario)
        @if ($rol_usuario == 'admin' || $rol_usuario == 'coordinador')
            <!-- Enlaces para admin o coordinador -->

            @if ($rol_usuario == 'coordinador')
                <!-- Enlaces adicionales para coordinador -->
                <a class="nav-link" href="/index_asignacion">
                    <i class="fas fa-clipboard-list"></i><span>Asignaciones</span>
                </a>
                <a class="nav-link" href="/index_vacaciones">
                    <i class="fas fa-umbrella-beach"></i><span>Vacaciones</span>
                </a>
                <a class="nav-link" href="/index_reporte">
                    <i class="fas fa-chart-pie"></i><span>Reporteria</span>
                </a>
            @endif
        @endif

        @if ($rol_usuario == 'recursos_humanos')
            <!-- Enlaces para recursos humanos -->
            <a class="nav-link" href="#">
                <i class="fas fa-paperclip"></i><span>RRHH</span>
            </a>
        @endif

        @if ($rol_usuario == 'recursos_nomina')
            <!-- Enlaces para recursos de nómina -->
            <a class="nav-link" href="#">
                <i class="fas fa-hand-holding-usd"></i><span>Nomina</span>
            </a>
        @endif
    @endisset

</li>
