<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Throwable;

/**
 * @group Auth
 */
class AuthController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserService $userService
    )
    {}

    /**
     * LOGIN - Faz o login no sistema.
     * @unauthenticated
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->userRepository->findByEmail($request->email);

        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw new UnauthorizedException("Acesso não autorizado, e-mail ou senha incorretos");
        }

        $token = $user->createToken('api-token-teste')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * Signup - Cria um novo usuário.
     * @throws Throwable
     */
    public function signup(StoreUserRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->validated());

        $token = $user->createToken('api-token-teste')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * LOGOUT - Desloga o Usuário (Revoga o token logado)
     */
    public function logout(): Response
    {
        User::logout();
        return response()->noContent();
    }
}
