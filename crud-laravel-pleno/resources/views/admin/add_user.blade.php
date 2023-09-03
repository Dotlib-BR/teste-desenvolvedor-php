@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New User</h2>
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <!-- ... campos para adicionar novo usuário ... -->

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection
