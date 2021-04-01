<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    /**
     * Return view for admin Home
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admin.index');
        } catch (\Exception $e) {
            Log::error('ADMIN_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Return view of login for admin
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        try {
            return view('admin.auth.login');
        } catch (\Exception $e) {
            Log::error('ADMIN_CONTROLLER_LOGIN_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return redirect()->route('loginAdmin')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Authenticates the admin
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {

            $credentials = $request->only(['email', 'password']);

            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('adminHome');
            }
        } catch (\Exception $e) {
            Log::error('ADMIN_CONTROLLER_LOGIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return redirect()->route('loginAdmin')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Log out the admin
     * @return @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {

            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('loginAdmin');
        } catch (\Exception $e) {
            Log::error('ADMIN_CONTROLLER_LOGIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);
            return redirect()->route('loginAdmin')->with('error', 'An unexpected error has occurred');
        }
    }
}
