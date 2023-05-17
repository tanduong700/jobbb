<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\LivewireEvent;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserNotification extends Component
{
    public $notifications;
    public $unreadCount;

    protected $listeners = ['refresh-user-notification' => 'getNotifications'];

    public function mount()
    {
        $this->getNotifications();
    }

    public function getNotifications()
    {
        $this->notifications = Auth::user()->notifications()->orderByRaw('CASE WHEN read_at IS NULL THEN 0 ELSE 1 END')->latest()->limit(3)->get();
        $this->unreadCount = Auth::user()->unreadNotifications->count();
    }

    public function allMarkAsRead()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        $this->getNotifications();
    }

    public function markAsRead($notificationId)
    {
        if ($notificationId) {
            $readnotification = auth()->user()->notifications()->where('id', $notificationId)->first();
            $readnotification->markAsRead();
            $this->getNotifications();
        }
    }

    public function render()
    {
        return view('livewire.user-notification');
    }
}
