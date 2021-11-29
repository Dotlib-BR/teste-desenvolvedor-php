<?php

namespace App\Http\Controllers\Dashboard\Candidato;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroCandidatoRequest;
use App\Models\Candidato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function home(){
        return view('dashboard.candidato.home');
    }

    public function perfil(){

        try {
            $user = User::with('candidato')->findOrFail(auth()->id());

            return view('dashboard.candidato.perfil', compact('user'));

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

    public function perfilUpdate(CadastroCandidatoRequest $request, $user_id){

        try {

            $usuarioCandidato = Candidato::with('user')->where('user_id', '=', $user_id)->firstOrFail();
            $candidato = $request->candidato;
            $candidato['data_nascimento'] = Carbon::parse($candidato['data_nascimento'])->format('Y-m-d');

            $usuario = $request->usuario;
            $usuario['password'] = $usuario['password'] != '' || !is_null($usuario['password']) ? Hash::make($usuario['password']) : $usuarioCandidato->user->password;

            unset($usuario['password_confirmation']);

            $usuarioCandidato->update($candidato);
            $usuarioCandidato->user()->update($usuario);

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
