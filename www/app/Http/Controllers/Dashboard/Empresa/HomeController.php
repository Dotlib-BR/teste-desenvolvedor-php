<?php

namespace App\Http\Controllers\Dashboard\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroEmpresaRequest;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home(){
        return view('dashboard.empresa.home');
    }

    public function perfil(){

        try {
            $user = User::with('empresa')->findOrFail(auth()->id());

            return view('dashboard.empresa.perfil', compact('user'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {
            $notification = array(
                'message' => 'Usuário não localizado',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        } catch( \Exception $e){
            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function perfilUpdate(CadastroEmpresaRequest $request, $user_id){

        try {
            $usuarioEmpresa = Empresa::with('user')->where('user_id', '=', $user_id)->firstOrFail();
            $empresa = $request->empresa;
            $usuario = $request->usuario;

            $usuario['password'] = $usuario['password'] != '' || !is_null($usuario['password']) ? Hash::make($usuario['password']) : $usuarioEmpresa->user->password;

            unset($usuario['password_confirmation']);

            $usuarioEmpresa->update($empresa);
            $usuarioEmpresa->user()->update($usuario);

            $notification = array(
                'message' => 'Os dados do seu Perfil foram alterados',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {
            $notification = array(
                'message' => 'Usuário não localizado',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        } catch( \Exception $e){
            dd($e);
            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function apagarConta($user_id){
        try {

            $usuario = User::findOrFail($user_id);

            $usuario->delete();

            $notification = array(
                'message' => 'Sua conta foi removida',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {
            $notification = array(
                'message' => 'Usuário não localizado',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        } catch( \Exception $e){
            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
