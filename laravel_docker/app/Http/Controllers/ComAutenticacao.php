<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Categorias, Cadastros, Carrinhos, Pedidos, PedidosTemp, Produtos};


class ComAutenticacao extends Controller
{
    public function __construct()
    {
        // $this->middleware('autenticacao');
    }

    // Páginas sem necessidade de autenticação
        // Index
            public function adicionarCarrinho(Request $request)
            {
                // Verifica conta
                    if ($request->session()->get('usuarioLogado' ) == true) {
                        $usuarioId = intval($request->session()->get('usuarioId'));
                        if (Cadastros::query()->where('cadastroId', '=', $usuarioId)->count() > 0 ) {
                            $usuario = Cadastros::query()->where('cadastroId', '=', $usuarioId)->get()[0];

                            if ($usuario->cadastroToken === $request->session()->get('usuarioToken') ) {
                                if ($usuario->cadastroAutoridade == 1) {
                                    return redirect()->route('pagina-login')->withErrors('Você é um ADMINSTRADOR.');
                                }
                            } else {
                                return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                            }
                        }else {
                            return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                        }
                    } else {
                        return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                    }

                    // POST feito de maneira correta ?
                    if ($request->input('produto_id') === null and intval($request->input('produto_id')) == 0) {
                        return redirect()->back()->withErrors('POST inválido. Informação enviada errada ou não encontrada.');
                    }
                // Termina Verificação

                

                // Executar ações
                    $produtoId = intval($request->input('produto_id'));
                    $querySecundaria = Produtos::query()->where('produtoId', '=', $produtoId)->get()[0];
                    // Produto existe mesmo ?
                    if (!isset($querySecundaria) ) {
                        // Erro
                    }


                    $queryString = 'SELECT p.produtoId, c.carrinhoProdutoId, p.produtoQtdeEstoque, c.carrinhoQuantidade, pt.cadastroId, pt.carrinhoId FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND c.carrinhoProdutoId = ?);';
                    $queryPrincipal = DB::select($queryString, [$produtoId]);

                    // Verificações consecutivas

                        // Verifica se esse produto já está em algum carrinho
                            if (!isset($queryPrincipal[0]) ) {
                                // Será preciso criar um carrinho com esse produto
                            }

                        // Verifica se esse produto ainda tem estoque
                            $produtoEstoque = intval($querySecundaria->produtoQtdeEstoque);
                            foreach ($queryPrincipal as $carrinho) {
                                // Aproveita para verificar se algum desses carrinhos é do usuário
                                if ($usuarioId === intval($carrinho->cadastroId)) {
                                    $carrinhoUsuarioId = intval($carrinho->carrinhoId);
                                }

                                $produtoEstoque -= intval($carrinho->carrinhoQuantidade);
                                if ($produtoEstoque - 1 < 0) {
                                    return redirect()->back()->withErrors('POST válido. Esse produto está sem estoque (ou no negativo).');
                                }
                            }

                        // Criar carrinho independente se já existe algum
                        
                            if (isset($carrinhoUsuarioId) ) {
                                $carrinhoUsuario = Carrinhos::query()->where('carrinhoId', '=', $carrinhoUsuarioId)->get()[0];
                                $carrinhoUsuario->carrinhoQuantidade += 1;
                                $carrinhoUsuario->save();
                            } else {
                                $carrinhoNovo = new Carrinhos();
                                $carrinhoNovo->carrinhoProdutoId = $produtoId;
                                $carrinhoNovo->carrinhoQuantidade = 1;
                                $carrinhoNovo->save();
                                
                                // Criando relação temporária
                                $pedidoTempNovo = new PedidosTemp();
                                $pedidoTempNovo->cadastroId = $usuarioId;
                                $pedidoTempNovo->carrinhoId = intval($carrinhoNovo->carrinhoId);
                                $pedidoTempNovo->save();
                            }

                            return redirect()->route('pagina-inicial');
            }


