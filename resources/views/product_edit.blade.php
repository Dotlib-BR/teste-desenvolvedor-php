@extends('layouts.main')

@section ('content')
<section class="signup-content container-sm w-100 h-100 d-flex mt-5 flex-column">
    <header class="d-flex flex-column align-items-center">
        <i class="bi bi-box2-fill" style="font-size: 6rem"></i>

        <h1>Editar Produto</h1>
    </header>
    <main>
        <x-product-form
            route_name="updateProduct"
            :route_params="['product' => $id]"
            :code="$code"
            :name="$name"
            :warehouse_quantity="$warehouse_quantity"
            :value="$value"
            submit_button_text="Editar Produto"
        >
            @method("PUT")
        </x-product-form>
    </main>
</section>
@endsection
