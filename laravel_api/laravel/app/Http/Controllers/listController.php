<?php

namespace App\Http\Controllers;

use App\Models\ListUser;
use Illuminate\Http\Request;

class listController extends Controller {
    
    public function listagem(Request $request) 
    {
        $ListUser = ListUser::all();

        return response()->json($ListUser);
    }

    public function adicionar(Request $request) 
    {
        $newUser = new ListUser();
        $newUser->nome = $request->name;
        $newUser->email = $request->email;
        $newUser->save();

        return response()->json('success');
    }

    public function editar(ListUser $user, Request $request) 
    {
        return response()->json($user);
    }
    
    public function update(ListUser $user, Request $request) 
    {
        $user->nome = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json('success');
    }

    public function delete(ListUser $user, Request $request) 
    {
        $user->delete();

        return response()->json('success');
    }
}
