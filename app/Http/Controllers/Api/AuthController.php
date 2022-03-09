<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{ LoginRequest, SignUpRequest };
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Allow user to make Login
     *
     * @return JsonResource
     */
    public function login(LoginRequest $request, UserService $userService)
    {
        $request->validated();

        $user = $userService->searchInfluencerByEmail($request->email);
        if (!$userService->checkUserPassword($user, $request->password)) {
            $this->errorResponse('Password does not match', Response::HTTP_UNAUTHORIZED);
        }

        $token = $userService->createTokenApiToUser($user);

        return $this->successResponse([
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }

    /**
     * Allow user to make Login
     *
     * @return JsonResource
     */
    public function signup(SignUpRequest $request, UserService $userService)
    {
        $request->validated();

        $user = $userService->createUser($request->name, $request->email, $request->password);
        $token = $userService->createTokenApiToUser($user);

        return $this->successResponse([
            'token' => $token,
            'user' => new UserResource($user),
        ], 'User created', Response::HTTP_CREATED);
    }

    /**
     * Get Logged User
     *
     * @return JsonResource
     */
    public function getMe(Request $request)
    {
        return $this->successResponse(new UserResource($request->user()));
    }
}
