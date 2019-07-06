@if (session('status') || session('request'))
    <div class="alert alert-{{session('request') ? 'danger' : 'success'}} alert-dismissible fade show" role="alert">
        {{ session('status') ?? session('request') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('action'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('action') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
