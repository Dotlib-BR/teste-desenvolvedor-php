<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobAdminController extends Controller
{
    public function index()
    {
        $jobs = Job::paginate(20);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|string|in:Ativa,Pausada,Encerrada',
        ]);

        Job::create($validatedData);

        return redirect()->route('admin.jobs.index')->with('success', 'Vaga criada com sucesso.');
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|string|in:Ativa,Pausada,Encerrada',
        ]);

        $job->update($validatedData);

        return redirect()->route('admin.jobs.index')->with('success', 'Dados da vaga atualizados com sucesso.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Vaga excluída com sucesso.');
    }
}
