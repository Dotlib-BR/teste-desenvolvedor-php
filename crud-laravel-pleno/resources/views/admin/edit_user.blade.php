@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form method="POST" action="{{ route('admin.users.update') }}">
        @csrf

        <!-- ... campos para editar usuário ... -->

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
