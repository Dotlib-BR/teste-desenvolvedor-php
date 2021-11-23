@extends('layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    @if (session('user_update'))
                        <div class="alert alert-success" id="msg">
                            {{ session('user_update') }}
                        </div>
                    @endif
                </div>
                @component('components.form_isMe', ['usuario' => $info])

                @endcomponent

            </div>
        </div>
    </div>
@endsection
