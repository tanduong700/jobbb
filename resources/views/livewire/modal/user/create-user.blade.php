<form class="w-100" wire:submit.prevent='store'>
    <div class="modal-body">
        <div class="mb-3">
            <label for="">Tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model='name'
                placeholder="tên người dùng ...">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" wire:model='email'
                placeholder="Email người dùng ...">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="modal-footer justify-content-center py-3">
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </div>
</form>

