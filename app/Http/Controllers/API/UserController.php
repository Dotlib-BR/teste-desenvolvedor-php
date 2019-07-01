<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =     validator()->make($request->all(), [
            'name'      => 'required|string|min:4|max:100',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required|min:8',
            'document'  => 'required|cpf|unique:users,document'
        ], $this->messages());

        if ($validator->passes()) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);

            $user = null;

            DB::transaction(function() use($request, &$user) {
                $user = User::create($request->except('_token'));
            });

            if ($user) {
                return response()->json($user, 201);
            }
        }

        return response()->json([
            'errors' => $validator->errors()
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        }

        return response()->json(false, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $validator = validator()->make($request->all(), [
                'name'      => 'required|string|min:4|max:100',
                'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
                'password'  => 'nullable|min:8',
                'document'  => 'required|cpf|unique:users,document,' . $user->id
            ], $this->messages());

            if ($validator->passes()) {
                $data = $request->only(['name', 'email', 'password', 'document']);

                if ($data['password'] === null) {
                    unset($data['password']);
                } else {
                    $data['password'] = bcrypt($data['password']);
                }

                DB::transaction(function() use($user, $data) {
                    $user->update($data);
                });

                return response()->json($user);
            }

            return response()->json([
                'errors' => $validator->errors()
            ], 500);
        }

        return response()->json(false, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            DB::transaction(function() use($user) {
                $user->delete();
            });

            return response()->json(true);
        }

        return response()->json(false, 404);
    }

    /**
     * Validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'id.required'       => 'Selecione os usuários.',
            'id.array'          => 'Usuários inválidos.',
            'name.required'     => 'Insira o nome.',
            'name.string'       => 'Nome inválido.',
            'name.min'          => 'O nome deve conter no mínimo :min caracteres.',
            'name.max'          => 'O nome deve conter no máximo :max caracteres.',
            'email.required'    => 'Insira o e-mail.',
            'email.email'       => 'E-mail inválido.',
            'email.max'         => 'O e-mail deve conter no máximo :max caracteres.',
            'email.unique'      => 'E-mail em uso.',
            'password.required' => 'Insira a senha.',
            'password.min'      => 'A senha deve conter no mínimo :min caracteres.',
            'document.required' => 'Insira o CPF.',
            'document.cpf'      => 'CPF inválido.',
            'document.unique'   => 'CPF em uso.'
        ];
    }
}
