<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">

        <a href="/" class="navbar-brand">Ambar💕</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="top-navbar-menu">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">Articulos</a>
                    <div class="dropdown-menu">
                        <a href="{{ route('articles.index') }}" class="dropdown-item">Ver todos</a>
                        <a href="{{ route('articles.create') }}" class="dropdown-item">Ingresar nuevo</a>
                    </div>
                </li>

            </ul>
        </div>

    </div>
</nav>
