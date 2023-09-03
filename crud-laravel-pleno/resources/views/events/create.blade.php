@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Event</h2>
    <form method="POST" action="{{ route('events.store') }}">
        @csrf

        <!-- ... campos para criar novo evento ... -->

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
@endsection
