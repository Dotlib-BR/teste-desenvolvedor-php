<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateAdminController extends Controller
{
    public function index()
    {
        $candidates = Candidate::paginate(20);
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email',
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);

        Candidate::create($validatedData);

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate created successfully.');
    }

    public function show(Candidate $candidate)
    {
        return view('admin.candidates.show', compact('candidate'));
    }

    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,' . $candidate->id,
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);

        $candidate->update($validatedData);

        return redirect()->route('admin.candidates.index')->with('success', 'Dados do candidato atualizados.');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('admin.candidates.index')->with('success', 'Candidato removido.');
    }
}
