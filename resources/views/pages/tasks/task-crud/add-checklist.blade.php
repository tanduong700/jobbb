@extends('layouts.metronic.app')
@section('content')
    <div class="card rounded-3 mx-auto">
        <div class="card-body d-flex flex-column">
            <h1 class="border border-gray-500 border-active active text-center mb-4"> Thêm Checklist </h1>
            <form method="POST" action="{{ route('task.update-checklist',  ['id' => $task->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="task_id">Task:</label>
                    <input type="text" class="form-control" id="task_id" name="task_id" value="{{ $task->id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="specification_id">Thông số:</label>
                    <select class="form-control" id="specification_id" name="specification_id">
                        @foreach($task->system->devices->flatMap->specifications as $specification)
                            <option value="{{ $specification->id }}">{{ $specification->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="value">Giá trị:</label>
                    <input type="text" class="form-control" id="value" name="value">
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
@endsection
