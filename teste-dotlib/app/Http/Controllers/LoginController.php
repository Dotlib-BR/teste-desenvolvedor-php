<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'cpf' => 'required',
            'password' => 'required',
        ], [
            'cpf.required' => 'O cpf é obrigatório',
            'password.required' => 'A senha é obrigatória',
        ]);

        $cpf = $this->userRepository->formatCpf($request->get('cpf'));

        if (Auth::attempt(['cpf' => $cpf, 'password' => $request->password])) {
            $user = $this->userRepository->getUserByCpf($cpf);
            Session::put('user', ['id' => $user->id, 'admin' => $user->admin, 'name' => $user->name, 'cpf' => $user->cpf, 'email' => $user->email, 'created_at' => $user->created_at]);
            return redirect()->route('home');
        }
        return redirect()->back()->with('danger', 'Email ou senha inválidos');
    }


    public function register(Request $request)
    {
        $credentials = $request->validate([
            'cpf' => 'required',
            'name' => 'required',
            'password' => 'required',
        ], [
            'cpf.required' => 'O cpf é obrigatória',
            'name.required' => 'O nome é obrigatória',
            'password.required' => 'A senha é obrigatória',
        ]);

        $result = $this->userRepository->store($request);

        if(is_a($result, 'Exception')){
            $messageError = 'Algo deu errado';
            if($result->getCode() == 23000)
                $messageError = 'Cpf Já está cadastrado em nossa base de dados';

            return redirect()->back()->with('danger', $messageError);
        }

        $cpf = $this->userRepository->formatCpf($request->get('cpf'));
        $user = $this->userRepository->getUserByCpf($cpf);
        Session::put('user', ['id' => $user->id, 'admin' => $user->admin, 'name' => $user->name, 'cpf' => $user->cpf, 'email' => $user->email, 'created_at' => $user->created_at]);
        return redirect()->route('home');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('home');
    }






}
