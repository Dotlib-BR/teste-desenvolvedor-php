<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $select = User::select(['id', 'name', 'email', 'document', 'created_at', 'updated_at']);

        if ($request->has('orderby') && !empty($request->orderby)) {
            $select = $select->orderBy($request->orderby, $request->order ?? 'desc');
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = '%' . $request->search . '%';
            $select = $select->where('name', 'like', $search)
                             ->orWhere('email', 'like', $search)
                             ->orWhere('document', 'like', $search);
        }

        $user = $select->paginate(20)->toArray();

        return view('users.index', [
            'values'     => $user['data'],
            'pagination' => [
                'current' => $user['current_page'],
                'total'   => $user['last_page']
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name'      => 'required|string|min:4|max:100',
            'email'     => 'required|email|max:255|unique:users,email',
            'password'  => 'required',
            'document'  => 'required|cpf|unique:users,document'
        ], $this->messages());

        if ($validator->passes()) {
            $user = null;

            DB::transaction(function() use($request, &$user) {
                $user = User::create($request->except('_token'));
            });

            flashToast('success', 'Usuário registrado.');
            return redirect()->route('users.show', $user->id);
        }

        flashToast('error', 'Não foi possível registrar o usuário.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'model' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'model' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = validator()->make($request->all(), [
            'name'      => 'required|string|min:4|max:100',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'document'  => 'required|cpf|unique:users,document,' . $user->id
        ], $this->messages());

        if ($validator->passes()) {
            $data = $request->only(['name', 'email', 'password', 'document']);

            if ($data['password'] === null) {
                unset($data['password']);
            }

            DB::transaction(function() use($user, $data) {
                $user->update($data);
            });

            flashToast('success', 'Usuário atualizado.');
            return redirect()->route('users.show', $user->id);
        }

        flashToast('error', 'Não foi possível atualizar o usuário.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::transaction(function() use($user) {
            $user->delete();
        });

        flashToast('success', 'Usuário excluído.');
        return redirect()->route('users.index');
    }

    /**
     * Validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'name.required'     => 'Insira o nome.',
            'name.string'       => 'Nome inválido.',
            'name.min'          => 'O nome deve conter entre :min à :max caracteres.',
            'name.max'          => 'O nome deve conter entre :min à :max caracteres.',
            'email.required'    => 'Insira o e-mail.',
            'email.email'       => 'E-mail inválido.',
            'email.max'         => 'O e-mail deve conter o máximo de :max caracteres.',
            'email.unique'      => 'E-mail em uso.',
            'password.required' => 'Insira a senha.',
            'document.required' => 'Insira o CPF.',
            'document.cpf'      => 'CPF inválido.',
            'document.unique'   => 'CPF em uso.'
        ];
    }
}
