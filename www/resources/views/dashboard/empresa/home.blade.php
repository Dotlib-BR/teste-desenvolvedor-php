@extends('layouts.empresa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary mb-3">
                <div class="card-header">{{ __('empresa') }}</div>

                <div class="card-body">
                    {{ __('Bem vindo!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
