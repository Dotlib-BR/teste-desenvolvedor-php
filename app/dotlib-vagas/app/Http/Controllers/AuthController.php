<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Repository\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct(public UsersRepository $usersRepository){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('vagas');
        }

        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

        return redirect('/');
    }

    /**
     * Realizar o login
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();

            return redirect()->intended('vagas');
        }

        $request->session()->flash('error',"Error ao realizar o login, por favor verifique seus dados de acesso.");
        return redirect()->intended('auth');
    }

    /**
     * Realizar o logout
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
