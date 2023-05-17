<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    protected $listeners = ['refresh-user-table' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['users.id as id'])
            ->setHideBulkActionsWhenEmptyEnabled()
            ->setConfigurableAreas([
                'toolbar-left-start' => [
                    'livewire.components.datatable.buttons.modal',
                    [
                        'text' => 'Thêm mới',
                        'classes' => 'me-2',
                        'view' => 'modal.user.create-user',
                        'params' => ['project_id' => $this->model]
                    ]
                ]
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Tên", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            BooleanColumn::make('Kích hoạt', 'active')
                ->sortable()
                ->collapseOnMobile(),
            Column::make("Ngày tạo", "created_at")
                ->sortable(),
            Column::make("Ngày cập nhật", "updated_at")
                ->sortable(),
            Column::make('Verified', 'email_verified_at')
                ->sortable()
                ->collapseOnTablet(),
            ButtonGroupColumn::make('Thao tác')
                ->attributes(function ($row) {
                    return [
                        'class' => 'text-nowrap',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Devices')
                        ->title(fn ($row) => 'Xem')
                        ->location(fn ($row) => route('show-user', ['id' => $row->id]))
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
                                "onclick" => "livewire.emit('openModal', 'modal.user.edit-user', {'user': '{$row->id}'})"
                            ];
                        }),

                    LinkColumn::make('Delete')
                        ->title(fn ($row) => 'xóa')
                        ->location(fn ($row) => '#')
                        ->attributes(function ($row) {
                            return [
                                "onclick" => "livewire.emit('openModal', 'modal.user.delete-user', {'user': '{$row->id}'})"
                            ];
                        }),

                ]),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('active')
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                }),
        ];
    }


    public function builder(): Builder
    {
        return User::query()
            ->when($this->getAppliedFilterWithValue('active'), fn ($query, $active) => $query->where('active', $active === 'yes'));
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
            'export' => 'Export',
        ];
    }

    public function activate()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new UsersExport($users), 'users.xlsx');
    }
}
