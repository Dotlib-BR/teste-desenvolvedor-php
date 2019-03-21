@if (session('success') || (isset($type) && $type == 'success'))
    <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
        {{ session('success') ?? $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('warning') || (isset($type) && $type == 'warning'))
    <div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
        {{ session('warning') ?? $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('danger') || (isset($type) && $type == 'danger'))
    <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
        {{ session('danger') ?? $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('info') || (isset($type) && $type == 'info'))
    <div class="alert alert-info alert-dismissible fade show border-0" role="alert">
        {{ session('info') ?? $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif