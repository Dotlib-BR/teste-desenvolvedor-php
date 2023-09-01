<div class="container">
    <h1>Dashboard</h1>
    
    <p>Total de Trabalhos: {{ $totalJobs }}</p>
    <p>Total de Candidatos: {{ $totalCandidates }}</p>
    <p>Total de Inscrições: {{ $totalApplications }}</p>
    
    <h2>Trabalhos Recentes</h2>
    <ul>
        @foreach ($recentJobs as $job)
            <li>{{ $job->title }}</li>
        @endforeach
    </ul>
    
    <h2>Inscrições Recentes</h2>
    <ul>
        @foreach ($recentApplications as $application)
            <li>{{ $application->candidate->name }} se inscreveu para {{ $application->job->title }}</li>
        @endforeach
    </ul>
</div>
