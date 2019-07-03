@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>
        <form method="GET">
            <div class="form-group row">
                <div class="col-md-3">
                    <select name="per_page" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option data-icon="fa fa-sort">Itens por página</option>
                        <option value="5" data-subtext="Itens por página">5</option>
                        <option value="10" data-subtext="Itens por página">10</option>
                        <option value="15" data-subtext="Itens por página">15</option>
                        <option value="20" data-subtext="Itens por página">20</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="column" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="name" data-icon="fa fa-filter">Nome</option>
                        <option value="email" data-icon="fa fa-filter">Email</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="order_by" onchange="this.form.submit()" class="selectpicker" data-width="100%" data-style="btn-success">
                        <option value="asc" data-icon="fa fa-sort-alpha-asc" >Ascendente</option>
                        <option value="desc" data-icon="fa fa-sort-alpha-desc" >Descendente</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input name="search" class="form-control" id="enterSearch" type="search" placeholder="Buscar" aria-label="Search">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <table class="table bg-dotlib table-responsive-sm mt-2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
