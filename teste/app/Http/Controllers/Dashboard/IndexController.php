<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $paramsUrl = [
            'page' => substr($request->page, 0, strspn($request->page, "0123456789")),
            'per_page' => $request->per_page ?? 20,
            'search' => $request->search ?? '', // Apenas pedidos aprovados
            'field_sort' => $request->field_sort ?? 'id',
            'sort' => $request->sort ?? 'asc'
        ];

        $params = http_build_query($paramsUrl);

        $url = url('/zeus/clients/?'.$params);

        try {
            $response = getZeus($url);

            if (! isset($response->data)) {
                //se der muitos refresh na tela também cai aqui.
                sleep(5);

                return redirect()->route('dashboard.index.home');
            }

        } catch (\Exception $e) {
            auth()->logout();

            return url('/');
        }

        $clients = $response->data;
        $pages = $response;

        array_shift($paramsUrl);

        $params = http_build_query($paramsUrl);

        return view('dashboard.home', compact('clients', 'pages', 'params'));
    }
}
