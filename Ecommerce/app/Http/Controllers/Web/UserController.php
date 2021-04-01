<?php

namespace App\Http\Controllers\Web;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * List all users
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }
    /**
     * Login Screen
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        try {
            return view('user.auth.login');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_LOGIN_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }

            return back()->with('error', 'User does not exist and / or wrong credentials');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_LOGIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * User loggout
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();

            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_LOGOUT', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Edit User page
     * @return \Illuminate\Http\Response
     */
    public function editView()
    {
        try {
            return view('user.config.update');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_EDIT_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Update current User
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        try {
            $fields = $request->validated();
            $currentUserId = Auth::user()->id;
            $updated = UserFacade::update($currentUserId, $fields);

            if ($updated['error'] === 0) {
                return back()->with('success', 'Update successfully');
            }
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Register screen
     * @return \Illuminate\Http\Response
     */
    public function registerView()
    {
        try {
            return view('user.auth.register');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_REGISTER_VIRE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Store user
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $validated  = $request->validated();

            $newUser = UserFacade::store($validated);

            if ($newUser['error'] === 0) {
                return redirect()->route('login');
            }

            return back()->with('error', $newUser['message']);
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }
}
