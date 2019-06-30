@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title">Informações do Produto</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-8 col-md-9 col-lg-10">
                            @if ($product->name)
                                <p>
                                    <strong>Nome:</strong><br />
                                    {{ $product->name }}
                                </p>
                            @endif

                            @if ($product->price)
                            <p>
                                <strong>Preço:</strong><br />
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                            @endif

                            @if ($product->code)
                            <p>
                                <strong>Código de barras:</strong><br />
                                {{ $product->code }}
                            </p>
                            @endif
                        </div>
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-block">Editar produto</a>
                            <a href="{{ route('products.destroy', $product->id) }}" class="btn btn-danger btn-block destroy-action">Excluir produto</a>
                        </div>
                    </div>

                    <form action="" method="post" id="destroy-single">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            function swalConfirm(callback) {
                window.swal.fire({
                    type: 'warning',
                    title: 'Você tem certeza?',
                    text: 'Você não poderá reverter esta ação.',
                    showCancelButton: true,
                    cancelButtonColor: '#b0b0b0',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#e3342f',
                    confirmButtonText: 'Sim, exclua!'
                }).then(function(result) {
                    if (result.value) {
                        callback();
                    }
                });

                $('body').removeClass('swal2-height-auto');
            }

            $('.destroy-action').on('click', function(e) {
                e.preventDefault();

                var action = $(this).attr('href');

                swalConfirm(function() {
                    $('#destroy-single')
                        .attr('action', action)
                        .submit();
                });
            });
        });
    </script>
@endpush
