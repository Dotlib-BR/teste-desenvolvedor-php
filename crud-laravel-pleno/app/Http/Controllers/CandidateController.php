<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::paginate(20);
        return response()->json($candidates);
    }
  
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates',
        ]);
    
        Candidate::create($validatedData);
    
        return redirect(route('home'));
    }

    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        return response()->json($candidate);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:candidates,email,'.$id,
            'experience' => 'nullable|string',
            'skills' => 'nullable|string',
            'availability' => 'nullable|string',
        ]);

        $candidate = Candidate::findOrFail($id);
        $candidate->update($validatedData);

        return response()->json($candidate);
    }

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return response()->json(null, 204);
    }
}
