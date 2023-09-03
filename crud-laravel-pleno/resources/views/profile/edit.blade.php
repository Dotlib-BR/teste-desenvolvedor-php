<!-- resources/views/profile/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <!-- ... campos para editar o perfil ... -->

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
