<div class="form-row">
    <div class="form-group col-md-6 col-sm-12">
        <label for="name">Nome:</label>
        <div>
            <input type="text" id="name" name="name" value="{{ isset($client)? $client->name : old('name') }}"
                   class="form-control" placeholder="Ex: João da Silva..." required>
        </div>
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <label for="email">Email:</label>
        <div>
            <input type="text" id="email" name="email" value="{{ isset($client)? $client->user->email:old('email') }}"
                   class="form-control" placeholder="Email" required>
        </div>
    </div>

    <div class="form-group col-md-12 col-sm-12">
        <label for="cpf">CPF:</label>
        <div>
            <input id="cpf" name="cpf"
                      class="form-control" placeholder="CPF"
                      value="{{ isset($client)? $client->cpf: old('cpf') }}">
        </div>
    </div>

    <div class="form-group col-md-12 col-sm-12">
        <label for="password">Senha:</label>
        <div>
            <input id="password" name="password"
                      class="form-control" placeholder="Senha"
                      value="">
        </div>
    </div>
</div>
