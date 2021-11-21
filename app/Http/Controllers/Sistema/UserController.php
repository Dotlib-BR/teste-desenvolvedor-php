<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * FUNCOES QUE MUDARAM DE LUGAR
     */
    public function login()
    {
        return view('auth.login.index');
    }
    public function login_action(Request $request)
    {
        $data = $request->only([
            'email',
            'password'
        ]);
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'E-mail informado não é válido',
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if ($validation->fails()) {
            return redirect()->route('login')
                ->withErrors($validation)->withInput();
        }

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        } else {
            $validation->errors()->add('password', 'Email e/ou senha errados');
            return redirect()->route('login')
                ->withErrors($validation)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect("/login");
    }

    /**FIM */

    //FUNCAO DE PERFIL ADM - LISTAR USUARIO CADASTRADO NO SISTEMA ATIVOS E INATIVOS
    public function index()
    {
        $title = 'Lista de Usuários';
        $users = $this->user->where('id','!=',auth()->user()->id)->get();
        return view('usuarios.index', compact('users', 'title'));
    }

    //FUNCAO DE PERFIL ADM - CARREGA FORMULARIO PARA CADASTRAR USUARIO NO SISTEMA
    public function create()
    {
        $title = 'Cadastrar Usuário';
        return view('usuarios.register.index', compact('title'));
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'user',
            'admin'
        ]);
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email'
        ];
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'E-mail informado não é válido'
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if (empty($request->user) && empty($request->admin)) {
            $validation->errors()->add('error_perfil', ' *O Usuário tem que ter pelo menos um perfil selecionado');
            return redirect()->route('usuario.create')
            ->withErrors($validation)
            ->withInput();
        }


        if ($validation->fails()) {
            return redirect()->route('usuario.create')
                ->withErrors($validation)->withInput();
        }

        $create = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'user' => $request->user ?? 0,
            'admin' => $request->admin ?? 0
        ]);

        if ($create) {
            return redirect()->back()->with('user_success', 'Usuário cadastrado com sucesso!');
        }
    }


    public function edit($id)
    {
        $title = 'Editar Usuário';
        $usuario = $this->user->find($id);
        return view('usuarios.register.index', compact('usuario', 'title'));
    }

    public function update(Request $request, $id)
    {
        $usuario = $this->user->find($id);

        $data = $request->only([
            'name',
            'email',
            'user',
            'admin'
        ]);

        $rules = [
            'name' => 'required',
            'email' => 'required|string|email|unique:users,email,'.$usuario->id,
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'E-mail informado não é válido',
        ];

        $validation = $this->validation($data, $rules, $feedback);

        if (empty($request->user) && empty($request->admin)) {
            $validation->errors()->add('error_perfil', ' *O Usuário tem que ter pelo menos um perfil selecionado');
            return redirect()->route('usuarios.edit', ['id' => $usuario->id])
            ->withErrors($validation)
            ->withInput();
        }

        if (!is_null($request->password)) {

            if(strlen($request->password) < 3 || strlen($request->password) > 8){
                $validation->errors()->add('error_senhas_diferentes', 'Senha devem ter entre 3 a 8 dígitos');
                return redirect()->route('usuarios.edit', ['id' => $usuario->id])
                ->withErrors($validation)
                ->withInput();
            }

            if($request->password !== $request->password_confirmation){
                $validation->errors()->add('error_senhas_diferentes','Senhas devem ser iguais');
                return redirect()->route('usuarios.edit', ['id' => $usuario->id])
                ->withErrors($validation)
                ->withInput();
            }
        }

        if ($validation->fails()) {
            return redirect()->route('usuarios.edit', ['id' => $usuario->id])
                ->withErrors($validation)
                ->withInput();
        }

        $update = $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user' => $request->user ?? 0,
            'admin' => $request->admin ?? 0
        ]);

        if ($update) {
            return redirect()->back()->with('user_update', 'Usuário atualizado com sucesso!');
        }
    }

    //ATUALIZAR O PROPRIO USUARIO
    public function isMe($id)
    {
        $title = 'Meu Perfil';
        $info = $this->user->find($id);

        return view('usuarios.perfil.index', compact('title','info'));
    }

    public function updateIsMe(Request $request, $id)
    {
        $usuario = $this->user->find($id);

        $data = $request->only([
            'name',
            'email',
        ]);

        $rules = [
            'name' => 'required',
            'email' => 'required|string|email|unique:users,email,'.$usuario->id,
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'E-mail já cadastrado',
            'email.email' => 'E-mail informado não é válido',
        ];

        $validation = $this->validation($data, $rules, $feedback);


        if (!is_null($request->password)) {

            if(strlen($request->password) < 3 || strlen($request->password) > 8){
                $validation->errors()->add('error_senhas_diferentes', 'Senha devem ter entre 3 a 8 dígitos');
                return redirect()->route('usuario.isMe', ['id' => $usuario->id])
                ->withErrors($validation)
                ->withInput();
            }

            if($request->password !== $request->password_confirmation){
                $validation->errors()->add('error_senhas_diferentes','Senhas devem ser iguais');
                return redirect()->route('usuario.isMe', ['id' => $usuario->id])
                ->withErrors($validation)
                ->withInput();
            }
        }


        if ($validation->fails()) {
            return redirect()->route('usuario.isMe', ['id' => $usuario->id])
                ->withErrors($validation)
                ->withInput();
        }

        $update = $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($update) {
            return redirect()->back()->with('user_update', 'Usuário atualizado com sucesso!');
        }
    }

    protected function validation(array $data, array $rules, array $feedback)
    {
        return Validator::make($data, $rules, $feedback);
    }

    public function destroy($id)
    {
        $delete = $this->user->find($id);
        $delete->delete();
        return redirect()->back()->with('user_delete', 'Usuario apagado com sucesso!');
    }
}
