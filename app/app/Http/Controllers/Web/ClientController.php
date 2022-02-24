<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class ClientController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $request->validate([
            'per_page' => 'integer',
            'search_params',
            'order_by',
        ]);

        if(session('success_message')) {
            Alert::success('Sucesso!', session('success_message'));
        }

        $per_page = $request->input('per_page') ?: 20;
        $search_params = $request->input('search_params');
        $order_by = $request->input('order_by'); 

        $query = Client::query();

        if ($order_by) {
            $query = $query->orderBy($order_by);
        }
        if ($search_params) {
            $query = $query->advancedSearch($search_params);
        }

        $clients = $query->paginate($per_page);

        return view('clients.index', [
            'clients' => $clients->appends(request()->input()),
            'per_page' => $per_page,
            'searchable' => true,
            'search_params' => $search_params
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'cpf' => 'required|digits:11|numeric'
        ]);

        Client::create($data);
        return redirect(route('clients'))->withSuccessMessage('Cliente criado com sucesso');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect(route('clients'))->withSuccessMessage('Cliente apagado com sucesso');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'cpf' => 'string|min:11|max:11',
            'email' => 'email'
        ]);
        
        Client::findOrFail($id)
            ->update($data);
        return redirect(route('clients'))->withSuccessMessage('Cliente editado com sucesso');
    }

    public function updatePage($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', [
            'client' => $client,
        ]);
    }

    public function createPage()
    {
        return view('clients.create');
    }
}
