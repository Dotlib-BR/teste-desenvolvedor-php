<?php

namespace App\Http\Controllers\Zeus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BulkActionController extends Controller
{
    public function __construct()
    {
        // Caso dê algo errado nos métodos que fazem alterações no banco eu uso o DB::beginTransaction()
        $this->middleware('db.transaction');
    }

    public function destroy(Request $request)
    {

        try {
            $ids = array_unique($request->ids);// no caso de pedidos de compra para não causar erro 500

            $modelsNamespace = '\\App\\Models\\';

            //Excluindo dessa forma eu aciono o listener de deleted no observer dos itens excluidos;
            foreach ($ids as $id) {
                $object = ($modelsNamespace . $request->model)::find($id);

                if (! empty($object)) {
                    $object->delete();
                }
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);// 500
        }

        return response()->json($request->all(), Response::HTTP_NO_CONTENT);
    }
}
