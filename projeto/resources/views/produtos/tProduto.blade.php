@foreach($produtos as $produto)
    <tr>
        <td>
            <input type="text" readonly class="form-control-plaintext" name="nomeProduto" value="{{$produto->nome}}">
        </td>
        <td>
            <input type="number" readonly class="form-control-plaintext valorUnt" name="valorUnt" value="{{$produto->valorUnt}}">
        </td>
        <td>
            <input type="number" name="quantidade" class="quantidade" id="{{$produto->id}}" valor={{$produto->valorUnt}} value="">
        </td>
        <td>
            <input type="number" name="subtotal" class="subtotal" value="">
        </td>
        <td>
            <button type="button" class="btn btn-light"><i class="fas fa-plus-circle"></i></button>
        </td>
    </tr>
@endforeach