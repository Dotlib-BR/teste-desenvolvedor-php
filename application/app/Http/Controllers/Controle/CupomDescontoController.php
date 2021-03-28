<?php

namespace App\Http\Controllers\Controle;

use App\Contracts\Repositories\CupomDescontoInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CupomDescontoController extends Controller
{

    protected $cupomDesconto;

    public function __construct(CupomDescontoInterface $cupomDesconto)
    {
        $this->cupomDesconto = $cupomDesconto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupoms = $this->cupomDesconto->paginate();

        return view('controle.cupom.index', ['cupoms' => $cupoms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('controle.cupom.create');
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
            'nome' => 'required|min:2|max:255',
            'codigo' => 'required|min:2|max:255',
            'valor' => 'required|min:2|max:255',
        ]);

        $input = $request->all();
        $input['valor'] = decimalParaBanco($input['valor'] ?? null);

        DB::beginTransaction();

        try {
            $cupom = $this->cupomDesconto->create($input);

            DB::commit();
            return redirect()->route('controle.cupom.index')->with('msg', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('msg', "Erro ao cadastrar")->with('error', true)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cupom = $this->cupomDesconto->find($id);

        return view('controle.cupom.create', ['cupom' => $cupom]);
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
        $input['valor'] = decimalParaBanco($input['valor'] ?? null);

        DB::beginTransaction();

        try {
            $cupom = $this->cupomDesconto->update($id, $input);

            DB::commit();

            return redirect()->route('controle.cupom.index')->with('msg', 'Registro atualizado com sucesso!');
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
            $this->cupomDesconto->delete($id);

            return redirect()->route('controle.cupom.index')->with('msg', 'Registro excluido com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('msg', "Erro ao excluir registro")->with('error', true);
        }
    }
}
