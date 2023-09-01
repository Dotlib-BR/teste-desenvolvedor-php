<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // ... (other methods)

    public function apply(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        // Check if the job is active and open for applications
        if ($job->status !== 'Active') {
            return redirect()->back()->with('error', 'Essa vaga não está recebendo inscrições no momento.');
        }

        // Check if the candidate is already applied for the job
        $candidate = Auth::user(); // Get the authenticated user (candidate)
        $applicationExists = Application::where('job_id', $jobId)
            ->where('candidate_id', $candidate->id)
            ->exists();

        if ($applicationExists) {
            return redirect()->back()->with('error', 'Você já se candidatou para esta vaga.');
        }

        // Creating the application
        $application = new Application([
            'job_id' => $job->id,
            'candidate_id' => $candidate->id,
            'application_date' => now(),
        ]);
        $application->save();

        return redirect(route('jobs.index'))->with('success', 'Sucesso ao se inscrever na vaga.');
    }
}
