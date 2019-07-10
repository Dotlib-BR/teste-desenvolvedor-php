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

        //Excluindo dessa forma eu aciono o listener de deleted no observer dos itens excluidos;
        foreach ($request->ids as $id) {
            ($modelsNamespace . $request->model)::find($id)
                ->delete();
        }

        return response()->json($request->all(), Response::HTTP_NO_CONTENT);
    }
}
