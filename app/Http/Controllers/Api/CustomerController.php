<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CustomerService $customerService)
    {
        $per_page = (int) $request->get('per_page', 20);
        $page = (int) $request->get('page', 0);
        $search_term = (string) $request->get('search_term', '');
        list($order_by, $order_direction) = explode('|', (string) $request->get('order_by', 'id|asc'));

        $customers = $customerService->getCustomers($per_page, $page, $search_term, $order_by, $order_direction);
        $customersCount = $customerService->getCustomersCount($search_term);

        return $this->successResponse([
            'customers' => CustomerResource::collection($customers),
            'meta' => [
                'per_page' => $per_page,
                'page' => $page,
                'last_page' => ceil($customersCount / $per_page),
                'search_term' => $search_term,
                'order_by' => join('|', [$order_by, $order_direction]),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, CustomerService $customerService)
    {
        $request->validated();

        $customer = $customerService->createCustomer($request->name, $request->cpf, $request->email);

        return $this->successResponse(new CustomerResource($customer), 'Customer Created', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id, CustomerService $customerService)
    {
        $customer = $customerService->getCustomerById((int) $id);

        if (!$customer) {
            return $this->errorResponse('Customer not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse(new CustomerResource($customer));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, string $id, CustomerService $customerService)
    {
        $request->validated();

        $customer = $customerService->getCustomerById((int) $id);

        if (!$customer) {
            return $this->errorResponse('Customer not found', Response::HTTP_NOT_FOUND);
        }

        $customerService->updateCustomer($customer, $request->name, $request->cpf, $request->email);

        return $this->successResponse(new CustomerResource($customer));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id, CustomerService $customerService)
    {
        $customerService->deleteCustomerById((int) $id);

        return $this->successResponse(null, 'Successfully Deleted', Response::HTTP_NO_CONTENT);
    }
}
