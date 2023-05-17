@extends('layouts.metronic.app')

@section('content')
<a href="{{route('task.index')}}" class="btn btn-warning">Quay lại</a>
@foreach ($task->devices as $device)
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">{{ $device->id }} - {{ $device->name }}</h3>
        <div class="card-toolbar">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>Thông số</th>
                        <th>Giá trị</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($device->specifications as $specification)

                    <tr>
                        <td>{{ $specification->id }} - {{ $specification->name }}</td>

                        <td>{{ $task->checklists->where('specification_id', $specification->id)->first()?->id }} - {{ $task->checklists->where('specification_id', $specification->id)->first()?->value }}</td>

                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach

@endsection
