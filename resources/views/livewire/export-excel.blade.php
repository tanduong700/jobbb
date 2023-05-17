<div class="w-100">
    <div class="modal-body">
        <div class="mb-3">
            <label for="startDate">Ngày bắt đầu:</label>

            <input type="date" class="form-control @error('startDate') is-invalid @enderror" wire:model="startDate"
                id="startDate">
            @error('startDate')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="endDate">Ngày kết thúc:</label>
            <input type="date" class="form-control @error('endDate') is-invalid @enderror" wire:model="endDate"
                id="endDate">
            @error('endDate')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer justify-content-center py-3">
        <button type="button" wire:click="export" class="btn btn-primary">Xuất Excel</button>
    </div>
</div>
