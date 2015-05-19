<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-small" src="/img/logo_conquistadores.png" width="150">
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ \Session::get('Club')['nombre'] }}</strong>
                         </span> <span class="text-muted text-xs block">{{ ucwords(strtolower(\Session::get('Club')['zona'])) }} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="/auth/logout">Salir</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="/dashboard">Inicio</a>
            </li>
        </ul>

    </div>
</nav>