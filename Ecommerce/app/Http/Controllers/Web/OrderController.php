<?php

namespace App\Http\Controllers\Web;

use App\Facades\OrderFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * User Order Index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filterInfo = $request->only(['perPage', 'filter', 'page', 'status']);
            $filterInfo['user'] = ['status' => 'current'];
            $filter = OrderFacade::index($filterInfo);
            $filterInfo['page'] = $filterInfo['page'] ?? 1;
            if ($filter['error'] === 0) {
                return view('user.order.index', ['orders' => $filter['data'], 'filter' => $filterInfo]);
            }

            return redirect()->route('home')->with('error', 'Error bringing orders');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Admin Order Index
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin(Request $request)
    {
        try {
            $filterInfo = $request->only(['perPage', 'filter', 'page', 'status']);
            $filter = OrderFacade::index($filterInfo);
            $filterInfo['page'] = $filterInfo['page'] ?? 1;
            if ($filter['error'] === 0) {
                return view('admin.order.index', ['orders' => $filter['data'], 'filter' => $filterInfo]);
            }

            return redirect()->route('adminHome')->with('error', 'Error bringing orders');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_INDEX_ADMIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Edit order page
     * @return \Illuminate\Http\Response
     */
    public function editView()
    {
        try {
            return view('user.order.edit');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_EDIT_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Finish Order
     * @return \Illuminate\Http\Response
     */
    public function finish()
    {
        try {
            $products = OrderFacade::finishItems();

            if ($products['error'] === 0) {
                return view('user.order.finish', ['products' => $products['data'] ?? []]);
            }

            return redirect()->route('home')->with('error', 'An error occurred when finalizing the order');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_FINISH', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }
    /**
     * Used for change order status
     * @param \Illuminate\Http\Request $request
     * @param int $id null
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id = null)
    {
        try {
            $idRequest = $request->only('id');
            $status = $request->only('status');
            $type = $request->only('type')['type'];

            $updated = OrderFacade::update($id ?? $idRequest, $status, $type);

            if ($updated['error'] === 0) {
                return $updated;
            }

            return back()->with('error', 'There was an error updating the order status');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Store order action
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $items = $request->only('items');
            $stored = OrderFacade::store($items);

            if ($stored['error'] === 0) {
                session()->forget('cart');
                return $stored['data'];
            }

            return $stored;
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Stor cart in session
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cartStore(Request $request)
    {
        try {
            $response = OrderFacade::cartStore($request);

            if ($response['error'] === 0) {
                return $response['data'];
            }

            return [
                'error' => 1,
                'description' => 'Error adding to cart.'
            ];
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_CART_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Stor cart in session
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        try {

            session()->forget('cart');
            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_CLEAR_CART', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Show order for user
     * @param int $id order id
     * @return @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $order = OrderFacade::show($id);
            if ($order['error'] === 0) {
                return view('user.order.show', ['products' => $order['data']]);
            }

            return redirect()->route('order');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Show order for admin
     * @param int $id
     * @return @return \Illuminate\Http\Response
     */
    public function showAdmin(int $id)
    {
        try {
            $order = OrderFacade::show($id);

            if ($order['error'] === 0) {
                return view('admin.order.show', ['products' => $order['data']]);
            }

            return redirect()->route('order');
        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_SHOW_ADMIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Delete a many orders
     * @param \Illuminate\Http\Request $request
     * @param mixed $id Orders id
     * @return @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id = null)
    {
        try {
            $manyIds = $request->only('id');

            $deleted = OrderFacade::delete($id ?? $manyIds);

            if ($deleted['error'] === 0) {
                return [
                    'error' => 0,
                    'message' => 'success'
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error when trying delete a order.'
            ];

        } catch (\Exception $e) {
            Log::error('ORDER_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }
}
