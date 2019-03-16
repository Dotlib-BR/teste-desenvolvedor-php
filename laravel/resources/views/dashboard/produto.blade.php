@extends('layout.layout') 
@section('content')

<div class="com-md-12">
    <div class="form-group col-md-4 float-right">
        <input type="text" name="search"  placeholder="Pesquisar..." class="form-control">
    </div>
</div>
<div class="col-md-12" style=" overflow: auto; max-height:400px">

    <table class="table" id="tabela-produto">
        <thead>
            <th>ID</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Data Registro</th>
            <th>Data Atualização</th>
        </thead>
        <tbody>

        </tbody>
    </table>

</div>


<div class="col-md-12" id="paginacao" sytle="margin-top:10px;"></div>
<script src="{{URL('js/produtos.js')}}"></script>
@endsection