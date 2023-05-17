<?php

namespace App\Http\Livewire;

use App\Exports\SystemsExport;
use App\Jobs\ExportExcelJob;
use App\Models\System;
use App\Models\Project;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class SystemTable extends DataTableComponent
{
    protected $model = System::class;

    protected $listeners = ['refresh-system-table' => '$refresh'];

    public $project = '';

    public function queryString(): array
    {
        return [
            'project' => ['except' => ''],
        ];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        return System::query()
            ->where('project_id', $this->project);
    }

    public function filters(): array
    {
        return [

            DateFilter::make('Ngày tạo', 'created_at')
                ->setFilterPillTitle('Ngày')
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('created_at', $value);
                }),


        ];
    }


    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
        ];
    }

    public function activate()
    {
        System::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        System::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }

    public function export()
    {
        $systems = $this->getSelected();
        $this->clearSelected();
        $this->emit('openModal', 'export-excel', ['systems' => $systems]);
    }
}
