@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edite a Inscrição</h2>
    <form action="{{ route('applications.update', $application->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="job_id">Vaga:</label>
            <select name="job_id" class="form-control">
                @foreach($jobs as $job)
                    <option value="{{ $job->id }}" {{ $job->id === $application->job_id ? 'selected' : '' }}>
                        {{ $job->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="candidate_id">Candidate:</label>
            <select name="candidate_id" class="form-control">
                @foreach($candidates as $candidate)
                    <option value="{{ $candidate->id }}" {{ $candidate->id === $application->candidate_id ? 'selected' : '' }}>
                        {{ $candidate->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="application_date">Data da Inscrição:</label>
            <input type="date" name="application_date" class="form-control" value="{{ $application->application_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
