<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $users = User::where('name', 'like', '%'.request('search', '').'%')
                ->orWhere('email', 'like', '%'.request('search', '').'%')
                ->orderBy(request('field_sort', 'id'), request('sort', 'asc'))
                ->paginate(request('per_page', 20));

        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                dd($e);
            }

            auth()->logout();

            return redirect()->route('login');// TODO retornar com uma mensagem explicando o motivo do logout.
        }

        return view('dashboard.home', compact('users'));
    }
}
