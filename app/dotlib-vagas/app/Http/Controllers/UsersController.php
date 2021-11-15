<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repository\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct(public UsersRepository $usersRepository){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginacao = isset($request->page);

        if (!$request->order){
            $request->session()->forget('texto_busca');
            $request->session()->forget('direcao_order');
            $request->session()->forget('direcao_order_atual');
        }

        $users = $this->usersRepository->getUsers($request->order,$paginacao);

        return view('users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $status = $this->usersRepository->store($data);

        if(!$status){
            $request->session()->flash('error',"Error ao salvar o registro");
            $user = $data;
            return view('users.cadastrar')->with(compact('user'));
        }

        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->usersRepository->getUser($id);

        return view('users.cadastrar')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();

        $status = $this->usersRepository->update($id,$data);

        if(!$status){
            $request->session()->flash('error',"Error ao atualizar o registro");
            $user = $data;

          return view('users.cadastrar')->with(compact('user'));
        }

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->usersRepository->delete($id);

        if(!$status){
            return response()->json([],400);
        }

        session()->flash('direcao_order',null);

        return $status;
    }

    public function pesquisar(Request $request)
    {
        $data = $request->all();

        $request->session()->put('texto_busca',$data['texto_busca']);
        $request->session()->put('direcao_order',null);
        $request->session()->put('direcao_order_atual', null);

        $users = $this->usersRepository->pesquisar($data);

        return view('users.index')->with(compact('users'));
    }
}
