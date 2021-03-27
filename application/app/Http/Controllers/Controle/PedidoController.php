<?php

namespace App\Http\Controllers\Controle;

use App\Contracts\Repositories\ClienteInterface;
use App\Contracts\Repositories\CupomDescontoInterface;
use App\Contracts\Repositories\ProdutoInterface;
use App\Contracts\Repositories\StatusPedidoInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PedidoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    protected $pedidoService;
    protected $clienteRepository;

    public function __construct(PedidoService $pedidoService, ClienteInterface $clienteRepository)
    {
        $this->pedidoService = $pedidoService;
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatusPedidoInterface $statusPedidoInterface)
    {
        $pedidos = $this->pedidoService->listarPedidos(20);
        $status = $statusPedidoInterface->newQuery()->pluck('nome', 'id')->toArray();

        return view('controle.pedidos.index', ['pedidos' => $pedidos, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CupomDescontoInterface $cupomDescontoInterface, ProdutoInterface $produtoInterface)
    {
        $clientes = $this->clienteRepository->newQuery()->pluck('nome', 'id')->toArray();
        $cupoms = $cupomDescontoInterface->newQuery()->pluck('codigo', 'id')->toArray();
        $produtos = $produtoInterface->newQuery()->pluck('nome', 'id')->toArray();

        // dd($clientes, $cupoms);

        return view('controle.pedidos.create', compact(['clientes', 'cupoms', 'produtos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|integer',
            'quantidade' => 'required|array',
            'produto_id' => 'required|array',
        ]);

        $input = $request->all();
        $produtos = [];
        $cupom_id = null;

        DB::beginTransaction();

        $produtos = $this->formataArray($input);

        try {
            $pedido = $this->pedidoService->create($input['cliente_id'], $produtos,  $cupom_id);

            DB::commit();
            return redirect()->route('controle.pedidos.index')->with('msg', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('msg', "Erro ao cadastrar")->with('error', true)->withInput();
        }
    }

    private function formataArray($input)
    {
        $produtos = [];
        foreach ($input['produto_id'] as $produto) {
            $produtos[$produto]['produto_id'] = $produto;
            $produtos[$produto]['quantidade'] = $input['quantidade'][$produto];
        }
        return $produtos;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, StatusPedidoInterface $statusPedidoInterface)
    {
        $pedido = $this->pedidoService->getPedido($id);
        $status = $statusPedidoInterface->newQuery()->pluck('nome', 'id')->toArray();

        return view('controle.pedidos.show', compact(['pedido', 'status']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pedido = $this->pedidoService->find($id);

        return view('controle.pedidos.create', ['pedido' => $pedido]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input, $request->get('status_pedido_id'));

        DB::beginTransaction();

        try {
            $pedido = $this->pedidoService->update($id, $input);

            DB::commit();

            return redirect()->route('controle.pedidos.index')->with('msg', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);

            return redirect()->back()->with('msg', "Erro ao cadastrar registro")->with('error', true)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->pedidoService->delete($id);

            return redirect()->route('controle.pedidos.index')->with('msg', 'Registro excluido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', "Erro ao excluir registro")->with('error', true);
        }
    }
}
