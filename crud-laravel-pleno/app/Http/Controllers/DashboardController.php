<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Candidate;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        // Contar o número total de trabalhos, candidatos e inscrições
        $totalJobs = Job::count();
        $totalCandidates = Candidate::count();
        $totalApplications = Application::count();

        // Recuperar os trabalhos mais recentes
        $recentJobs = Job::latest()->take(5)->get();

        // Recuperar as inscrições mais recentes
        $recentApplications = Application::with('job', 'candidate')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalJobs' => $totalJobs,
            'totalCandidates' => $totalCandidates,
            'totalApplications' => $totalApplications,
            'recentJobs' => $recentJobs,
            'recentApplications' => $recentApplications,
        ]);
    }
}
