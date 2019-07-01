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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $select = User::select(['id', 'name', 'email', 'document', 'created_at', 'updated_at']);

        if ($request->has('orderby') && !empty($request->orderby)) {
            $select = $select->orderBy($request->orderby, $request->order ?? 'asc');
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = '%' . $request->search . '%';
            $select = $select->where('name', 'like', $search)
                             ->orWhere('email', 'like', $search)
                             ->orWhere('document', 'like', $search);
        }

        $items = $request->items ?? 20;
        $user  = $select->paginate($items);

        return view('users.index', [
            'items'      => $user->items(),
            'pagination' => [
                'current' => $user->currentPage(),
                'total'   => $user->lastPage()
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
                flashToast('success', 'Usuário registrado.');
                return redirect()->route('users.show', $user->id);
            }
        }

        flashToast('error', 'Não foi possível registrar o usuário.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
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

            flashToast('success', 'Usuário atualizado.');
            return redirect()->route('users.show', $user->id);
        }

        flashToast('error', 'Não foi possível atualizar o usuário.');
        return back()->withInput()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
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
     * Remove the specified resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'id' => 'required|array',
        ], $this->messages());

        if ($validator->passes()) {
            DB::transaction(function() use($request) {
                User::whereIn('id', $request->id)->delete();
            });

            flashToast('success', 'Usuários excluídos.');
            return redirect()->route('users.index');
        }

        flashToast('error', 'Não foi possível excluir os usuários selecionados.');
        return back();
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
