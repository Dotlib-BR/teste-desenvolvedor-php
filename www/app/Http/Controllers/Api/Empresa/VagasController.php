<?php

namespace App\Http\Controllers\Api\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Vaga;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VagasController extends Controller
{

    public function index(Request $request)
    {
        $vagas = Vaga::when(!is_null($request->order), function($query) use($request){
            $query->orderBy('id', $request->order);
        })
        ->when(!is_null($request->titulo), function($query) use($request) {
            $query->where('titulo', 'LIKE', '%' . $request->titulo . '%');
        })
        ->when(!is_null($request->slug), function($query) use($request) {
            $query->where('slug', 'LIKE', '%' . $request->slug . '%');
        })
        ->when(!is_null($request->descricao), function($query) use($request) {
            $query->where('descricao', 'LIKE', '%' . $request->descricao . '%');
        })
        ->when(!is_null($request->nivel), function($query) use($request) {
            $query->where('nivel', 'LIKE', '%' . $request->nivel . '%');
        })
        ->when(!is_null($request->categoria), function($query) use($request) {
            $query->where('categoria', 'LIKE', '%' . $request->categoria . '%');
        })
        ->when(!is_null($request->regime), function($query) use($request) {
            $query->where('regime', 'LIKE', '%' . $request->regime . '%');
        })
        ->when(!is_null($request->salario), function($query) use($request) {
            $query->where('salario', '>', $request->salario);
        })
        ->where('empresa_id', '=', auth('api')->user()->empresa->id)
        ->paginate(!is_null($request->paginate) ? $request->paginate : 5);

        return response()->json($vagas, 200);
    }

    public function store(Request $request)
    {
        try {

            $dados = $request->all();
            $dados['slug'] = Str::slug($dados['titulo']);

            $empresa = Empresa::findOrFail(auth('api')->user()->empresa->id);
            $empresa->vagas()->create($dados);

            return response()->json(['message' => 'Uma nova vaga foi criada'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao criar a nova vaga', 'erroMessage' => $e->getMessage(), 'errorTrace' => $e->getTraceAsString(), 'errorLine' => $e->getLine(), 'errorFile' => $e->getFile()], 400);
        }
    }

    public function show($id)
    {
        try {
            $vaga = Vaga::with('candidatos')->where('empresa_id', '=', auth('api')->user()->empresa->id)->findOrFail($id);

            return response()->json($vaga, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json('Vaga não encontrada', 404);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Não foi possível recuperar a vaga', 'erroMessage' => $e->getMessage(), 'errorTrace' => $e->getTraceAsString(), 'errorLine' => $e->getLine(), 'errorFile' => $e->getFile()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dados = $request->all();
            $dados['slug'] = Str::slug($dados['titulo']);

            Vaga::where('empresa_id', '=', auth('api')->user()->empresa->id)->findOrFail($id)->update($dados);

            return response()->json('A vaga foi atualizada', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar a nova vaga', 'erroMessage' => $e->getMessage(), 'errorTrace' => $e->getTraceAsString(), 'errorLine' => $e->getLine(), 'errorFile' => $e->getFile()], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $vaga = Vaga::where('empresa_id', '=', auth('api')->user()->empresa->id)->findOrFail($id);
            $vaga->delete();

            return response()->json('A vaga foi deletada', 200);

        } catch (ModelNotFoundException $e) {
            return response()->json('Vaga não encontrada', 404);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Não foi possível excluir a vaga', 'erroMessage' => $e->getMessage(), 'errorTrace' => $e->getTraceAsString(), 'errorLine' => $e->getLine(), 'errorFile' => $e->getFile()], 500);
        }
    }

    public function pause(Request $request, $id){
        try {
            $vaga = Vaga::where('empresa_id', '=', auth('api')->user()->empresa->id)->findOrFail($id);

            $vaga->update([
                'is_paused' => $request->pause,
            ]);

            return response()->json($request->pause == 1 ? 'Vaga selecionada foi pausada para novos candidatos' : 'Vaga selecionada voltou a aceitar candidatos', 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return response()->json('Vaga não encontrada', 404);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao pausar ou despausar a vaga', 'erroMessage' => $e->getMessage(), 'errorTrace' => $e->getTraceAsString(), 'errorLine' => $e->getLine(), 'errorFile' => $e->getFile()], 400);
        }
    }
}
