<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(Request $request)
    {
        $request->query->add(['page' => $request->page ?? 1]);

        $url = url('/zeus/clients/?'.http_build_query($request->query->all()));

        try {
            $response = consumeZeus($url);

            $clients = $response->data;
            $pages = $response;

            if (! isset($response->data)) {
                //se der muitos refresh na tela também cai aqui.
                sleep(5);

                return redirect()->back()
                    ->with([
                        'request' => 'Timeout.'
                    ]);
            }

        } catch (\Exception $e) {
            if (! env('APP_DEBUG')) {
                auth()->logout();

                return url('/');
            }
        }

        $params = removePage($request->query->all());

        return view('dashboard.home', compact('clients', 'pages', 'params'));
    }
}
