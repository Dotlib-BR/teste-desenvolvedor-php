@extends('layouts.main')

@section ('content')
<section class="signup-content container-sm w-100 h-100 d-flex mt-5 flex-column">
    <header class="d-flex flex-column align-items-center">
        <i class="bi bi-cart-check-fill" style="font-size: 6rem"></i>

        <h1>Editar Pedido</h1>
    </header>
    <main>
        <x-order-form
            route_name="updateOrder"
            :route_params="['order' => $id]"
            :customers="$customers"
            :products="$products"
            :id_product="$id_product"
            :id_customer="$id_customer"
            :date="$date"
            submit_button_text="Editar Produto"
        >
            @method("PUT")
        </x-order-form>
    </main>
</section>
@endsection
