<table class="table table-hover table-striped">
    <thead>
    <tr>
        <th scope="col">Adicionar</th>
        <th scope="col">Produto</th>
        <th scope="col">Preço</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Subtotal</th>
    </tr>
    </thead>
    <tbody id="array">
    @foreach($products as $indiceProduct => $product)
        <tr id="{{"id" . $product->id }}">
            <td>
                <label><input type="checkbox" name="checkbox[]" value="{{ $product->id }}"></label>
            </td>
            <td>{{ $product->name }}</td>
            <td id="price">{{ $product->price }}</td>
            <td style="width: 20%"><input style="width: 37%" type="text" name="quantity[]" id="quantity" oninput="getPrice('{{"id" . $product->id}}')" value="0"/></td>
            <td id="total"></td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function getPrice(indiceProduct) {
        var quantity = document.querySelector('#' + indiceProduct + ' #quantity').value;
        var price = document.querySelector('#' + indiceProduct + ' #price').innerText;
        var total = quantity * price;
        document.querySelector('#' + indiceProduct + ' #total').innerText = total;

        return total;
    }
</script>
