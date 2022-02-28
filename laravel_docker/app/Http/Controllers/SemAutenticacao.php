<?php

namespace App\Http\Controllers;

use App\Models\Cadastros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produtos;
use App\Http\Requests\{RequestCadastro, RequestLogin};


class SemAutenticacao extends Controller
{
    public function index(Request $request)
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
                    $query = 'SELECT SUM(c.carrinhoQuantidade) AS resultado FROM pedidos_temporarios pt JOIN (produtos p, carrinhos c) WHERE (pt.carrinhoId = c.carrinhoId AND c.carrinhoProdutoId = p.produtoId AND pt.cadastroId = ?);';
                    $numeroCarrinho = DB::select($query, [$request->session()->get('usuarioId')])[0]->resultado;

                } else {
                    $estaLogado = 'logout';
                    $numeroCarrinho = 0;
            }
        // Fim


        // 
        $categoriaSelecionada = $request->input('categoria');
        if (isset($categoriaSelecionada) ) {

        } else {
            $categoriaSelecionada = 'Padrão';
        }

        $contagemPesquisa = DB::table('produtos')->count();
        $dadosLista = Produtos::query()->orderBy('produtoNome', 'asc')->get();
        $ordenarLista = DB::table("categorias")->select('categoriaNome')->get()->toArray();

        return view(
            view:'paginas.acessoLivre.index',
            data: [
                "categoriaSelecionada" => $categoriaSelecionada,
                "contagemPesquisa" => $contagemPesquisa,
                "dadosLista" => $dadosLista,
                "ordenarLista" => $ordenarLista,
                "estaLogado" => $estaLogado,
                "numeroCarrinho" => $numeroCarrinho
            ]
        );
    }


    public function loginGet(Request $request)
    {
        // Verificando se o usuário está logado
        if ($request->session()->get('usuarioLogado') == true) {
            return redirect()->route('pagina-inicial');
        }

        return view('paginas.acessoLivre.login');
    }


    public function loginPost(RequestLogin $request)
    {
        // Verificando se o usuário está logado
        if ($request->session()->get('usuarioLogado') == true) {
            return redirect()->route('pagina-inicial');
        }

        $email = $request->input('email_usuario');
        $senha = $request->input('senha_usuario');

        if ( Cadastros::query()->where('cadastroEmail', '=', $email)->count() > 0 ) {
            $usuario = Cadastros::query()->where('cadastroEmail', '=', $email)->get()[0];

            if ( password_verify($senha, $usuario->cadastroSenha) ) {
                // Gerando informações no navegador para o usuário
                $request->session()->put([
                    'usuarioLogado' => true,
                    'usuarioAutoridade' => $usuario->cadastroAutoridade,
                    'usuarioId' => $usuario->cadastroId,
                    'usuarioToken' => $usuario->cadastroToken
                ]);

                return redirect()->route('pagina-inicial');
            } else {
                return redirect()->back()->withErrors('Senha inválida.');
            }
        } else {
            return redirect()->back()->withErrors('Login inválido.');
        }
    }


    public function cadastroGet(Request $request)
    {
        // Verificando se o usuário está logado
        if ($request->session()->get('usuarioLogado') == true) {
            return redirect()->route('pagina-inicial');
        }

        return view('paginas.acessoLivre.cadastro');
    }


    public function cadastroPost(RequestCadastro $request)
    {
        $cadastroNome = $request->input('nome_usuario');
        // É preciso tratar o CPF
        $cadastroCpf = $request->input('cpf_usuario');
        $cadastroCpf = str_replace(['.', '-'], ['', ''], $cadastroCpf);

        $cadastroEmail = $request->input('email_usuario');
        $cadastroSenha = password_hash($request->input('senha_usuario'), PASSWORD_DEFAULT);
        $cadastroAutoridade = $request->input('autoridade_usuario');
        $cadastroToken = password_hash(time(), PASSWORD_DEFAULT);
        $cadastroApiToken = password_hash(time(), PASSWORD_DEFAULT);

        $cadastro = new Cadastros;
        $cadastro->cadastroNome = $cadastroNome;
        $cadastro->cadastroCpf = $cadastroCpf;
        $cadastro->cadastroEmail = $cadastroEmail;
        $cadastro->cadastroSenha = $cadastroSenha;
        $cadastro->cadastroAutoridade = $cadastroAutoridade;
        $cadastro->cadastroToken = $cadastroToken;
        $cadastro->cadastroApiToken = $cadastroApiToken;
        $cadastro->save();

        // Gerando informações no navegador para o usuário
        $request->session()->put([
            'usuarioLogado' => true,
            'usuarioAutoridade' => $cadastro->cadastroAutoridade,
            'usuarioId' => $cadastro->cadastroId,
            'usuarioToken' => $cadastro->cadastroToken
        ]);

        return redirect()->route('pagina-inicial');
    }


    public function logout(Request $request)
    {
        if ($request->session()->get('usuarioLogado') == true) {
            $request->session()->flush();
            return redirect()->route('pagina-inicial');
        } else {
            return redirect()->route('pagina-login');
        }
    }


    public function teste(Request $request) {
        $informacao = DB::select('SELECT a.cadastroId, a.carrinhoId, b.carrinhoId, b.carrinhoProdutoId, b.carrinhoQuantidade FROM pedidos_temporarios a JOIN carrinhos b ON a.carrinhoId = b.carrinhoId WHERE a.cadastroId = ?;', [1]);
        return $informacao[0];
    }
}
