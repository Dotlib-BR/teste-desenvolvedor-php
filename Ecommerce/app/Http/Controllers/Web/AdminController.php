<?php

namespace App\Http\Controllers\Web;

use App\Facades\AdminFacade;
use App\Facades\OrderFacade;
use App\Facades\ProductFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

    /**
     * Return view for admin Home
     * @return view Admin home
     */
    public function index() {
        $products = ProductFacade::index();
        $order = OrderFacade::index(10);
        return view('admin.index',[
            'products' => $products,
            'orders' => $order
        ]);
    }

    /**
     * Return view of login for admin
     * @return view Admin home
     */
    public function loginView() {
        return view('admin.auth.login');
    }

    /**
     * Authenticates the admin
     * @return redirect Redirect for admin home
     */
    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('adminHome');
        }
    }

    /**
     * Log out the admin
     * @return redirect Redirect for login screen of admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginAdmin');
    }
    
}