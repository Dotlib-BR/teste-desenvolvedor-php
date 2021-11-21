@if (isset($usuario->id))
    <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf
@endif

<div class="form-group @error('name') has-error @enderror">
    <label>Nome</label>
    <input type="text" class="form-control input-default" name="name"
        value="{{ $usuario->name ?? (old('name') ?? '') }}" placeholder="Nome">
    @if ($errors->has('name'))
        <div class="class text-danger">{{ $errors->first('name') }}</div>
    @endif
</div>
<div class="form-group @error('email') has-error @enderror">
    <label>Email</label>
    <input type="email" id="email_user" class="form-control input-default" name="email"
        value="{{ $usuario->email ?? (old('email') ?? '') }}" placeholder="Email">
    @if ($errors->has('email'))
        <div class="class text-danger">{{ $errors->first('email') }}</div>
    @endif
</div>
    <div class="form-group checkbox">
        <label>
            <input type="checkbox" name="user" value="1" {{ $usuario->user ?? old('user') == 1 ? 'checked' : '' }}>
            Usuário
        </label>
        <label>
            <input type="checkbox" name="admin" value="1" {{ $usuario->admin ?? old('admin') == 1 ? 'checked' : '' }}>
            Administrador
        </label>
        @if ($errors->has('error_perfil'))
            <div class="class text-danger">{{ $errors->first('error_perfil') }}</div>
        @endif
    </div>
@if (isset($usuario->id))
    <div class="form-group @error('error_senhas_diferentes') has-error @enderror">
        <label>Senha</label>
        <input type="password" class="form-control input-default" name="password" value="{{ old('password') }}">
    </div>
    <div class="form-group @error('error_senhas_diferentes') has-error @enderror">
        <label>Confirmar Senha</label>
        <input type="password" class="form-control input-default" name="password_confirmation" value="{{ old('password_confirmation') }}">
        @if ($errors->has('error_senhas_diferentes'))
            <div class="class text-danger">{{ $errors->first('error_senhas_diferentes') }}</div>
        @endif
    </div>
@else
    <div class="form-group ">
        <label>*Senha gerada automaticamente pelo sistema, (<span class="class text-danger">password</span>), após o
            login o
            usuário
            poderá editar</label>
    </div>
@endif
<button type="submit" class="btn btn-primary btn-flat m-b-10 m-l-5">Salvar</button>
        </form>
