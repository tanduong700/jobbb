<?php

namespace App\Http\Livewire;

use App\Models\System;
use App\Models\Project;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class ProjectTable extends DataTableComponent
{
    protected $model = Project::class;

    public $columnSearch = [
        'created_at' => null,

    ];

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
            ButtonGroupColumn::make('Thao tác')
                ->attributes(function ($row) {
                    return [
                        'class' => 'text-nowrap',
                    ];
                })
                ->buttons([
                    LinkColumn::make('systems')
                        ->title(fn ($row) => 'Xem')
                        ->location(fn ($row) => route('show-project', ['project' => $row->id,]))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'text-info me-1'
                            ];
                        }),

                    LinkColumn::make('Edit')
                        ->title(fn ($row) => 'Sửa')
                        ->location(fn ($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'text-info me-1',
                                "onclick" => "livewire.emit('openModal', 'edit-user', {'user': '{$row->id}'})"
                            ];
                        }),

                    LinkColumn::make('Delete')
                        ->title(fn ($row) => 'xóa')
                        ->location(fn ($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                "onclick" => "livewire.emit('openModal', 'delete-user', {'user': '{$row->id}'})"
                            ];
                        }),

                ]),
        ];
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
        Project::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        Project::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }

    public function export()
    {
        $project = $this->getSelected();
        $this->clearSelected();

        return Excel::download(new ProjectsExport($project), 'projects.xlsx');
    }
}
