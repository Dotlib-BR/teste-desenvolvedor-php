@if (isset($announcement->id))
    <form action="{{ route('announcement.adm.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $announcement->id }}">
    @else
        <form action="{{ route('announcement.adm.store') }}" method="POST">
            @csrf
@endif
<div class="form-group @error('empresa_id') has-error @enderror">
    <label>Empresa</label>
    <select class="form-control" name="company_id">
        <option value="">Escolha uma opção</option>
        @foreach ($companies as $index)
            <option @if (!empty($announcement))
                {{ $index->id == $announcement->company_id ? 'selected' : '' }}
            @else
                {{ old('company_id') == $index->id ? 'selected' : '' }}
        @endif
        value="{{ $index->id }}">{{ $index->name }}</option>
        @endforeach
    </select>
    @if ($errors->has('company_id'))
        <div class="class text-danger">{{ $errors->first('company_id') }}</div>
    @endif
</div>
<div class="form-group @error('title') has-error @enderror">
    <label>Título</label>
    <input type="text" class="form-control input-default" name="title"
        value="{{ $announcement->title ?? (old('title') ?? '') }}" placeholder="Título">
    @if ($errors->has('title'))
        <div class="class text-danger">{{ $errors->first('title') }}</div>
    @endif
</div>
<div class="form-group  @error('remuneration') has-error @enderror">
    <label>Salário *apenas tipos númericos</label>
    <input type="number" class="form-control input-default"
        value="{{ $announcement->remuneration ?? (old('remuneration') ?? '') }}" name="remuneration"
        placeholder="Salário">
    @if ($errors->has('remuneration'))
        <div class="class text-danger">{{ $errors->first('remuneration') }}</div>
    @endif
</div>
<div class="form-group  @error('vacancy_type') has-error @enderror">
    <label>Tipo de contrato</label>
    <select class="form-control" name="vacancy_type">
        <option value="">Escolha uma opção</option>
        @foreach ($tipo_contrato as $key => $contrato)
            <option @if (!empty($announcement))
                {{ $key == $announcement->vacancy_type ? 'selected' : '' }}
            @else
                {{ old('vacancy_type') == $contrato ? 'selected' : '' }}
        @endif
        value="{{ $key }}">
        {{ $contrato }}</option>
        @endforeach
    </select>
    @if ($errors->has('vacancy_type'))
        <div class="class text-danger">{{ $errors->first('vacancy_type') }}</div>
    @endif
</div>
<div class="form-group  @error('active') has-error @enderror">
    <label>Status</label>
    <select class="form-control" name="active">
        @foreach ($active as $key => $ac)
            <option @if (!empty($announcement->active))
                {{ $key == $announcement->active ? 'selected' : '' }}
            @else
                {{ old('active') == $key ? 'selected' : '' }}
        @endif
        value="{{ $key }}">
        {{ $ac }}</option>
        @endforeach
    </select>
    @if ($errors->has('active'))
        <div class="class text-danger">{{ $errors->first('active') }}</div>
    @endif
</div>
</div>
<div class="form-group @error('description') has-error @enderror">
    <label>Descrição</label>
    <textarea class="form-control" rows="3" placeholder="Descrição" name="description"
        style="margin-top: 0px; margin-bottom: 0px; height: 251px;">{{ $announcement->description ?? (old('description') ?? '') }}</textarea>
    @if ($errors->has('description'))
        <div class="class text-danger">{{ $errors->first('description') }}</div>
    @endif
</div>
<button type="submit" class="btn btn-primary btn-flat m-b-10 m-l-5">Salvar</button>
</form>
