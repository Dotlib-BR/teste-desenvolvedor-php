<?php

namespace App\Http\Controllers\Api;

use App\Facades\UserFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Requests\Api\UserStoreRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /** 
     * List Users
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $filter = $request->only(['filter', 'perPage', 'page']);

            $users = UserFacade::index($filter);


            if(!empty($users['data']->onEachSide)) {
                $users['data'] = $users['data']->items();
            }

            if ($users['error'] === 0) {
                return response([
                    'error' => 0,
                    'data' => $users['data']
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error bringing Users'
            ]);
        } catch (\Exception $e) {
            Log::error('USER_API_CONTROLLER_INDEX', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /** 
     * Updates a specific user
     * @param \App\Http\Requests\Api\UserUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        try {
            $fields = $request->all();

            $updated = UserFacade::update($id, $fields);


            if ($updated['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'User updated successfully'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error updating user.'
            ]);
        } catch (\Exception $e) {
            Log::error('USER_API_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Show a specific user
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            
            $user = UserFacade::show($id);

            if ($user['error'] === 0) {
                return response([
                    'error' => 0,
                    'data' => $user['data']
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'User not found.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('USER_API_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /**
     * Delete many users or a specific
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, int $id = null)
    {
        try {
            $manyIds = $request->only('id');
            $ids = $id;

            if(!empty($manyIds)) {
                $ids = $manyIds;
            }

            $user = UserFacade::delete($ids);

            if ($user['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'Successfully deleted users.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error when deleting user.'
            ]);
        } catch (\Exception $e) {
            Log::error('USER_API_CONTROLLER_SHOW', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }

    /** 
     * Store a user
     * @param \App\Http\Requests\Api\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {

            $fields = $request->all();


            $stored = UserFacade::store($fields);


            if ($stored['error'] === 0) {
                return response([
                    'error' => 0,
                    'description' => 'User successfully registered.'
                ]);
            }

            return response([
                'error' => 1,
                'description' => 'Error registering user.'
            ]);
        } catch (\Exception $e) {
            Log::error('USER_API_CONTROLLER_UPDATE', [$e->getMessage(), $e->getFile(), $e->getLine()]);

            return response([
                'error' => 1,
                'description' => 'An unexpected error has occurred.'
            ]);
        }
    }
}
