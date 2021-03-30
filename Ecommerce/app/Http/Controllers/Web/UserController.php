<?php

namespace App\Http\Controllers\Web;

use App\Facades\ProductFacade;
use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * User home page
     * @return \Illuminate\Http\Response 
     */
    public function index(Request $request)
    {
        $filterInfo = $request->only(['perPage', 'filter', 'page']);
        $filter = ProductFacade::index($filterInfo);
        $filterInfo['page'] = $filterInfo['page'] ?? 1;
        if($filter['error'] === 0){
            return view('user.index', ['products' => $filter['data'], 'filter' => $filterInfo]);
        }

        return redirect()->route('home')->with('error', 'Erro ao fazer o filtro');
    }

    /**
     * Login Screen
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->with('error', 'Usuario não existe e/ou credenciais erradas');
    }

    /**
     * User loggout
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function editView(){
        return view('user.config.update');
    }

    /**
     * Update current User
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request) {
        $fields = $request->validated();
        $currentUserId = Auth::user()->id;
        $updated = UserFacade::update($currentUserId, $fields);

        if($updated['error'] === 0) {
            return back()->with('success', 'Atualização feita com sucesso');
        }
    }

    /**
     * Register screen
     * @return \Illuminate\Http\Response
     */
    public function registerView() {

        return view('user.auth.register');
    }

    /**
     * Store user
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $validated  = $request->validated();

        $newUser = UserFacade::store($validated);
    
        if($newUser['error'] === 0) {
            return redirect()->route('login');
        }
    
        return back()->with('error', $newUser['message']);
    }
}
