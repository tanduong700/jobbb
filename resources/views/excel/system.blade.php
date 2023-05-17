    <div class="card rounded-3 mx-auto">
        <div class="card-body d-flex flex-column">
            <h1 class="border border-gray-500 border-active active text-center mb-4">Danh sách hệ thống</h1>
            <div class="table-responsive ">
                <table
                    class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300">
                    <thead>
                        <tr class="fw-semibold fs-4 text-gray-500">
                            <th rowspan="2">Thiết bị</th>
                            <th rowspan="2">Thông số</th>
                            @foreach ($tasks as $date => $taskByDate)
                                <th scope="col" colspan="{{ count($taskByDate->groupBy('shift_id')) }}">
                                    {{ $date }}</th>
                            @endforeach
                        </tr>

                        <tr class="fw-semibold fs-4 text-gray-500">
                            @foreach ($tasks as $date => $taskByDate)
                                @foreach ($taskByDate->groupBy('shift_id') as $taskByshift)
                                    <th> {{ $taskByshift[0]->shift->shift }}</th>
                                @endforeach
                            @endforeach

                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($systems as $system)
                            @foreach ($system->devices as $keyDevice => $device)
                                @foreach ($device->specifications as $keySpecification => $specification)
                                    <tr>
                                        @if ($keySpecification == 0)
                                            <td class="text-nowrap" rowspan="{{ count($device->specifications) }}">
                                                {{ $device->id }} -{{ $device->name }}</td>
                                        @endif
                                        <td class="text-nowrap"> {{ $specification->id }} -{{ $specification->name }}</td>
                                        @foreach ($tasks as $date => $taskByDate)
                                            @foreach ($taskByDate->groupBy('shift_id') as $taskByshift)
                                                <td>
                                                    @foreach ($taskByshift as $task)
                                                        @foreach ($task->checklists->where('specification_id', $specification->id) as $checklist)
                                                            {{ $checklist->value }}
                                                        @endforeach
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
