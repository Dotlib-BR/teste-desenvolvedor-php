<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('home', compact('users'));
    }

    /**
     *  Filters of home view. Search with date and option per page.
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        $query = $request->input('query');

        $results = User::query();

        if ($request->has('query')) {
            $results->where('name', 'LIKE', "%$query%");
        }

        if ($request->has('check_date')) {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($start > $end) {
                return back()->withErrors('A data inicial não pode ser maior que a data final.');
            }

            $results->whereBetween('created_at', [$start, $end]);
        }
        if ($request->has('order_by')){
            $results->orderBy('name', $request->input('order_by'));
        }

        if ($request->has('perPage')){
            $userQuery = $results->paginate($request->input('perPage'));
        }else{
            $userQuery = $results->paginate(20);
        }

        return view('home')->with([
            'results' => $userQuery,
        ]);
    }

    /**
     *  Function to ajax call and remove checked ids.
     *  
     *  @return \Illuminate\Http\Response
     */
    public function removeLot(Request $request)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Usuário removido.']);
    }

    /**
     *  Delete specified ID of user. 
     * 
     *  @param $id;
     * 
     *  @return \Illuminate\Http\Response
     */
    public function excluir($id)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $user = User::find($id);

        if($user){
            $user->delete();

            return redirect()->route('home')->with('success_message', 'Usuário excluído com sucesso.');
        }else{
            abort (404);
        }
    }

    /**
     *  Delete specified ID of user. 
     * 
     *  @param $id;
     * 
     *  @return \Illuminate\Http\Response
     */
    public function editPermissions($id)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $roles = Role::all();
        $user = User::find($id);

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermissions(Request $request, $id)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $orderUpdate = User::find($id);
        if($orderUpdate){
            if($orderUpdate->role_id == $request->role_id){
                return back()->withErrors('O usuário já está nessa posição.');
            }else{
                $orderUpdate->update(['role_id' => $request->role_id]);
            }
        }else{
            abort(404);
        }

        return back()->with('success_message', 'Permissões atualizadas.');
    }

    /** 
     *  Method to create a register in db.
     * 
     *  @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        return view('users.create');
    }

    /**
     *  Store a new user in DB.
     *  
     *  @param  \Illuminate\Http\Request  $request;
     *  @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'CPF' => ['required', 'string', 'max:11', 'unique:users', 'max:11']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'CPF' => $request->CPF,
            'password' => Hash::make('password'),
        ]);
        
        return redirect()->route('home')->with('success_message', 'Usuário ' . $request->name .' cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role_id != 1){
            abort(404);
        }

        $findUser = User::find($id);

        return view('users.create', compact('findUser'));
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
        if(Auth::user()->role_id != 1){
            abort(404);
        }
        
        $updateUser = User::find($id);

        $input = $request->except('password', 'password_confirmation');
        
        if(!$request->filled('password')){
            $updateUser->fill($input)->save();
            
            return redirect()->route('home')->with('success_message', 'Usuário atualizado com sucesso!');
        }
        
        $updateUser->password = bcrypt($request->password);
        $updateUser->fill($input)->save();

        return redirect()->route('home')->with('success_message', 'Usuário e/ou senha atualizados com sucesso!');
    }
}