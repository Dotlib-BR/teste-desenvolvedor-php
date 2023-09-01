<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'status' => 'required|string',
        ]);

        $job = Job::create($validatedData);

        return redirect('/');
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:CLT,Pessoa Jurídica,Freelancer',
            'status' => 'required|in:Active,Pausada,Encerrada', // Changed from Ativa to Active
        ]);

        $job = Job::findOrFail($id);
        $job->update($validatedData);

        return response()->json($job);
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json(null, 204);
    }

    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        // Check if the job is active and open for applications
        if ($job->status !== 'Active') { // Changed from Ativa to Active
            return redirect()->back()->with('error', 'This job is not open for applications at the moment.');
        }

        // Check if the candidate is already applied for the job
        $candidate = Auth::user(); // Get the authenticated user (candidate)
        $applicationExists = Application::where('job_id', $jobId)
            ->where('candidate_id', $candidate->id)
            ->exists();

        if ($applicationExists) {
            return redirect()->back()->with('error', 'You are already applied for this job.');
        }

        // Creating the application
        $application = new Application([
            'job_id' => $job->id,
            'candidate_id' => $candidate->id,
            'application_date' => now(),
        ]);
        $application->save();

        return redirect(route('jobs.index'))->with('success', 'Application submitted successfully.');
    }
}
