<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">

        <a href="/" class="navbar-brand">Ambar💕</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="top-navbar-menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Pedidos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('articles.index') }}">Articulos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Markup</a>
                <a class="dropdown-item" href="#">Clientes</a>
                <a class="dropdown-item" href="#">Usuarios</a>
                </div>
                </li>
            </ul>
            <span class="navbar-text nav-link">Hola $USER</span>
            <button type="button" class="btn btn-outline-secondary" alt="salir"><i class="fas fa-sign-out-alt"></i></button>
        </div>
    </div>
</nav>
