<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscricao;
use App\Models\Vaga;
use Illuminate\Support\Facades\Auth;

class InscricaoController extends Controller
{
    // ... (outras funções)

    public function inscrever(Request $request, $vagaId)
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
