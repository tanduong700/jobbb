<?php

namespace App\Exports;

use App\Models\Task;
use App\Models\System;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SystemsExport implements FromView, ShouldAutoSize
{
    use Exportable;
    public $system;
    public $startDate;
    public $endDate;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($system, $startDate, $endDate)
    {
        $this->system = $system;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $systems = System::with('devices.specifications')->whereIn('id', $this->system)->get();
        $tasks = Task::with(['checklists', 'shift'])->where('date', '>=', $this->startDate)->where('date', '<=', $this->endDate)->whereIn('system_id', $systems->pluck('id'))->get()->groupBy('date');
        return view('excel.system', [
            'systems' => $systems,
            'tasks' => $tasks,
        ]);
    }
}
