<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\StoreUpdateClientFormRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->query->add(['page' => $request->page ?? 1]);

        $url = url('/zeus/clients/?'.http_build_query($request->query->all()));

        try {
            $response = consumeZeus($url);

            if (! isset($response->data)) {
                //se der muitos refresh na tela também cai aqui.
                sleep(5);

                return redirect()->back()
                    ->with([
                        'request' => 'Timeout.'
                    ]);
            }

        } catch (\Exception $e) {
            auth()->logout();

            return url('/');
        }

        $clients = $response->data;
        $pages = $response;

        $params = removePage($request->query->all());

        return view('dashboard.clients.index', compact('clients', 'pages', 'params'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClientFormRequest $request)
    {
        try {
            consumeZeus(
                route('clients.store', $request->all()),
                'POST',
                $request->all()
            );

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return url('/');
        }

        return redirect()->route('dashboard.clients.index')
            ->with([
                'action' => 'Ação realizada.'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.form', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClientFormRequest $request, $id)
    {
        try {
            consumeZeus(
                route('clients.update', $id),
                'PUT',
                $request->all()
            );

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return url('/');
        }

        return redirect()->route('dashboard.clients.index')
            ->with([
                'action' => 'Ação realizada.'
            ]);

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
            consumeZeus(route('clients.destroy', $id), 'DELETE');

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return url('/');
        }

        return redirect()->back()
            ->with([
                'action' => 'Ação realizada.'
            ]);
    }
}
