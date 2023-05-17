<?php

namespace App\Exports;

use App\Models\CheckList;
use App\Models\Project;
use App\Models\System;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProjectsExport implements FromView, ShouldAutoSize
{
    use Exportable;
    public $project;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function view(): View
    {
        $id = $this->project[0];
        $project = Project::with('systems.specifications')->find($id);
        $systems = $project->systems;
        $tasks = Task::with(['system', 'checklists', 'shift'])->whereIn('id', $systems->pluck('id'))->get()->groupBy('date');


        return view('excel.project', [
            'project' => $project,
            'systems' => $systems,
            'tasks' => $tasks,
        ]);
    }
}