    // Páginas com necessidade de autenticação
        // Páginas para todos cadastrados
            public function meuPerfil(Request $request)
            {
                // Verifica conta
                    if ($request->session()->get('usuarioLogado' ) == true) {
                        $usuarioId = intval($request->session()->get('usuarioId'));
                        if (Cadastros::query()->where('cadastroId', '=', $usuarioId)->count() > 0 ) {
                            $usuario = Cadastros::query()->where('cadastroId', '=', $usuarioId)->get()[0];

                            if ($usuario->cadastroToken === $request->session()->get('usuarioToken') ) {
                                if ($usuario->cadastroAutoridade == 1) {
                                    //
                                }
                            } else {
                                return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                            }
                        }else {
                            return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                        }
                    } else {
                        return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                    }
                // Termina Verificação
                
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                            $numeroCarrinho = DB::select($query, [$request->session()->get('usuarioId')])[0]->resultado;

                        } else {
                            $estaLogado = 'logout';
                            $numeroCarrinho = 0;
                    }
                // Fim


                $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();


                return view(
                    view: 'paginas.acessoPrivado.geral.meuPerfil',
                    data: [
                        'dadosLista' => $usuario,
                        "ordenarLista" => $ordenarLista,
                        "numeroCarrinho" => $numeroCarrinho,
                        'estaLogado' => $estaLogado
                    ]
                );
            }



        // Páginas para clientes
            public function carrinhoGet(Request $request)
            {
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $usuarioId = $request->session()->get('usuarioId');
                            $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                            $numeroCarrinho = DB::select($query, [$usuarioId])[0]->resultado;

                        } else {
                            $estaLogado = 'logout';
                            $numeroCarrinho = 0;
                    }
                // Fim



                $query = 'SELECT p.produtoId as ProdutoId, p.produtoNome AS Nome, p.produtoAutor AS Autor, p.produtoFormato AS Formato, p.produtoValorUnitario AS ValorUnitario, c.carrinhoQuantidade AS Quantidade, p.produtoImagem AS ImagemPath, pt.cadastroId AS UsuarioId, pt.carrinhoId AS CarrinhoId FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                $dadosLista = DB::select($query, [$usuarioId]);
                $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();


                return view(
                    view:'paginas.acessoPrivado.clientes.carrinho.carrinho',
                    data: [
                        "dadosLista" => $dadosLista,
                        "ordenarLista" => $ordenarLista,
                        "estaLogado" => $estaLogado,
                        "numeroCarrinho" => $numeroCarrinho
                    ]
                );
            }


            public function carrinhoPost(Request $request)
            {
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $usuarioId = intval($request->session()->get('usuarioId'));

                        } else {
                            $estaLogado = 'logout';
                    }
                // Fim



                $criarPedido = json_decode($request->input('informacoesCarrinho'), true, 512, JSON_OBJECT_AS_ARRAY);
                // return [$criarPedido, $request->input('informacoesCarrinho')];
                // $numeroAglutinador = DB::select('')
                $query = 'DELETE FROM pedidos_temporarios WHERE pedidos_temporarios.cadastroId = ? AND pedidos_temporarios.carrinhoId = ?;';

                foreach ($criarPedido['dadosInput'] as $ptId => $pedido_temp) {
                    DB::delete($query, [$usuarioId, $ptId]);

                    $novoPedido = new Pedidos();
                    $novoPedido->pedidoCadastroId = $usuarioId;
                    $novoPedido->pedidoCarrinhoId = $ptId;
                    $novoPedido->pedidoStatus = 1;
                    $codBarras = md5(time());
                    sleep(1);
                    $novoPedido->pedidoCodBarras = "$codBarras";
                    $novoPedido->save();
                }


                return redirect('/carrinho');
            }

            
            public function meusPedidosAbertos(Request $request)
            {
                // Verifica conta
                    if ($request->session()->get('usuarioLogado' ) == true) {
                        $usuarioId = intval($request->session()->get('usuarioId'));
                        if (Cadastros::query()->where('cadastroId', '=', $usuarioId)->count() > 0 ) {
                            $usuario = Cadastros::query()->where('cadastroId', '=', $usuarioId)->get()[0];

                            if ($usuario->cadastroToken === $request->session()->get('usuarioToken') ) {
                                if ($usuario->cadastroAutoridade == 1) {
                                    //
                                }
                            } else {
                                return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                            }
                        }else {
                            return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                        }
                    } else {
                        return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                    }
                // Termina Verificação
                
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                            $numeroCarrinho = DB::select($query, [$request->session()->get('usuarioId')])[0]->resultado;

                        } else {
                            $estaLogado = 'logout';
                            $numeroCarrinho = 0;
                    }
                // Fim


                $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();

                $query = 'SELECT p.produtoId as ProdutoId, p.produtoNome AS Nome, p.produtoAutor AS Autor, p.produtoFormato AS Formato, p.produtoValorUnitario AS ValorUnitario, c.carrinhoQuantidade AS Quantidade, p.produtoImagem AS ImagemPath, pp.pedidoCadastroId AS UsuarioId, pp.pedidoId AS PedidoId, pp.pedidoStatus AS Status, c.carrinhoId AS CarrinhoId, pp.created_at AS criacao, pp.updated_at AS pedidos FROM pedidos pp JOIN (produtos p, carrinhos c) WHERE (pp.pedidoCarrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pp.pedidoCadastroId = ? AND pp.pedidoStatus = ?);';
                $dadosLista = DB::select($query, [$usuarioId, 1]);


                return view(
                    view: 'paginas.acessoPrivado.clientes.pedidos.abertos',
                    data: [
                        'dadosLista' => $dadosLista,
                        "ordenarLista" => $ordenarLista,
                        "numeroCarrinho" => $numeroCarrinho,
                        'estaLogado' => $estaLogado
                    ]
                );
            }
            

            public function meusPedidosPagos(Request $request)
            {
                // Verifica conta
                    if ($request->session()->get('usuarioLogado' ) == true) {
                        $usuarioId = intval($request->session()->get('usuarioId'));
                        if (Cadastros::query()->where('cadastroId', '=', $usuarioId)->count() > 0 ) {
                            $usuario = Cadastros::query()->where('cadastroId', '=', $usuarioId)->get()[0];

                            if ($usuario->cadastroToken === $request->session()->get('usuarioToken') ) {
                                if ($usuario->cadastroAutoridade == 1) {
                                    //
                                }
                            } else {
                                return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                            }
                        }else {
                            return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                        }
                    } else {
                        return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                    }
                // Termina Verificação
                
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                            $numeroCarrinho = DB::select($query, [$request->session()->get('usuarioId')])[0]->resultado;

                        } else {
                            $estaLogado = 'logout';
                            $numeroCarrinho = 0;
                    }
                // Fim


                $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();

                $query = 'SELECT p.produtoId as ProdutoId, p.produtoNome AS Nome, p.produtoAutor AS Autor, p.produtoFormato AS Formato, p.produtoValorUnitario AS ValorUnitario, c.carrinhoQuantidade AS Quantidade, p.produtoImagem AS ImagemPath, pp.pedidoCadastroId AS UsuarioId, pp.pedidoId AS PedidoId, pp.pedidoStatus AS Status FROM pedidos pp JOIN (produtos p, carrinhos c) WHERE (pp.pedidoCarrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pp.pedidoCadastroId = ? AND pp.pedidoStatus = ?);';
                $dadosLista = DB::select($query, [$usuarioId, 2]);


                return view(
                    view: 'paginas.acessoPrivado.clientes.pedidos.pagos',
                    data: [
                        'dadosLista' => $dadosLista,
                        "ordenarLista" => $ordenarLista,
                        "numeroCarrinho" => $numeroCarrinho,
                        'estaLogado' => $estaLogado
                    ]
                );
            }
            
            
            public function meusPedidosCancelados(Request $request)
            {
                // Verifica conta
                    if ($request->session()->get('usuarioLogado' ) == true) {
                        $usuarioId = intval($request->session()->get('usuarioId'));
                        if (Cadastros::query()->where('cadastroId', '=', $usuarioId)->count() > 0 ) {
                            $usuario = Cadastros::query()->where('cadastroId', '=', $usuarioId)->get()[0];

                            if ($usuario->cadastroToken === $request->session()->get('usuarioToken') ) {
                                if ($usuario->cadastroAutoridade == 1) {
                                    //
                                }
                            } else {
                                return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                            }
                        }else {
                            return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                        }
                    } else {
                        return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                    }
                // Termina Verificação
                
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                            $numeroCarrinho = DB::select($query, [$request->session()->get('usuarioId')])[0]->resultado;

                        } else {
                            $estaLogado = 'logout';
                            $numeroCarrinho = 0;
                    }
                // Fim


                $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();

                $query = 'SELECT p.produtoId as ProdutoId, p.produtoNome AS Nome, p.produtoAutor AS Autor, p.produtoFormato AS Formato, p.produtoValorUnitario AS ValorUnitario, c.carrinhoQuantidade AS Quantidade, p.produtoImagem AS ImagemPath, pp.pedidoCadastroId AS UsuarioId, pp.pedidoId AS PedidoId, pp.pedidoStatus AS Status FROM pedidos pp JOIN (produtos p, carrinhos c) WHERE (pp.pedidoCarrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pp.pedidoCadastroId = ? AND pp.pedidoStatus = ?);';
                $dadosLista = DB::select($query, [$usuarioId, 0]);


                return view(
                    view: 'paginas.acessoPrivado.clientes.pedidos.cancelados',
                    data: [
                        'dadosLista' => $dadosLista,
                        "ordenarLista" => $ordenarLista,
                        "numeroCarrinho" => $numeroCarrinho,
                        'estaLogado' => $estaLogado
                    ]
                );
            }
            

            public function meusPedidosDetalhados(Request $request, $param1)
            {
                // Verifica conta
                    if ($request->session()->get('usuarioLogado' ) == true) {
                        $usuarioId = intval($request->session()->get('usuarioId'));
                        if (Cadastros::query()->where('cadastroId', '=', $usuarioId)->count() > 0 ) {
                            $usuario = Cadastros::query()->where('cadastroId', '=', $usuarioId)->get()[0];

                            if ($usuario->cadastroToken === $request->session()->get('usuarioToken') ) {
                                if ($usuario->cadastroAutoridade == 1) {
                                    //
                                }
                            } else {
                                return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                            }
                        }else {
                            return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                        }
                    } else {
                        return redirect()->route('pagina-login')->withErrors('Você só pode executar tal ação logado');
                    }
                // Termina Verificação
                
                // Dados de login
                    if ($request->session()->get('usuarioLogado') == true ) {
                        $autoridade = $request->session()->get('usuarioAutoridade');
                        switch ($autoridade) {
                            case 0:
                                $estaLogado = 'client';
                                break;
                            case 1:
                                $estaLogado = 'admin';
                                break;
                            }

                            // Para o número no carrinho de compras
                            $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                            $numeroCarrinho = DB::select($query, [$request->session()->get('usuarioId')])[0]->resultado;

                        } else {
                            $estaLogado = 'logout';
                            $numeroCarrinho = 0;
                    }
                // Fim


                $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();

                // Verifica se pedido existe
                if (Pedidos::query()->where('pedidoId', '=', $param1)->count() < 0 ) {
                    return redirect()->route('pagina-login')->withErrors('Pedido não identificado');
                }
                $dadosLista = Pedidos::query()->where('pedidoId', '=', $param1)->get()[0];


                return view(
                    view: 'paginas.acessoPrivado.geral.meuPerfil',
                    data: [
                        'dadosLista' => $dadosLista,
                        "ordenarLista" => $ordenarLista,
                        "numeroCarrinho" => $numeroCarrinho,
                        'estaLogado' => $estaLogado
                    ]
                );
            }


        // Página para administradores
            public function adminCadastros(Request $request)
            {
                switch ($request->input('ord')) {
                    case 1:
                        $dadosLista = Cadastros::query()->orderBy('cadastroId', 'asc')->get();
                        break;
                    case 2:
                        $dadosLista = Cadastros::query()->orderBy('cadastroNome', 'asc')->get();
                        break;
                    case 3:
                        $dadosLista = Cadastros::query()->orderBy('cadastroCpf', 'asc')->get();
                        break;
                    case 4:
                        $dadosLista = Cadastros::query()->orderBy('cadastroEmail', 'asc')->get();
                        break;
                    case 5:
                        $dadosLista = Cadastros::query()->orderBy('cadastroAutoridade', 'asc')->get();
                        break;
                    case 6:
                        $dadosLista = Cadastros::query()->orderBy('created_at', 'asc')->get();
                        break;
                    case 7:
                        $dadosLista = Cadastros::query()->orderBy('updated_at', 'asc')->get();
                        break;
                    default:
                        $dadosLista = Cadastros::query()->orderBy('cadastroId', 'asc')->get();
                        break;
                }

                $contagemPesquisa = DB::table('cadastros')->count();


                return view(
                    view:'paginas.acessoPrivado.administradores.cadastros',
                    data: [
                        "contagemPesquisa" => $contagemPesquisa,
                        "dadosLista" => $dadosLista
                ]);
            }


            public function adminProdutos(Request $request)
            {
                switch ($request->input('ord')) {
                    case 1:
                        $dadosLista = Produtos::query()->orderBy('produtoId', 'asc')->get();
                        break;
                    case 2:
                        $dadosLista = Produtos::query()->orderBy('produtoNome', 'asc')->get();
                        break;
                    case 3:
                        $dadosLista = Produtos::query()->orderBy('produtoAutor', 'asc')->get();
                        break;
                    case 4:
                        $dadosLista = Produtos::query()->orderBy('produtoValorUnitario', 'asc')->get();
                        break;
                    case 5:
                        $dadosLista = Produtos::query()->orderBy('produtoQtdeEstoque', 'asc')->get();
                        break;
                    case 6:
                        $dadosLista = Produtos::query()->orderBy('created_at', 'asc')->get();
                        break;
                    case 7:
                        $dadosLista = Produtos::query()->orderBy('updated_at', 'asc')->get();
                        break;
                    default:
                        $dadosLista = Produtos::query()->orderBy('produtoId', 'asc')->get();
                        break;
                }

                $contagemPesquisa = DB::table('produtos')->count();


                return view(
                    view:'paginas.acessoPrivado.administradores.produtos',
                    data: [
                        "contagemPesquisa" => $contagemPesquisa,
                        "dadosLista" => $dadosLista
                ]);
            }


            public function adminCategorias(Request $request)
            {
                switch ($request->input('ord')) {
                    case 1:
                        $dadosLista = Categorias::query()->orderBy('categoriaId', 'asc')->get();
                        break;
                    case 2:
                        $dadosLista = Categorias::query()->orderBy('categoriaNome', 'asc')->get();
                        break;
                    case 3:
                        $dadosLista = Categorias::query()->orderBy('created_at', 'asc')->get();
                        break;
                    case 4:
                        $dadosLista = Categorias::query()->orderBy('updated_at', 'asc')->get();
                        break;
                    default:
                        $dadosLista = Categorias::query()->orderBy('categoriaId', 'asc')->get();
                        break;
                }

                $contagemPesquisa = DB::table('categorias')->count();


                return view(
                    view:'paginas.acessoPrivado.administradores.categorias',
                    data: [
                        "contagemPesquisa" => $contagemPesquisa,
                        "dadosLista" => $dadosLista
                ]);
            }


            public function adminPedidos(Request $request)
            {
                switch ($request->input('ord')) {
                    case 1:
                        $dadosLista = Pedidos::query()->orderBy('pedidoId', 'asc')->get();
                        break;
                    case 2:
                        $dadosLista = Pedidos::query()->orderBy('pedidoCadastroId', 'asc')->get();
                        break;
                    case 3:
                        $dadosLista = Pedidos::query()->orderBy('pedidoCarrinhoId', 'asc')->get();
                        break;
                    case 4:
                        $dadosLista = Pedidos::query()->orderBy('pedidoStatus', 'asc')->get();
                        break;
                    case 5:
                        $dadosLista = Pedidos::query()->orderBy('pedidoCodBarras', 'asc')->get();
                        break;
                    case 6:
                        $dadosLista = Pedidos::query()->orderBy('created_at', 'asc')->get();
                        break;
                    case 7:
                        $dadosLista = Pedidos::query()->orderBy('updated_at', 'asc')->get();
                        break;
                    default:
                        $dadosLista = Pedidos::query()->orderBy('pedidoId', 'asc')->get();
                        break;
                }

                $contagemPesquisa = DB::table('pedidos')->count();
                

                return view(
                    view:'paginas.acessoPrivado.administradores.pedidos',
                    data: [
                        "contagemPesquisa" => $contagemPesquisa,
                        "dadosLista" => $dadosLista
                ]);
            }

            public function adminPedidosDetalhados(Request $request)
            {
            }
}
