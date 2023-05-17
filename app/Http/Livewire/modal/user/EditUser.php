<?php

namespace App\Http\Livewire\modal\user;

use App\Models\User;
use App\Events\LivewireEvent;
use LivewireBootstrapModal\ModalComponent;

class EditUser extends ModalComponent
{
    public $name;
    public $email;
    public $user;


    public static function modalTitle(): string
    {
        return 'cập nhật';
    }

    public static function modalClasses(): string
    {
        return 'w-350px';
    }


    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
    }


    public function update()
    {


        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        LivewireEvent::dispatch([
            'refresh-user-table',
            'refresh-user-notification'
        ]);

        $this->dispatchBrowserEvent('showAlert', ['content' => 'Đã thay đổi người dùng thành công']);

        $this->closeModalWithEvents([
            'refresh-user-table',
            'refresh-user-notification'
        ]);
    }

    public function render()
    {
        return view('livewire.modal.user.edit-user');
    }
}
