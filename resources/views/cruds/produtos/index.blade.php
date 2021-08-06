@extends('master.main')
@section('main')
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Código de Barras</th>
            <th scope="col">Valor</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{}}</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        </tbody>
    </table>
@endsection
