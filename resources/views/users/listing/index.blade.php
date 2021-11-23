@extends('layouts.dashboard')

@section('title', $title )

@section('content')

    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>
                            <a href="{{ route('user.adm.create') }}" class="btn btn-primary btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-plus"></i>Criar Usuário</a>
                        </h4>
                        @if (session('user_delete'))
                            <div class="alert alert-success" id="msg">
                                {{ session('user_delete') }}
                            </div>
                        @endif
                    </div>
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table id="table_id" class="display">
                                <thead>

                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Perfil</th>
                                        <th>Data de cadastro</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ formatarPerfil($user->admin, $user->user) }}</td>
                                            <td>{{ formatarData($user->created_at) }}</td>
                                            <td>
                                                <div class="btn-group">

                                                <a href="{{ route('user.adm.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Editar"><i class="ti-pencil"></i></a>
                                                <form action="{{ route('user.adm.delete',$user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Excluir" style="border-radius:0;"  onclick="return confirm('Deseja excluir o usuário?')"><i class="ti-trash"></i></button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
    </section>
</div>
@endsection

