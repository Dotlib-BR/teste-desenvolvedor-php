@component('components.modal', ['id' => 'modalDestroyConfirm'])
    @slot('title')
        Exclusão
    @endslot

    @slot('description')
        Você tem certeza que deseja remover este item permanentemente?
    @endslot

    @slot('action')
        <form class="d-inline" action="" method="post">
            @csrf @method('delete')
            <button class="btn btn-danger" type="submit">Remover</button>
        </form>
    @endslot
@endcomponent