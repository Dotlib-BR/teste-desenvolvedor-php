<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Throwable;

class ClientController extends Controller
{
    /**
     *
     * @param ClientRepositoryInterface $clientRepository
     * @param UserRepositoryInterface $userRepository
     * @param UserService $userService
     * @param ClientService $clientService
     */
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private UserRepositoryInterface $userRepository,
        private UserService $userService,
        private ClientService $clientService
    )
    {}

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $clients = $this->clientRepository->paginate();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('clients.crud');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store(Request $request): RedirectResponse
    {
        $this->userService->create($request->toArray());

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return bool|string
     */
    public function show(int $id): bool|string
    {
        $client = $this->clientRepository->findOrFail($id);

        return json_encode([$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $client = $this->clientRepository->findOrFail($id);
        return view('clients.crud', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->clientRepository->update($request->toArray(), $id);
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->userService->destroy($id);
        return redirect()->route('clientes.index');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function search(Request $request): View
    {
        $clients = $this->userRepository->search($request->input('search'));

        return view('clients.index', compact('clients'));
    }
}
