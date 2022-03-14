<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userRepository->all();
        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.crud');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        return response()->json($this->userService->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $int
     * @return JsonResponse
     */
    public function show(int $int): JsonResponse
    {
        return response()->json($this->userRepository->findOrFail($int));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $int
     * @return View
     */
    public function edit(int $int): View
    {
        $user = $this->userRepository->findOrFail($int);
        return view('users.crud', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        return response()->json($this->userService->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->userRepository->destroy($id));
    }
}

