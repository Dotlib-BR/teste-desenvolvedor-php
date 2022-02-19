@extends('_template')

@section('content')
    <h1 class="text-center my-5">{{ucfirst($table) }}</h1>
    <div class="row" style=" margin: 0px !important;">
        <div class="col col-md-2 col-lg-3"></div>
        <div class="col-12 col-md-8 col-lg-6">
            @foreach ($search as $key => $value)
                <p class="bg-light"><span class="fw-bold">{{ $key }} </span> : <span>{{ $value }}</span></p>
            @endforeach

        </div>
        <div class="col col-md-2 col-lg-3"></div>
    </div>
@endsection
