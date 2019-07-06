<?php

namespace App\Http\Controllers\Zeus;

use App\Http\Requests\StoreUpdateClientFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function __construct()
    {
        // Caso dê algo errado nos métodos que fazem alterações no banco eu uso o DB::beginTransaction()
        $this->middleware(
            'db.transaction',
            ['except' =>
                ['index', 'edit', 'show']
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Preciso fazer essas simples verificações para não quebrar nos testes.
        $search = $request->search ?? '';
        $fieldSort = $request->field_sort ?? 'id';
        $sort = $request->sort ?? 'asc';
        $perPage = $request->per_page ?? 20;

        $clients = Client::where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orderBy($fieldSort, $sort)
            ->paginate($perPage);

        return response()->json($clients, Response::HTTP_OK);//200
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        parse_str($request->getContent(), $data);//coloca o que veio do formulário em um array.

        Client::find($id)->update($data);

        return response()->json($id, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        // Estou usando observers para remover os registros relacionados.

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
