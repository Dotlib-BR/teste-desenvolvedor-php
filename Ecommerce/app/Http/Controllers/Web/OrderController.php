<?php

namespace App\Http\Controllers\Web;

use App\Facades\OrderFacade;
use App\Facades\ProductFacade;
use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($id)
    {
    }

    public function editView()
    {
        return view('user.order.edit');
    }

    /**
     * Finish Order
     * @return view
     */
    public function finish(){
        $products = OrderFacade::finishItems();
        return view('user.order.finish', ['products' => $products['data'] ?? []]);
    }
    /**
     * Used for change order status
     */
    public function update(Request $request, $id = null)
    {
        $idRequest = $request->only('id');
        $status = $request->only('status');
        $type = $request->only('type')['type'];

        $updated = OrderFacade::update($id ?? $idRequest, $status, $type);

        if ($updated['error'] === 0) {
            return $updated;
        }

        return 'error';

    }

    public function store(Request $request)
    {

        $items = $request->only('items');
        $stored = OrderFacade::store($items);

        if($stored['error'] === 0) {
            session()->forget('cart');
            return $stored['data'];
        }

        return $stored;
        
    }

    /**
     * Store Order In Session
     * @return array A array with error and data or error with description error
     */
    public function cartStore(Request $request){
        $response = OrderFacade::cartStore($request);

        return $response;
        // if($response['error'] === 0) {
        //     return $response['data'];
        // }

        return [
            'error' => 1,
            'description' => 'erro ao adicionar ao carrinho'
        ];
    }

    public function clearCart(){
        session()->forget('cart');

        return redirect()->route('home');
    }

    /**
     * Show order for user
     * @param int $id order id
     */
    public function show(int $id)
    {
        $order = OrderFacade::show($id);
        if($order['error'] === 0){
            return view('user.order.show', ['products' => $order['data']]);
        }

        return redirect()->route('order');
    }

    /**
     * Show order for admin
     * @param int $id order id
     */
    public function showAdmin(int $id)
    {
        $order = OrderFacade::show($id);
        return view('admin.order.show', ['order' => $order]);
    }

    public function validateUpdate()
    {
    }

    /**
     * Delete a many orders
     * @param mixed $id Orders id
     */
    public function delete(Request $request, $id = null) {
        $manyIds = $request->only('id');

        $deleted = OrderFacade::delete($id ?? $manyIds);

        if($deleted['error'] === 0) {
            return [
                'error' => 0,
                'message' => 'success'
            ];
        }

        return [
            'error' => 1,
            'description' => 'Error when trying delete a order.'
        ];
    }
}
