@extends('layouts.main')

@section ('content')
<section class="signup-content container-sm w-100 h-100 d-flex mt-5 flex-column">
    <header class="d-flex flex-column align-items-center">
        <i class="bi bi-box2-fill" style="font-size: 6rem"></i>

        <h1>Adicionar Produto</h1>
    </header>
    <main>
        <x-product-form />
    </main>
</section>
@endsection
