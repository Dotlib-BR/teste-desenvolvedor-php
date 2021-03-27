{{-- Erros padrões do Validador --}}
@if (count($errors))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="fa fa-times-circle"></i> Erro!</h4>
    {!! implode('<br>', $errors->all()) !!}
</div>
@endif

{{-- Mensagem personalizada --}}
@if (Session::has('msg'))
<div class="alert alert-{{ (Session::get('error')) ? 'danger' : 'success' }} alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-{{ (Session::get('error')) ? 'ban' : 'check' }}"></i> {{ (Session::get('error')) ? 'Erro' : 'Sucesso' }}!</h4>
  {{Session::get('msg')}}
</div>
@endif
