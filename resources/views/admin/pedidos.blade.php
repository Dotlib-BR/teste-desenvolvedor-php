@extends('layouts.dashboard')
@section('content')
<!-- component -->
<div class="antialiased sans-serif bg-gray-200 dark:border-primary-darker dark:bg-darker h-full">

<style>
[x-cloak] {
    display: none;
}
</style>
<div class="container mx-auto py-6 px-4"  x-cloak>
<h1 class="text-3xl py-1 border-b mb-10 dark:text-light ">Lista de Pedidos de Compra </h1>

<div class="mt-3">
<livewire:lista-pedidos hideable="select" sort="id|asc" exportable/>
</div>


</div>
</div>
@endsection