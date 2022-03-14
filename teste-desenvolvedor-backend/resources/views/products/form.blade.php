<div class="form-row">
    <div class="form-group col-md-6 col-sm-12">
        <label for="name">Nome:</label>
        <div>
            <input type="text" id="name" name="name" value="{{ isset($product)? $product->name : old('name') }}"
                   class="form-control" placeholder="Ex: João da Silva..." required>
        </div>
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <label for="price">Preço:</label>
        <div>
            <input type="text" id="price" name="price" value="{{ isset($product)? $product->price : old('price') }}"
                   class="form-control" placeholder="Preço" required>
        </div>
    </div>

    <div class="form-group col-md-12 col-sm-12">
        <label for="bar_code">Código de Barras:</label>
        <div>
            <input id="bar_code" name="bar_code"
                   class="form-control" placeholder="Código de Barras"
                   value="{{ isset($product)? $product->bar_code: old('bar_code') }}">
        </div>
    </div>
</div>
