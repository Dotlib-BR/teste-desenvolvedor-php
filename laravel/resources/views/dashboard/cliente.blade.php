@extends('layout.layout') 
@section('content')

<div class="col-md-12 p-3">
    <a class="btn btn-primary text-white mb-3 " id="novo-cliente">Novo</a>
    <input type="text" name="search" placeholder="Pesquisar..." class="form-control col-md-4 float-right mb-3">
</div>
<div class="col-md-12" style=" overflow: auto; max-height:400px">

    <table class="table" id="tabela-clientes"></table>

</div>


<div class="col-md-12" id="paginacao" sytle="margin-top:10px;"></div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="titulo-modal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                <button type="button" class="btn btn-primary" id="salvar">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script src="{{URL('js/clientes.js')}}"></script>
@endsection