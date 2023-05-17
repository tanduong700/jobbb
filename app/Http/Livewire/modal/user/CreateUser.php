<?php

namespace App\Http\Livewire\modal\user;

use App\Models\User;
use App\Events\LivewireEvent;
use Illuminate\Support\Facades\Hash;
use LivewireBootstrapModal\ModalComponent;

class CreateUser extends ModalComponent
{
    public $name;
    public $email;



    public static function modalTitle(): string
    {
        return 'Thêm mới';
    }

    public static function modalClasses(): string
    {
        return 'w-350px';
    }

    protected $rules = [
        'name' => ['required', 'min:2', 'max:10'],
        'email' => ['required', 'email'],

    ];

    public function store()
    {
        $this->resetErrorBag();

        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('12345678')
        ]);

        LivewireEvent::dispatch([
            'refresh-user-table',
            'refresh-user-notification'
        ]);

        $this->dispatchBrowserEvent('showAlert', ['content' => 'Đã thêm người dùng thành công']);

        $this->closeModalWithEvents([
            'refresh-user-table',
            'refresh-user-notification'
        ]);
    }

    public function render()
    {
        return view('livewire.modal.user.create-user');
    }
}
