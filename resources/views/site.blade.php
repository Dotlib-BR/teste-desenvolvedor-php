@extends('layouts.app')

@section('content')
      <section class="section">
        <div class="container">

            <div class="row">
                @foreach ($announcement as $a)
                <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                    <p>Título: {{ $a->title }}</p>
                    <article class="card shadow">
                    <img class="rounded card-img-top" src="images/blog/post-3.jpg" alt="post-thumb">
                    <div class="card-body">
                        <h4 class="card-title">Empresa: {{ $a->company->name}}
                        </h4>
                        <p class="cars-text">Descrição: {{ $a->description }}</p>
                        <a href="{{ route('login') }}" class="btn btn-xs btn-primary">Para se cadastrar acesse o sistema</a>
                    </div>
                    </article>
                </div>
                <hr>
                    @endforeach
            </div>
            {{ $announcement->links() }}
        </div>
      </section>
      @endsection

