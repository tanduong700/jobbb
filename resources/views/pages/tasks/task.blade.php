@extends('layouts.metronic.app')

@section('content')
    <div class="card rounded-3 mx-auto">
        <div class="card-body d-flex flex-column">
            <h1 class="border border-gray-500 border-active active text-center mb-4">Danh sách</h1>
            <div class="table-responsive ">
                <table class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300 ">
                    <thead>
                        <a href="{{ route('task.create') }}" class="btn btn-primary mb-8">Thêm mới</a>
                    <tr>
                        <th>Id task</th>
                        <th>Id hệ thống</th>
                        <th>Hệ thống</th>
                        <th>Id ca làm</th>
                        <th>Ca làm</th>
                        <th>ngày</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->system->id }}</td>
                            <td>{{ $task->system->name }}</td>
                            <td>{{ $task->shift->id }}</td>
                            <td>{{ $task->shift->shift }}</td>
                            <td>{{ $task->date }}</td>
                            <td>
                                <a href="{{ route('task.show',  $task->id) }}" class="btn btn-primary">Xem</a>

                                <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-warning">Sửa</a>

                                <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger">Xóa</a>

                                <a href="{{ route('task.checklist', ['id' => $task->id]) }}" class="btn btn-primary">Thêm giá trị</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

