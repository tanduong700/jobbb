<form action="{{ route('task.delete-task', ['id' => $task->id]) }}" method="POST">
    @csrf
    @method('DELETE')

    <div class="w-100">
        <div class="modal-body">
            <p>Are you sure you want to delete?</p>
        </div>
        <div class="modal-footer justify-content-center py-3">
            <button type="submit" class="btn btn-danger">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
    </div>
</form>
