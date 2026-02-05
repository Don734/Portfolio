<div class="btn-group">
    @isset($edit_route)
        @if (!isset($edit_permission) || auth()->user()?->can($edit_permission))
        <a href="{{ $edit_route }}" class="btn link-secondary btn-remove"><i class="bi bi-pen"></i></a>
        @endif
    @endisset
    @isset($destroy_route)
        @if (!isset($delete_permission) || auth()->user()?->can($delete_permission))
        <form action="{{ $destroy_route }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn link-secondary btn-remove">
                <i class="bi bi-trash"></i>
            </button>
        </form>
        @endif
    @endisset
</div>
