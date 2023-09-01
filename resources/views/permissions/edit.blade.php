@extends('layouts.app-master') 

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Permissões</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Permissões</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="bg-light p-4 rounded">
                    <div class="lead">
                        Editar e gerenciar as permissões para a permissão <b>"{{ ucfirst($permission->name) }}"</b>.
                    </div>

                    <div class="container mt-4">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Houveram alguns problemas com sua solicitação.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                            @method('patch')
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ $permission->name }}"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Name" required>

                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-default">Voltar</a>
                        </form>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
$('[name="all_permission"]').on('click', function() {
if($(this).is(':checked')) {
    $.each($('.permission'), function() {
        $(this).prop('checked',true);
    });
} else {
    $.each($('.permission'), function() {
        $(this).prop('checked',false);
    });
}
});
});
</script>
@endsection
