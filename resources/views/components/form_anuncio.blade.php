@if (isset($anuncio->id))
<form action="{{ route('anuncio.update', $anuncio->id) }}" method="POST">
    @csrf
    @method('PUT')
@else
<form action="{{ route('anuncio.store') }}" method="POST">
    @csrf
@endif
<div class="form-group @error('empresa_id') has-error @enderror">
    <label>Empresa</label>
    <select class="form-control" name="empresa_id">
        <option value="">Escolha uma opção</option>
        @foreach ($empresas as $index)
            <option
            @if (!empty($anuncio))
                {{$index->empresa->id == $anuncio->empresa->id  ? 'selected' : '' }}
            @else
                {{ old('empresa_id') == $index->empresa->id ? 'selected' : '' }}
            @endif
                value="{{ $index->empresa->id }}">{{ $index->empresa->nome }}</option>
        @endforeach
    </select>
    @if ($errors->has('empresa_id'))
        <div class="class text-danger">{{ $errors->first('empresa_id') }}</div>
    @endif
</div>
<div class="form-group @error('titulo') has-error @enderror">
    <label>Título</label>
    <input type="text" class="form-control input-default" name="titulo" value="{{ $anuncio->titulo ?? old('titulo') ?? '' }}"
        placeholder="Título">
    @if ($errors->has('titulo'))
        <div class="class text-danger">{{ $errors->first('titulo') }}</div>
    @endif
</div>
<div class="form-group  @error('remuneracao') has-error @enderror">
    <label>Salário *apenas tipos númericos</label>
    <input type="number" class="form-control input-default" value="{{ $anuncio->remuneracao ?? old('remuneracao') ?? '' }}" name="remuneracao"
        placeholder="Salário">
    @if ($errors->has('remuneracao'))
        <div class="class text-danger">{{ $errors->first('remuneracao') }}</div>
    @endif
</div>
<div class="form-group  @error('tipo_vaga') has-error @enderror">
    <label>Tipo de contrato</label>
    <select class="form-control" name="tipo_vaga">
        <option value="">Escolha uma opção</option>
        @foreach ($tipo_contrato as $contrato)
            <option
            @if (!empty($anuncio))
                {{$contrato == $anuncio->tipo_vaga  ? 'selected' : '' }}
            @else
                {{ old('tipo_vaga') == $contrato ? 'selected' : '' }}
            @endif
            value="{{ $contrato }}">
                {{ $contrato }}</option>
        @endforeach
    </select>
    @if ($errors->has('tipo_vaga'))
        <div class="class text-danger">{{ $errors->first('tipo_vaga') }}</div>
    @endif
</div>
<div class="form-group @error('descricao') has-error @enderror">
    <label>Descrição</label>
    <textarea class="form-control" rows="3" placeholder="Descrição" name="descricao"
        style="margin-top: 0px; margin-bottom: 0px; height: 251px;">{{  $anuncio->descricao ?? old('descricao') ?? '' }}</textarea>
    @if ($errors->has('descricao'))
        <div class="class text-danger">{{ $errors->first('descricao') }}</div>
    @endif
</div>
<button type="submit" class="btn btn-primary btn-flat m-b-10 m-l-5">Salvar</button>
</form>
