<?php

namespace App\Http\Controllers\Dashboard\Candidato;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InscricoesController extends Controller
{

    public function inscricoes(Request $request){

        $candidato_id = auth()->user()->candidato->id;

        try {
            $vagas = Candidato::with(['vagasinscritas' => function($query) use($request){
                $query->when(!is_null($request->search), function($query) use($request) {
                    $query->where('titulo', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('descricao', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('nivel', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('categoria', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('regime', 'LIKE', '%' . $request->search . '%');
                })->when(!is_null($request->order) && !is_null($request->orderType), function($query) use($request) {
                    $query->orderBy($request->order, $request->orderType);
                });
            }])->findOrFail($candidato_id)->vagasinscritas->paginate(!is_null($request->perpage) ? $request->perpage : 20);

            return view('dashboard.candidato.inscricoes', compact('vagas'));


        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {
            $notification = array(
                'message' => 'Candidato não localizado',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        } catch( \Exception $e){
            dd($e);
            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function cancelar(Request $request, $slug){

        $candidato_id = auth()->user()->candidato->id;
        try {

            $vaga_id = Vaga::where('slug', '=', $slug)->firstOrFail()->id;

            DB::table('candidato_vaga')->where('vaga_id','=',$vaga_id)
            ->where('candidato_id', '=', $candidato_id)->update([
                "status" => "cancelado"
            ]);

            $notification = array(
                'message' => 'Você desistiu da vaga',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $notification = array(
                'message' => 'Vaga não encontrada',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);

        } catch( \Exception $e){

            $notification = array(
                'message' => 'Erro no Servidor',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
