<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationAdminController extends Controller
{
    public function index()
    {
        $applications = Application::paginate(20);
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('admin.applications.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'candidate_id' => 'required|exists:candidates,id',
            'application_date' => 'required|date',
        ]);

        Application::create($validatedData);

        return redirect()->route('admin.applications.index')->with('success', 'Inscrição criada com sucesso.');
    }

    public function show(Application $application)
    {
        return view('admin.applications.show', compact('application'));
    }

    public function edit(Application $application)
    {
        return view('admin.applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'candidate_id' => 'required|exists:candidates,id',
            'application_date' => 'required|date',
        ]);

        $application->update($validatedData);

        return redirect()->route('admin.applications.index')->with('success', 'Inscrição atualizada.');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('admin.applications.index')->with('success', 'Inscrição apagada.');
    }
}
