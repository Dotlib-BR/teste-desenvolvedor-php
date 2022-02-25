<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Services\ClientService;

class ClientController extends Controller
{
    /**
     *
     * @param ClientRepositoryInterface $clientRepository
     * @param ClientService $clientService
     */
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private ClientService $clientService
    )
    {}
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientRequest $request
     * @return JsonResponse
     */
    public function store(StoreClientRequest $request): JsonResponse
    {
        return response()->json($this->clientRepository->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $int
     * @return JsonResponse
     */
    public function show(int $int): JsonResponse
    {
        return response()->json($this->clientRepository->findOrFail($int));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClientRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateClientRequest $request, int $id): JsonResponse
    {
        return response()->json($this->clientService->update($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return JsonResponse
     */
    public function destroy(Client $client): JsonResponse
    {
        return response()->json($this->clientRepository->destroy($client));
    }
}
