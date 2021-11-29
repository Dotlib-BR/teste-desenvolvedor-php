<?php

namespace App\Http\Controllers\Api\Candidato;

use App\Exceptions\FileStorageException;
use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Vaga;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InscricoesController extends Controller
{
    public function inscricoes(){

        $candidato_id = auth('api')->user()->candidato->id;

        try {
            $vagas = Candidato::with('vagasinscritas')->findOrFail($candidato_id)->vagasinscritas->paginate(8);

            return response()->json($vagas, 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {

            return response()->json('Candidato não localizado', 404);

        } catch( \Exception $e){

            return response()->json('Erro no Servidor', 404);
        }
    }

    public function inscrever(Request $request, $vaga_id){

        $candidato_id = auth('api')->user()->candidato->id;
        try {

            $vaga = Vaga::with('candidatos')->findOrFail($vaga_id);

            $vaga_filter = $vaga->candidatos->filter(function($inscricao){
                return $inscricao->pivot->status == "ativo";
            });

            if( in_array($candidato_id, $vaga_filter->pluck('id')->toArray()) ){

                return response()->json('Você já está inscrito nessa vaga', 400);
            }

            $vaga->candidatos()->attach($candidato_id, [
                'aplicado_em' => Carbon::now(),
                'status' => 'ativo',
                'path_curriculo' => $this->uploadCurriculo($request)
            ]);

            return response()->json('Você foi inscrito nessa vaga', 200);

        }catch (ModelNotFoundException $m){

            return response()->json('Vaga não encontrada', 404);

        } catch (FileStorageException $fs){

            return response()->json('Erro ao armazenar o arquivo', 422);

        } catch (\Exception $e) {

            return response()->json('Erro no Servidor', 500);

        }
    }

    protected function uploadCurriculo(Request $request){

        if($request->hasFile('curriculo')){
            if(!Storage::disk('curriculo')->exists(auth('api')->user()->candidato->nome)){
                Storage::disk('curriculo')->makeDirectory(auth('api')->user()->candidato->nome);
            }

            $file = $request->file('curriculo');

            $filename = $file->getClientOriginalName();
            $path = $file->storeAs(auth('api')->user()->candidato->nome, $filename, 'curriculo');

            return $path;
        }else{
            throw new FileStorageException("Falha ao armazenar o arquivo", 0);
        }
    }
}
