<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Candidato;
use App\Models\Vaga;
use App\Models\User;

class CandidatoController extends Controller
{
    public function index()
    {
        $candidatos = Candidato::paginate(20);
        return view('candidatos.index', compact('candidatos'));
    }

    public function create()
    {
        $vagas = Vaga::where('status', 'ativo')->get();
        return view('candidatos.create', compact('vagas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:candidatos,cpf',
            'email' => 'required|email|max:255|unique:candidatos,email',
            'vaga_id' => 'required|exists:vagas,id',
        ]);

        $candidato = new Candidato([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'vaga_id' => $request->vaga_id,
        ]);
        $candidato->save();

        return redirect()->route('listar-vagas')->with('success', 'Registro de candidato criado com sucesso.');
    }

    public function edit($id)
    {
        $candidato = Candidato::findOrFail($id);
        $vagas = Vaga::where('status', 'ativo')->get();
        return view('candidatos.edit', compact('candidato', 'vagas'));
    }

    public function update(Request $request, $id)
    {
        $candidato = Candidato::findOrFail($id);

        $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'vagas' => 'required|array',
            'vagas.*' => 'exists:vagas,id',
        ]);

        $candidato->update($request->only(['nome', 'email']));

        $vagas = Vaga::whereIn('id', $request->input('vagas'))->get();
        $candidato->vagas()->sync($vagas);

        return redirect()->route('candidatos.index')->with('success', 'Candidato atualizado com sucesso!');
    }

    public function destroy(Vaga $vaga, Candidato $candidato)
{
    // Verificar se o candidato pertence à vaga especificada
    if ($candidato->vaga_id === $vaga->id) {
        $candidato->delete();
        return redirect()->route('vagas.show', $vaga->id)->with('success', 'Candidato removido com sucesso.');
    } else {
        return redirect()->route('vagas.show', $vaga->id)->with('error', 'Erro ao remover candidato.');
    }
}
    public function registroCandidato(Vaga $vaga)
{
    return view('candidatos.registro', compact('vaga'));
}


public function candidatar(Request $request, Vaga $vaga)
{
    $user = Auth::user();

    if (!$vaga->candidatos()->where('id', $user->id)->exists()) {
        // Create a new candidate record
        $candidato = new Candidato();
        $candidato->nome = $user->name;
        $candidato->cpf = $request->cpf;
        $candidato->email = $request->email;
        $candidato->vaga_id = $vaga->id;
        $candidato->user_id = $user->id;
        $candidato->save();

        return redirect()->route('listar-vagas')->with('success', 'Candidatado com sucesso.');
    } else {
        return redirect()->route('listar-vagas')->with('error', 'Você já está candidatado para esta vaga.');
    }
}



public function vagasCandidato()
{
    $candidato = Auth::user()->candidato;
    return view('candidatos.vagas-candidato', compact('candidato'));
}
public function removerCandidatura(Vaga $vaga)
{
    Auth::user()->vagas()->detach($vaga);

    return redirect()->route('listar-vagas')->with('success', 'Candidatura removida com sucesso.');
}


}
