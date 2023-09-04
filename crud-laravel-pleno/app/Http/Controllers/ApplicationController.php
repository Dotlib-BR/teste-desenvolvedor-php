<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $application = Application::create($request->all());
        return redirect()->route('applications.index')->with('status', 'Inscrição criada com sucesso!');
    }

    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    public function edit(Application $application)
    {
        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $application->update($request->all());
        return redirect()->route('applications.index')->with('status', 'Inscrição atualizada com sucesso!');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('applications.index')->with('status', 'Inscrição excluída com sucesso!');
    }
}
