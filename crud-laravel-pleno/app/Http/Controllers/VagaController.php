<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Inscricao;
use Illuminate\Support\Facades\Auth;


class VagaController extends Controller
{
    public function index()
    {
        $vagas = Vaga::all();
        return response()->json($vagas);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|string',
            'status' => 'required|string',
        ]);

        $vaga = Vaga::create($validatedData);

        return redirect('/');
    }

    public function show($id)
    {
        $vaga = Vaga::findOrFail($id);
        return response()->json($vaga);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'tipo' => 'required|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|in:Ativa,Pausada,Encerrada',
        ]);

        $vaga = Vaga::findOrFail($id);
        $vaga->update($validatedData);

        return response()->json($vaga);
    }

    public function destroy($id)
    {
        $vaga = Vaga::findOrFail($id);
        $vaga->delete();

        return response()->json(null, 204);
    }

    public function inscricao(Request $request, $vagaId)
    {
        $vaga = Vaga::findOrFail($vagaId);

        // Verificar se a vaga está ativa e aberta para inscrições
        if ($vaga->status !== 'Ativa') {
            return redirect()->back()->with('error', 'Esta vaga não está aberta para inscrições no momento.');
        }

        // Verificar se o candidato já está inscrito na vaga
        $candidato = Auth::user(); // Obtém o usuário autenticado (candidato)
        $inscricaoExistente = Inscricao::where('vaga_id', $vagaId)
            ->where('candidato_id', $candidato->id)
            ->exists();

        if ($inscricaoExistente) {
            return redirect()->back()->with('error', 'Você já está inscrito nesta vaga.');
        }

        // Criação da inscrição
        $inscricao = new Inscricao([
            'vaga_id' => $vaga->id,
            'candidato_id' => $candidato->id,
            'data_inscricao' => now(),
        ]);
        $inscricao->save();

        return redirect(route('vagas.index'))->with('success', 'Inscrição realizada com sucesso.');
    }
}
