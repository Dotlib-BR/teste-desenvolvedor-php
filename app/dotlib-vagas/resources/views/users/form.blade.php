@if(isset($user) && !empty($user->id))
    <form action="{{url("users/$user->id")}}" method="POST"> @method('PUT')
@else
    <form action="{{$action}}" method="POST">
@endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="id" id="id_vaga" value="" />
    <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="name">Nome *</label>
                <input
                    autofocus
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    value="{{$user->name ?? old('name')}}"
                />
                @if ($errors->has('name'))
                <span class="help-block text-danger">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="last_name">Sobre Nome</label>
                <input
                    autofocus
                    type="text"
                    class="form-control"
                    id="last_name"
                    name="last_name"
                    value="{{$user->last_name ?? old('last_name')}}"
                />
                @if ($errors->has('last_name'))
                <span class="help-block text-danger">
                              <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                @endif
            </div>
            <div class="form-group col-md-3">
                <label for="telefone">Telefone</label>
                <input
                    autofocus
                    type="text"
                    class="form-control"
                    id="telefone"
                    name="telefone"
                    placeholder="(__) _____-____"
                    value="{{$user->telefone ?? old('telefone')}}"
                />
                @if ($errors->has('telefone'))
                <span class="help-block text-danger">
                              <strong>{{ $errors->first('telefone') }}</strong>
                            </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="email">Email</label>
                <input
                    autofocus
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{$user->email ?? old('email')}}"
                />
                @if ($errors->has('email'))
                <span class="help-block text-danger">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input
                    autofocus
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="**********************"
                    value="{{$user->password ?? old('password')}}"
                />
                @if ($errors->has('password'))
                <span class="help-block text-danger">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation">Confirme a Senha</label>
                <input
                    autofocus
                    type="password"
                    class="form-control"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="**********************"
                    value="{{$user->password ?? old('password_confirmation')}}"
                />
                @if ($errors->has('password_confirmation'))
                <span class="help-block text-danger">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                @endif
            </div>
        </div>
    </div>
    <a href="{{ url('users') }}" class="btn btn-danger ml-3 mb-3">
        Cancelar
    </a>
    <button type="submit" class="btn btn-success mb-3">
        Salvar
    </button>
</form>
