@extends('layouts.metronic.app')

@section('content')
<form action="{{ route('task.update',  ['id' => $task->id]) }}" method="POST">
    @csrf
    <div class="card rounded-3 mx-auto">
        <div class="card-body d-flex flex-column">
            <h1 class="border border-gray-500 border-active active text-center mb-4">Cập nhật</h1>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Hệ thống</label>
                    <select class="form-select" name="system_id" aria-label="Default select example">
                        @foreach ($systems as $system)
                            <option value="{{ $system->id }}" {{ $task->system_id == $system->id ? 'selected' : '' }}>{{ $system->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Ca làm</label>
                    <select class="form-select" name="shift_id" aria-label="Default select example" >
                        @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}" {{ $task->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->shift }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="col-sm-1 col-form-label">Date</label>
                    <div class="col-sm-4">
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control" name="date" value="{{ $task->date }}">
                            <span class="input-group-append">
                                <span class="input-group-text bg-white d-block">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center py-3">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{route('task.index')}}" class="btn btn-warning">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
