<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">

        <a href="/" class="navbar-brand">Ambar💕</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="top-navbar-menu">
            <ul class="navbar-nav mr-auto">
                @nav_item(['href' => route('orders.index', ['delivery' => 1, 'created_at' => now()->format('Y-m-d')]), 'url' => 'orders', 'text' => 'Pedidos'])
                @nav_item(['href' => route('orders.create'), 'url' => 'orders/create', 'text' => 'Ingresar pedido'])
                @nav_item(['href' => route('articles.index'), 'url' => 'articles', 'text' => 'Artículos'])
                @nav_item(['href' => route('categories.index'), 'url' => 'categories', 'text' => 'Categorias'])

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @nav_dropdown_item(['href' => route('clients.index'), 'url' => 'clients', 'text' => 'Clientes'])
                    @nav_dropdown_item(['href' => route('payments.index'), 'url' => 'payments', 'text' => 'Pagos'])
                    @nav_dropdown_item(['href' => route('users.index'), 'url' => 'users', 'text' => 'Usuarios'])
                    @nav_dropdown_item(['href' => route('orders.deletes'), 'url' => 'orders', 'text' => 'Eliminar pedidos'])
                    </div>
                </li>

            </ul>
            <span class="navbar-text nav-link">
                {{ Auth::user()->name }}
            </span>
            <a type="button" href="{{ url('/logout') }}" class="btn btn-outline-secondary" alt="salir"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
</nav>
