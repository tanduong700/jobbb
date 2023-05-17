<?php

namespace App\Http\Livewire\modal\user;

use App\Models\User;
use Livewire\Component;
use App\Events\LivewireEvent;
use LivewireBootstrapModal\ModalComponent;

class DeleteUser extends ModalComponent
{
    public $user;

    public static function modalTitle(): string
    {
        return 'Xóa';
    }

    public static function modalClasses(): string
    {
        return 'w-350px';
    }

    public function mount(User $user)
    {

        $this->user = $user;
    }


    public function delete()
    {

        $this->user->delete();

        LivewireEvent::dispatch([
            'refresh-user-table',
            'refresh-user-notification'
        ]);

        $this->dispatchBrowserEvent('showAlert', ['content' => 'Đã xóa người dùng']);

        $this->closeModalWithEvents([
            'refresh-user-table',
            'refresh-user-notification'
        ]);
    }

    public function render()
    {
        return view('livewire.modal.user.delete-user');
    }
}
