@extends('layouts.candidato')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        <div id="filter-panel" class="collapse filter-panel mb-3">
            <div class="card card-default">
                <div class="card-body">
                    <form class="form-vertical" role="form" method="get" action="{{ route('dashboard.candidato.inscricoes') }}">
                        <div class="form-group row">
                            <div class="col-sm-3 col-md-1">
                                <label for="perpage" class="col-md-6 col-form-label text-md-right">Exibir: </label>
                                <div class="col-md-12">
                                    <select id="perpage" class="form-control" name="perpage">
                                        <option value="8" selected>8</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <label class="col-md-6 col-form-label text-md-right" for="orderby">Ordernar por:</label>

                                <div class="col-md-12">
                                    <select id="orderby" class="form-control" name="order">
                                        <option value="id">ID</option>
                                        <option value="titulo">Titulo</option>
                                        <option value="descricao">Descrição</option>
                                        <option value="categoria">Categoria</option>
                                        <option value="nivel">Nível</option>
                                        <option value="regime">Regime</option>
                                        <option value="salario">Salário</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-2">
                                <label class="col-md-6 col-form-label text-md-right" for="orderby">de forma:</label>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="orderType" id="asc" value="asc" checked>
                                          Ascendência
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="orderType" id="desc" value="desc">
                                          Descendência
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <label class="col-md-6 col-form-label text-md-right" for="search">Pesquisa por termos:</label>

                                <div class="col-md-12">
                                    <input type="text" class="form-control input-sm" id="search" name="search">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">

                            <button type="submit" class="btn btn-sm btn-primary">
                                <span class="fa fa-filter"></span> Filtrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter-panel" aria-expanded="false" aria-controls="filter-panel">
                    <span class="fa fa-cog"></span> Filtros
                </button>
            </div>
        </div>
	</div>

    <div class="row justify-content-start">
        @forelse($vagas as $vaga)
        <div class="col-md-5 col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch my-2">
            <div class="card shadow-lg border-0 py-2" @if($vaga->pivot->status != "ativo") data-toggle="tooltip" data-placement="top" title="{{$vaga->pivot->status}}" style="background-color: lightgrey;" @endif >
                <div class="card-header border-0 mb-0">
                    <div class="row justify-content-between">
                        <div class="col-auto col-sm-auto col-md-auto col-lg-auto">
                            <h6> <span class="badge rounded-pill bg-primary">{{$vaga->categoria}}</span></h6>
                            <h6> <span class="badge rounded-pill bg-primary">{{$vaga->nivel}}</span></h6>
                        </div>
                        <div class="col-auto col-sm-auto col-md-auto col-lg-auto">
                            <div class="row mx-auto pt-2">
                                <div class="col-6 col-md-4 col-lg-3">
                                    <img src="{{asset('img/salary.png')}}" alt="" width="20" height="20" >
                                </div>
                                <div class="col-6 col-md-8 col-lg-9">
                                    <h5>{{number_format($vaga->salario, 2, ',' , '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" card-body text-center pb-0 mt-0 pt-3">
                    <div class="d-block">
                        <h5 class="card-title mb-0 font-weight-bold">{{$vaga->titulo}} @if($vaga->pivot->status == "ativo") <i class="fa fa-check" style="color:green;"></i> @else <i class="fa fa-times" style="color:red;"></i> @endif </h5> <small class="text-info my-1"> <i class="fa fa-file-code-o small"></i> {{$vaga->empresa->nome}}</small>
                    </div>
                    <div class="d-inline-flex row mb-3 ">
                        <div class="col-md-auto">

                            <ul class="list-inline my-0">
                                @foreach($vaga->tags as $tag)
                                    <li class="list-inline-item"> <span class="badge rounded-pill bg-primary ">{{$tag->nome}}</span></li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <div class="d-flex row mb-0">
                        <div class="col">
                            <p class="text-muted"> {!! \Illuminate\Support\Str::limit($vaga->descricao, 100) !!} </p>
                            <p>Data Inscrição: {{ \Carbon\Carbon::parse($vaga->pivot->aplicado_em)->format('d-m-Y H:i:s')}}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <hr class="mx-auto w-25">
                </div>
                <div class="card-footer border-0">
                    <div class="row justify-content-center">
                        <div class="col-md-3 px-0">
                            <a href="{{ route('site.vaga', $vaga->slug) }}" class="btn btn-sm btn-outline-primary">Visualizar</a>
                        </div>
                        @if($vaga->pivot->status == "ativo")
                        <div class="col-md-3 px-0">
                            <a href="{{ route('dashboard.candidato.inscricao.cancelar', ['slug' => $vaga->slug]) }}" class="btn btn-sm btn-outline-primary" onclick="return confirm('Tem certeza que deseja desistir dessa vaga?') ">Cancelar</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center my-2 d-flex align-items-stretch">
            <div class="alert alert-info">Nenhuma vaga para mostrar</div>
        </div>
        @endforelse

        <div class="d-flex justify-content-center mt-3">
            {!! $vagas->links() !!}
        </div>
    </div>
</div>
@endsection
