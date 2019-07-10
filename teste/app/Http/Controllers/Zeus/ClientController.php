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
            [
                'except' => ['index', 'edit', 'show']
            ]
        );
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
            ->orWhere('cpf', removeMask($search))
            ->orderBy($fieldSort, $sort)
            ->paginate($perPage);

        return response()->json($clients, Response::HTTP_OK);//200
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateClientFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClientFormRequest $request)
    {
        Client::create($request->validated());

        return response()->json($request->validated(), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Client::find($id), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateClientFormRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClientFormRequest $request, $id)
    {
        Client::find($id)->update($request->validated());

        return response()->json($request->validated(), Response::HTTP_OK);
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
