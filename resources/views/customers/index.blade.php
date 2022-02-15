@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Clientes</h1>

                <a class="btn btn-primary mb-2" href="{{ route('customers.create') }}">Cadastrar cliente</a>

                @if(!empty($customers))
                    <table class="table table-bordered table-sm">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->cpf }}</td>
                            <td>{{ $customer->email }}</td>
                            <td class="d-flex justify-content-around">
                                <a class="btn btn-outline-info" href="{{ route('customers.edit', $customer) }}"><i class="fas fa-edit"></i></a>
                                <form id="delete-customer{{$customer->id}}" method="POST" action="{{ route('customers.destroy', $customer) }}">
                                    @csrf
                                    @method('DELETE')

<!--                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                    </div>-->
                                </form>
                                <a class="btn btn-outline-danger" href="#" onclick="deleteConfirm('delete-customer{{$customer->id}}')"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $customers->links() }}
                @else
                    <h2>Nenhum cliente cadastrado!</h2>
                @endif

            </div>
        </div>
    </div>
@endsection
