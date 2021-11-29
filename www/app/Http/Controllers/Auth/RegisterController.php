<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CadastroCandidatoRequest;
use App\Http\Requests\CadastroEmpresaRequest;
use App\Models\Empresa;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function formEmpresa(){
        return view('auth.register-empresa');
    }

    public function formCandidato(){
        return view('auth.register-candidato');
    }

    public function registroEmpresa(CadastroEmpresaRequest $request){

        DB::beginTransaction();

        try {
            $empresa = $request->empresa;
            $usuario = $request->usuario;
            $usuario['perfil'] = 'empresa';
            $usuario['password'] = Hash::make($usuario['password']);

            $user = User::create($usuario);

            if($user){
                $empresa['user_id'] = $user->id;

                Empresa::create($empresa);

                DB::commit();

                return redirect()->route('dashboard.empresa.home')->with(['message' => 'Bem vindo... seu usário foi cadastrado!!']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function registroCandidato(CadastroCandidatoRequest $request){

        DB::beginTransaction();

        try {
            $candidato = $request->candidato;
            $usuario = $request->usuario;
            $usuario['perfil'] = 'candidato';
            $usuario['password'] = Hash::make($usuario['password']);

            $user = User::create($usuario);

            if($user){
                $candidato['user_id'] = $user->id;

                Empresa::create($candidato);

                DB::commit();

                return redirect()->route('dashboard.candidato.home')->with(['message' => 'Bem vindo... seu usário foi cadastrado!!']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
