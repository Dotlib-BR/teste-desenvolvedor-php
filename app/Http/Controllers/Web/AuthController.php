<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @method get /login
     *
     * Allow user to make Login. Returns view only!
     *
     * @return View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * @method post /login
     *
     * Allow user to make Login.
     *
     * @return Redirect
     */
    public function loginAction(LoginRequest $request, UserService $userService)
    {
        $request->validated();

        // user always exists because validation
        $user = $userService->searchInfluencerByEmail($request->email);
        if (!$userService->checkUserPassword($user, $request->password)) {
            return redirect('login')->withErrors([
                'email/password' => 'Email ou senha não coincidem'
            ]);
        }

        Auth::login($user);
        return redirect()->route('home');
    }


    /**
     * @method get /signup
     *
     * Allow user to make Signup. Returns view only!
     *
     * @return View
     */
    public function signup()
    {
        return view('signup');
    }

    /**
     * @method post /signup
     *
     * Allow user to make Signup.
     *
     * @return Redirect
     */
    public function signupAction(SignUpRequest $request, UserService $userService)
    {
        $request->validated();

        // user never exists because validation
        $user = $userService->createUser($request->name, $request->email, $request->password);

        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * @method get /logout
     *
     * Makes user logout
     *
     * @return Redirect
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
