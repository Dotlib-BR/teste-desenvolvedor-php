<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\View\View;
use Throwable;


class AuthController extends Controller
{
    /**
     *
     * @param UserRepositoryInterface $userRepository
     * @param UserService $userService
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserService $userService
    )
    {}

    /**
     * @return View
     */
    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * LOGIN - Faz o login no sistema.
     * @unauthenticated
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws UnauthorizedException
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('pedidos');
        }

        return back()->withErrors([
            'email' => 'Login ou senha invalido!',
        ]);
    }

    /**
     * LOGOUT - Faz o logout do sistema.
     * @authenticated
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * @return View
     */
    public function signup(): View
    {
        return view('auth.signup');
    }

    /**
     * @param StoreUserRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function register(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->create($request->validated());

        return redirect()->intended('login');
    }
}
