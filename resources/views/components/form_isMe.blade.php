<form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{  $usuario->id }}">
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
<button type="submit" class="btn btn-primary btn-flat m-b-10 m-l-5">Salvar</button>
</form>
