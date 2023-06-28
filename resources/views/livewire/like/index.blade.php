<div>
    <form style="margin-top: -5px;">
        <button
            @if (isset($statusLikeOrNot) && $statusLikeOrNot->status) wire:click.prevent="delete()" @else wire:click.prevent="store()" @endif>
            <i class="fas fa-star{{ isset($statusLikeOrNot) && $statusLikeOrNot->status ? ' text-warning' : '' }}"></i>
        </button>
    </form>
</div>
