<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUpdateClientFormRequest;
use App\Models\Client;
use App\Http\Controllers\Controller;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $clients = Client::where('name', 'like', '%'.request('search', '').'%')
                ->orWhere('email', 'like', '%'.request('search', '').'%')
                ->orWhere('cpf', removeMask(request('search', '')))// CPF precisa ser inteiro da forma que aparece na view
                ->orderBy(request('field_sort', 'id'), request('sort', 'asc'))
                ->paginate(request('per_page', 20));

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return redirect()->route('login');// TODO retornar com uma mensagem explicando o motivo do logout.
        }

        return view('dashboard.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateClientFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClientFormRequest $request)
    {
        try {
            Client::create($request->validated());

            return redirect()->route('dashboard.clients.index')
                ->with([
                    'notification' => [
                        'message' => 'Cliente cadastrado com sucesso!',
                        'color' => 'success'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.clients.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)// 404 se não existir
    {
        $purchases = $client->purchases()->paginate(5);

        return view(
            'dashboard.clients.show',
            compact('client', 'purchases')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)// 404 se não existir
    {
        return view('dashboard.clients.form', compact('client'));
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
        try {
            $client = Client::find($id);

            if (! empty($client)) {
                $client->update($request->validated());

                return redirect()->route('dashboard.clients.index')
                    ->with([
                        'notification' => [
                            'message' => 'Cliente atualizado com sucesso!',
                            'color' => 'success'
                        ]
                    ]);
            }

            return redirect()->route('dashboard.clients.index')
                ->with([
                    'notification' => [
                        'message' => 'O cliente que você deseja atualizar não existe!',
                        'color' => 'warning'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.clients.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
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
        // Estou usando observers para remover os registros relacionados.
        try {
            $client = Client::find($id);

            if (! empty($client)) {
                $client->delete();

                return redirect()->route('dashboard.clients.index')
                    ->with([
                        'notification' => [
                            'message' => 'Cliente removido com sucesso!',
                            'color' => 'success'
                        ]
                    ]);
            }

            return redirect()->route('dashboard.clients.index')
                ->with([
                    'notification' => [
                        'message' => 'O cliente que você está tentando remover não existe!',
                        'color' => 'warning'
                    ]
                ]);

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            return redirect()->route('dashboard.clients.index')
                ->with([
                    'notification' => [
                        'message' => 'Algo deu errado, contate o administrador do sistema',
                        'color' => 'danger'
                    ]
                ]);
        }
    }
}
