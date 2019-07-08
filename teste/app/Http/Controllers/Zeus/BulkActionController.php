<?php

namespace App\Http\Controllers\Zeus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BulkActionController extends Controller
{
    public function destroy(Request $request)
    {
        $modelsNamespace = '\\App\\Models\\';

        ($modelsNamespace . $request->model)::whereIn('id', $request->ids)
            ->delete();

        return response()->json($request->all(), Response::HTTP_NO_CONTENT);
    }
}
