<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('candidates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:candidates',
            'experience' => 'required|string',
            'skills' => 'required|string',
            'availability' => 'required|string|max:255'
        ]);

        Candidate::create($data);

        return redirect()->route('candidates.index')->with('status', 'Candidato criado com sucesso!');
    }

    public function edit(Candidate $candidate)
    {
        return view('candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:candidates,email,' . $candidate->id,
            'experience' => 'required|string',
            'skills' => 'required|string',
            'availability' => 'required|string|max:255'
        ]);

        $candidate->update($data);

        return redirect()->route('candidates.index')->with('status', 'Candidato atualizado com sucesso!');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('status', 'Candidato excluído com sucesso!');
    }
}
