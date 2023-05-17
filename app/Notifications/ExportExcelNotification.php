<?php

namespace App\Notifications;

use Error;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExportExcelNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public $filename)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Xuất excel',
            'content' => 'Excel của bạn đã sẳn sàng',
            'link' => route('file.download', ['filename' => $this->filename]),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'actions' => ['refresh-user-notification'],

            'toastr' => [
                'type' => '',
                'message' => 'File excel của bạn đã sẳn sàng',
                'title' => 'xuất excel thành công',
                'options' => [
                    'closeButton' => true,
                    'progressBar' => true,
                    'positionClass' => 'toastr-bottom-right',
                    'timeOut' => 3000,
                ],

            ],

            'sweetAlert' => [
                'text' => 'file sẳn sàng',
                'icon' => 'success',
                'confirmButtonText' => 'OK!',
                'confirmButton' => 'btn btn-primary',
            ]
        ];
    }
}
