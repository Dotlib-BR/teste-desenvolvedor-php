<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomersController extends Controller
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

        return view('customers', [
            'customers' => $customers,
            'per_page' => $per_page,
            'search_term' => $search_term,
            'order_by' => join('|', [$order_by, $order_direction]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer_create');
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

        $customerService->createCustomer($request->name, $request->cpf, $request->email);

        return redirect('customers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id, CustomerService $customerService)
    {
        $customer = $customerService->getCustomerById((int) $id);

        if (!$customer) {
            return redirect()->route('costumers');
        }

        return view('customer_edit', [
            'id' => $customer->id,
            'name' => $customer->name,
            'cpf' => $customer->cpf,
            'email' => $customer->email,
        ]);
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
            return redirect()->route('costumers');
        }

        $customerService->updateCustomer($customer, $request->name, $request->cpf, $request->email);

        return redirect()->route('costumers');
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

        return redirect()->route('costumers');
    }
}
