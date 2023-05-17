<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notification;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Notifications\DatabaseNotification;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class NotificationTable extends DataTableComponent
{
    protected $model = DatabaseNotification::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['notifications.id as id', 'notifications.data as data']);
    }

    public function columns(): array
    {
        return [
            Column::make('Ngày nhận', 'created_at')
                ->sortable(),
            BooleanColumn::make('Đã đọc', 'read_at')
                ->sortable()
                ->collapseOnMobile(),
            Column::make('Ngày đọc', 'read_at'),
            Column::make('tiêu đề')
                ->label(
                    fn ($row) => $row?->data ? $row->data['title'] : ''
                ),
            Column::make('nội dung')
                ->label(
                    fn ($row) => $row?->data ? $row->data['content'] : ''
                ),
            LinkColumn::make('Link')
                ->title(fn ($row) => $row?->data ? $row->data['link'] : '')
                ->location(fn ($row) => $row?->data ? $row->data['link'] : '')
                ->attributes(function ($row) {
                    $id = (($row->read_at != null) ? null : $row->id);
                    return [
                        "wire:click" => "markAsRead('{$id}')"
                    ];
                }),
        ];
    }

    public function builder(): Builder
    {
        return DatabaseNotification::whereHasMorph(
            'notifiable',
            [User::class],
            function ($query) {

                $query->where('id', Auth::id());
            }
        );
    }

    public function markAsRead($notificationId)
    {
        if ($notificationId != '') {
            $readnotification = auth()->user()->notifications()->where('id', $notificationId)->first();
            $readnotification->markAsRead();
        }
    }
}
