<?php

namespace App\Http\Controllers\Dashboard\Empresa;

use App\Http\Controllers\Controller;
use App\Http\Requests\VagaRequest;
use App\Models\Empresa;
use App\Models\Tecnologia;
use App\Models\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VagaController extends Controller
{

    public function index(Request $request)
    {
        $vagas = Vaga::with('empresa', 'tags')
        ->when(!is_null($request->search), function($query) use($request) {
            $query->where('titulo', 'LIKE', '%' . $request->search . '%')
            ->orWhere('descricao', 'LIKE', '%' . $request->search . '%')
            ->orWhere('nivel', 'LIKE', '%' . $request->search . '%')
            ->orWhere('categoria', 'LIKE', '%' . $request->search . '%')
            ->orWhere('regime', 'LIKE', '%' . $request->search . '%');
        })
        ->when(!is_null($request->order) && !is_null($request->orderType), function($query) use($request) {
            $query->orderBy($request->order, $request->orderType);
        })->where('empresa_id', '=', auth()->user()->empresa->id)->paginate(8);

        return view('dashboard.empresa.vagas.index', compact('vagas'));

    }

    public function create()
    {
        return view('dashboard.empresa.vagas.create');
    }

    public function store(VagaRequest $request)
    {
        $empresa_id = auth()->user()->empresa->id;

        DB::beginTransaction();
        try {
            $vaga = Vaga::create([
                'empresa_id' => $empresa_id,
                'titulo' => $request->titulo,
                'slug' => Str::slug($request->titulo),
                'descricao' => $request->descricao,
                'nivel' => $request->nivel,
                'categoria' => $request->categoria,
                'regime' => $request->regime,
                'salario' => $request->salario,
                'is_paused' => $request->is_paused ? 1 : 0,
            ]);

            $tecnologias = explode(",", $request->tags);

            $vaga->tecnologias()->attach($tecnologias);

            DB::commit();

            $notification = array(
                'message' => 'A vaga foi cadastrada',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.empresa.vagas.show', $vaga->slug)->with($notification);

        } catch( \Exception $e){
            DB::rollBack();
            $notification = array(
                'message' => 'Erro no cadastrar vaga',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function show($slug)
    {
        try {
            $vaga = Vaga::with('empresa', 'tags')->where('slug', '=', $slug)->firstOrFail();

            return view('dashboard.empresa.vagas.show', compact('vaga'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $notification = array(
                'message' => 'Vaga não encontrada',
                'alert-type' => 'warning'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function edit($slug)
    {
        try {
            $vaga = Vaga::with('empresa', 'tags')->where('slug', '=', $slug)->firstOrFail();

            return view('dashboard.empresa.vagas.edit', compact('vaga'));

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

    public function update(VagaRequest $request, $id)
    {
        try {
            $vaga = Vaga::with('tags')->findOrFail($id);

            $vaga->update([
                'titulo' => $request->titulo,
                'slug' => Str::slug($request->titulo),
                'descricao' => $request->descricao,
                'nivel' => $request->nivel,
                'categoria' => $request->categoria,
                'regime' => $request->regime,
                'salario' => $request->salario,
                'is_paused' => $request->is_paused ? 1 : 0,
            ]);

            $tecnologias = explode(",", $request->tags);

            $vaga->tecnologias()->sync($tecnologias);

            $notification = array(
                'message' => 'A vaga foi atualizada',
                'alert-type' => 'success'
            );

            return redirect()->route('dashboard.empresa.vagas.show', $vaga->slug)->with($notification);

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

    public function destroy($slug)
    {
        try {
            $vaga = Vaga::with('tags')->where('slug', '=', $slug)->firstOrFail();

            $vaga->delete();

            $notification = array(
                'message' => 'A vaga selecionada foi deletada',
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

    public function massDelete(Request $request){
        try {
            $ids = $request->vagasIds;

            Vaga::whereIn('id', $ids)->delete();

            return response()->json(['message' => 'As vagas selecionadas foram removidas'], 200);

        } catch( \Exception $e){
            return response()->json(['message' => 'Falha ao remover as vagas selecionadas', 'errorMessage' => $e->getMessage()], 500);
        }
    }

    public function pause(Request $request, $slug){
        try {
            $vaga = Vaga::where('slug', '=', $slug)->firstOrFail();

            $vaga->update([
                'is_paused' => $request->pause,
            ]);

            $notification = array(
                'message' => $request->pause == 1 ? 'Vaga selecionada foi pausada para novos candidatos' : 'Vaga selecionada voltou a aceitar candidatos',
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

    public function tags(Request $request){
        $tags = Tecnologia::select('id','nome')->get();

        if($request->ajax())
        {
            return response()->json($tags)->header('Content-Type', 'application/json');
        }
    }
}
