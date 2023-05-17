<div class="w-100">
    <div class="modal-body">
        <p>Bạn có chắc chắn muốn xóa?</p>
    </div>
    <div class="modal-footer justify-content-center py-3">
        <button type="button" class="btn btn-danger" wire:click="delete">Yes</button>
        <button type="button" class="btn btn-secondary" x-on:click="$wire.emit('closeModal')">No</button>
    </div>
</div>
