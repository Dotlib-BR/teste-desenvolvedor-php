<?php
namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $title = 'Meu Perfil';
        $description = 'Meu Perfil';
        $info = $this->user->find(auth()->user()->id);
        return view('users.profile.index', compact('title','description','info'));
    }



    public function edit($id)
    {
        $title = 'Editar Usuário';
        $description = 'Editar Usuário';
        $usuario = $this->user->find($id);
        return view('users.forms.index', compact('title','description','usuario', ));
    }

    public function update(Request $request)
    {
        $usuario = $this->user->find($request->id);
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

}
