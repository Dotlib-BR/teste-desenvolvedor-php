<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; // Certifique-se de que o modelo Job existe
use App\Models\Candidate; // Certifique-se de que o modelo Candidate existe

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Adicionar middleware de autenticação para garantir que apenas usuários autenticados possam acessar
    }

    public function index()
    {
        $totalJobs = Job::count(); // Pega o total de vagas
        $totalCandidates = Candidate::count(); // Pega o total de candidatos

        return view('dashboard', compact('totalJobs', 'totalCandidates'));
    }
}
