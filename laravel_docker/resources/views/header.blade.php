    <?php
        /* Verificação para mostrar um cabeçário específico para
           -> Quem não está logado ('logout')
           -> É cliente ('client')
           -> É administrador ('admin')
        */
    ?>


    <!-- Menu de Navegação estático -->
    @switch ($estaLogado)
        @case('logout')
            <nav class="navbar navbar-expand-lg background-2 align-items-center">
                <div class="col-3 text-center">
                    <a href="/" class="mx-3">
                        <img class="w-50" src="https://dotlib.com/theme/img/logos/logo.png" alt="logo">
                    </a>
                </div>
                <div class="col-6">
                    <div class="d-flex bg-light rounded position-relative">
                        <div>

                            <!-- Todas categorias de produtos -->
                            <div>
                                <button class="dropdown-toggle btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Todo o site
                                </button>

                                <div class="dropdown-menu">

                                    <?php
                                        foreach($ordenarLista as $ordenar) {
                                            $categoria = $ordenar->categoriaNome;
                                            echo "<span class=\"dropdown-item\" data-value-option=\"$categoria\">$categoria</span>";
                                        }
                                    ?>

                                </div>
                            </div>

                        </div>

                        <input class="form-control rounded" type="text" style="border: none; border-radius: 0;">
                        <div class="rounded">
                            <div>
                                <input id="pesquisa-lupa" class="btn" type="button" value="">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-2 mx-3 justify-content-end">
                    <ul class="navbar-nav" >
                        <li id="meu-perfil" class="mx-2 nav-item position-relative align-self-center">
                            <div></div>
                            <i class="fa-solid fa-user text-light fs-18"></i>
                        </li>
                        <li class="nav-item align-self-center">
                            <div class="d-grid fs-07">
                                <small>
                                    Olá, Bem Vindo(a)!
                                </small>
                                <small>
                                    <a id="#" class="" href="/login">Entre </a>
                                    ou
                                    <a id="#" class="" href="/cadastro"> cadastre-se</a>
                                </small>
                            </div>
                        </li>
                        <li id="carrinho-de-compras" class="nav-item">
                            <a id="#" class="" href="/carrinho">
                                <div>
                                    <small class="p-1 text-light">{{ $numeroCarrinho }}</small>
                                </div>
                                <i class="fa-solid fa-cart-shopping text-light fs-17"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @break




        @case('client')
            <nav class="navbar navbar-expand-lg background-2 align-items-center">
                <div class="col-3 text-center">
                    <a href="/" class="mx-3">
                        <img class="w-50" src="https://dotlib.com/theme/img/logos/logo.png" alt="logo">
                    </a>
                </div>
                <div class="col-6">
                    <div class="d-flex bg-light rounded position-relative">
                        <div>

                            <!-- Todas categorias de produtos -->
                            <div>
                                <button class="dropdown-toggle btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Todo o site
                                </button>

                                <div class="dropdown-menu">

                                    <?php
                                        foreach($ordenarLista as $ordenar) {
                                            $categoria = $ordenar->categoriaNome;
                                            echo "<span class=\"dropdown-item\" data-value-option=\"$categoria\">$categoria</span>";
                                        }
                                    ?>

                                </div>
                            </div>

                        </div>

                        <input class="form-control rounded" type="text" style="border: none; border-radius: 0;">
                        <div class="rounded">
                            <div>
                                <input id="pesquisa-lupa" class="btn" type="button" value="">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-2 mx-3 justify-content-end">
                    <ul class="navbar-nav">
                        <li id="meu-perfil" class="mx-2 nav-item position-relative align-self-center">
                            <a href="/meu-perfil">
                                <div style="width: 2.3em;height: 2.5em;"></div>
                                <i class="fa-solid fa-user text-light fs-18"></i>
                            </a>
                        </li>
                        <li class="nav-item align-self-center">
                            <div class="fs-07">
                                <small>
                                    Obrigado por nos apoiar!
                                </small>
                                
                            </div>
                        </li>
                        <li class="nav-item align-self-center">
                            <div class="fs-09 text-center">
                                
                                <small>
                                    <a id="#" class="" href="/meus-pedidos">Meus Pedidos</a>
                                </small>
                            </div>
                        </li><li id="carrinho-de-compras" class="nav-item">
                            <a id="#" class="" href="/carrinho">
                                <div>
                                    <small class="p-1 text-light">{{ $numeroCarrinho }}</small>
                                </div>
                                <i class="fa-solid fa-cart-shopping text-light fs-17"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @break




        @case('admin')
            <nav class="navbar navbar-expand-lg background-2 align-items-center">
                <div class="col-4 text-center">
                    <a href="/" class="mx-3">
                        <img class="w-50" src="https://dotlib.com/theme/img/logos/logo.png" alt="logo">
                    </a>
                </div>
                

                
                <div class="col mx-3 justify-content-end navbar-collapse collapse">
                    <ul class="navbar-nav">
                        <li id="meu-perfil" class="mx-2 nav-item position-relative fs-15 align-self-center">
                            <a href="/meu-perfil">
                                <div style="width: 2.4em;height: 2.4em;"></div>
                                <i class="fa-solid fa-user-gear text-light fs-18"></i>
                            </a>
                        </li>
                        
                        <li class="mx-3 nav-item align-self-center">
                            <div class="fs-12 text-center">
                                
                                <small>
                                    <a id="#" class="" href="/admin">Dashboard</a>
                                </small>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @break
    @endswitch
    