<?php

namespace App\Http\Controllers\Web;

use App\Facades\UserFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * List all users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $filterInfo = $request->only(['perPage', 'filter', 'page']);

            $users = UserFacade::index($filterInfo);

            $filterInfo['page'] = $filterInfo['page'] ?? 1;

            return view('admin.user.index', ['filter' => $filterInfo, 'users' => $users['data']]);
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_INDEX', $e->getMessage(), $e->getFile(), $e->getLine());

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Show Single User
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $user = UserFacade::Show($id);

            if ($user['error'] === 0) {
                return view('admin.user.update', ['user' => $user['data']]);
            }

            return redirect()->route('users')->with('error', 'There was an error bringing the customer');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('adminHome')->with('error', 'An unexpected error has occurred');
        }
    }
    /**
     * Login Screen
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        try {
            return view('user.auth.login');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_LOGIN_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Login validation
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }

            return back()->with('error', 'User does not exist and / or wrong credentials');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_LOGIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Delete Users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id = null)
    {
        try {
            $manyIds = $request->only('id');

            $deleted = UserFacade::delete($manyIds ?? $id);

            if ($deleted['error'] === 0) {
                return [
                    'error' => 0,
                    'description' => 'success'
                ];
            }

            return [
                'error' => 1,
                'description' => 'Error when trying delete a user.'
            ];

        } catch(\Exception $e) {
            Log::error('USER_CONTROLLER_DELETE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return [
                'error' => 1,
                'description' => 'Error deleting user.'
            ];
        }
    }

    /**
     * User loggout
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            Auth::guard('web')->logout();

            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_LOGOUT', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Edit User page
     * @return \Illuminate\Http\Response
     */
    public function editView()
    {
        try {
            return view('user.config.update');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_EDIT_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Update current User
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, int $id = null)
    {
        try {
            $fields = $request->validated();
            $currentUserId = Auth::user()->id;
            $updated = UserFacade::update($id ?? $currentUserId, $fields);

            if ($updated['error'] === 0) {
                return back()->with('success', 'Update successfully');
            }
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('home')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Register screen
     * @return \Illuminate\Http\Response
     */
    public function registerViewAdmin()
    {
        try {
            return view('admin.user.store');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_REGISTER_VIEW_ADMIN', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('users')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Register screen
     * @return \Illuminate\Http\Response
     */
    public function registerView()
    {
        try {
            return view('user.auth.register');
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_REGISTER_VIEW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }

    /**
     * Store user
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $validated  = $request->validated();

            $newUser = UserFacade::store($validated);

            if ($newUser['error'] === 0) {
                return redirect()->route('login');
            }

            return back()->with('error', $newUser['description']);
        } catch (\Exception $e) {
            Log::error('USER_CONTROLLER_STORE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return redirect()->route('login')->with('error', 'An unexpected error has occurred');
        }
    }
}
