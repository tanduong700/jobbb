<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use App\Models\Task;
use App\Models\Shift;
use App\Models\System;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $title = 'Hệ thống';
        $tasks = Task::with('system.specifications.checkLists')->get();
        return view('pages.tasks.task', ['tasks' => $tasks, 'title' => $title]);
    }

    public function create()
    {
        $title = 'Thêm công việc';
        $shifts = Shift::all();
        $systems = System::all();
        return view('pages.tasks.task-crud.create', ['shifts' => $shifts, 'systems' => $systems, 'title' => $title]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'system_id' => 'required',
            'shift_id' => 'required',
            'date' => 'required|date',
        ]);
        $task = Task::create([
            'system_id' => $request->system_id,
            'date' => $request->date,
            'shift_id' => $request->shift_id,
        ]);

        $system = System::with('devices.specifications')->find($request->system_id);
        foreach ($system->devices as $device) {
            foreach ($device->specifications as $specification) {
                CheckList::create([
                    'task_id' => $task->id,
                    'specification_id' => $specification->id,
                ]);
            }
        }

        return redirect()->route('task.index')->with('suscess', 'Thêm hệ thống thành công');
    }

    public function show($id)
    {
        $title = 'Chi tiết';
        $task = Task::with('devices.specifications', 'checklists')->find($id);
        return view('pages.tasks.task-crud.show', ['task' => $task, 'title' => $title]);
    }

    public function edit($id)
    {
        $title = 'Cập nhật';
        $task = Task::findOrFail($id);
        $systems = System::all();
        $shifts = Shift::all();
        return view('pages.tasks.task-crud.edit', ['task' => $task, 'systems' => $systems, 'shifts' => $shifts, 'title' => $title]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'system_id' => $request->system_id,
            'date' => $request->date,
            'shift_id' => $request->shift_id,
        ]);

        $task->checklists()->delete();
        $system = System::with('devices.specifications')->find($request->system_id);
        foreach ($system->devices as $device) {
            foreach ($device->specifications as $specification) {
                CheckList::create([
                    'task_id' => $task->id,
                    'specification_id' => $specification->id,
                ]);
            }
        }
        return redirect()->route('task.index')->with('suscess', 'Sửa thành công!');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->checklists()->delete();
        $task->delete();
        return redirect()->route('task.index')->with('suscess', 'Xóa thành công!');
    }

    public function createChecklist($id)
    {
        $title = 'Checklist';
        $task = Task::with('system.devices.specifications')->find($id);
        return view('pages.tasks.task-crud.add-checklist', ['task' => $task, 'title' => $title]);
    }

    public function storeChecklist(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'task_id' => 'required',
            'specification_id' => 'required',
            'value' => 'required',
        ]);

        $checklist = CheckList::create([
            'task_id' => $request->task_id,
            'specification_id' => $request->specification_id,
            'value' => $request->value,
        ]);

        return redirect()->route('task.index')->with('suscess', 'Thêm giá trị thành công!');
    }
}
