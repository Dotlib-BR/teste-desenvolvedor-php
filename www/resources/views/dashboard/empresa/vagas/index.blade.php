@extends('layouts.empresa')

@section('content')
<div class="container-fluid px-5">
    <div class="row">
        <div id="filter-panel" class="collapse mb-3">
            <div class="card card-default">
                <div class="card-body">
                    <form class="form-vertical" role="form" method="get" action="{{ route('dashboard.empresa.vagas.index') }}">
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
        <div class="row justify-content-between">
            <div class="col-12 col-sm-12 col-md-1">
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter-panel" aria-expanded="false" aria-controls="filter-panel">
                    <span class="fa fa-cog"></span> Filtros
                </button>
            </div>
            <div class="col-12 col-sm-12 col-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" onchange=" if(this.checked) marcarTodos(this) " id="flagAll">
                    <label class="form-check-label" for="flagAll">
                        Selecionar todos
                    </label>

                    <button class="btn btn-sm btn-warning" id="vagasMassDelete">Deletar em massa</button>

                </div>
            </div>
        </div>
	</div>

    <div class="row justify-content-start">
        @forelse($vagas as $vaga)
        <div class="col-md-5 col-lg-4 col-xl-3 col-sm-6 d-flex align-items-stretch my-2">
            <div class="card shadow-lg border-0 py-2">
                <div class="card-header border-0 mb-0">
                    <div class="row justify-content-between">
                        <div class="col-auto col-sm-auto col-md-auto col-lg-auto">
                            <h5> <span class="badge rounded-pill bg-primary">{{$vaga->nivel}}</span></h5>
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
                <div class="card-body text-center pb-0 mt-0 pt-3">
                    <div class="d-block">
                        <h5 class="card-title mb-0 font-weight-bold">{{$vaga->titulo}}</h5> <small class="text-info my-1"> <i class="fa fa-file-code-o small"></i> {{$vaga->empresa->nome}}</small>
                    </div>
                    <div class="d-inline-flex row mb-3 ">
                        <div class="col-md-auto">

                            <ul class="list-inline my-0">
                                @if(!$vaga->tags->isEmpty())
                                @foreach($vaga->tags->random(4) as $tag)
                                    <li class="list-inline-item"> <span class="badge rounded-pill bg-primary ">{{$tag->nome}}</span></li>
                                @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>
                    <div class="d-flex row mb-0">
                        <div class="col">
                            <p class="text-muted"> {!! \Illuminate\Support\Str::limit($vaga->descricao, 100) !!} </p>
                        </div>
                    </div>

                </div>
                <div>
                    <hr class="mx-auto w-25">
                </div>
                <div class="card-footer border-0 text-center">
                    <div class="row justify-content-center">
                        <div class="col-md-10 px-0">
                            <a href="{{ route('dashboard.empresa.vagas.show', $vaga->slug) }}" class="btn btn-sm btn-outline-primary" title="Visualizar"><i class="fa fa-eye"> </i> </a>
                            <a href="{{ route('dashboard.empresa.vagas.edit', $vaga->slug) }}" class="btn btn-sm btn-outline-primary" title="Editar"><i class="fa fa-pencil-alt"> </i> </a>
                            <form action="{{ route('dashboard.empresa.vagas.destroy', $vaga->slug) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-primary" title="Excluir" onclick="return confirm('Deseja excluir a vaga?')"><i class="fa fa-trash"></i></button>
                            </form>
                            @if($vaga->is_paused)
                            <a href="{{ route('dashboard.empresa.vaga.pause', ['slug' => $vaga->slug, 'pause' => 0]) }}" class="btn btn-sm btn-outline-primary" title="Despausar vaga" onclick="return confirm('Deseja despausar a vaga?')"><i class="far fa-play-circle"> </i></a>
                            @else
                            <a href="{{ route('dashboard.empresa.vaga.pause', ['slug' => $vaga->slug, 'pause' => 1]) }}" class="btn btn-sm btn-outline-primary" title="Pausar vaga" onclick="return confirm('Deseja pausar a vaga?')"><i class="far fa-pause-circle"> </i></a>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" class="vagas_checkbox" name="vagas[]" value="{{$vaga->id}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-info">Nenhuma vaga para mostrar</div>
            </div>
        </div>
        @endforelse

        <div class="d-flex justify-content-center mt-3">
            {!! $vagas->links() !!}
        </div>
    </div>

</div>
@endsection

@section('javascript')

<script>

    $('#flagAll').on("click", function(){

        checkboxes = document.getElementsByClassName('vagas_checkbox');

        if($(this).is(":checked")){

            for(i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = true ;
            }

            if(checkboxes.length == 0){
                toastr.warning('Não há vagas para selecionar');
            }
        }else{
            for(i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = false ;
            }
        }
    })
    function marcarTodos(main) {
        console.log(main.checked );

    }

    $('#vagasMassDelete').on("click", function(){

        if( confirm('Deseja realmente remover todas as vagas?') ){
            var checked = $('.vagas_checkbox:checked')
            checkboxcheck = [];

            if(checked.length > 0){
                for (var i = 0; i < checked.length; i++) {
                    checkboxcheck.push(checked[i].value);
                }
            }else{
                toastr.error('Nenhum vaga foi selecionada');
            }

            $.ajax({
                url: "{{route('dashboard.empresa.vagas.mass-delete')}}",
                method: "DELETE",
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    vagasIds: checkboxcheck
                },
                success: function(data) {
                    toastr.success(data.message);
                    setTimeout(function() {
                        location.reload(true);
                    }, 4000);
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    toastr.error(err);
                }
            });

        }

    });
</script>

@endsection
