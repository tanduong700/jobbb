<?php

namespace App\Http\Livewire;

use App\Exports\SystemsExport;
use App\Jobs\ExportExcelJob;
use App\Models\System;
use App\Models\Task;
use App\Models\User;
use App\Notifications\ExportExcelNotification;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use LivewireBootstrapModal\ModalComponent;

class ExportExcel extends ModalComponent
{
    public $systems;
    public $startDate;
    public $endDate;

    public static function modalTitle(): string
    {
        return 'Xuất excel';
    }


    public function mount($systems)
    {
        //dd($system);
        $this->systems = $systems;
    }

    protected $rules = [
        'startDate' => 'required',
        'endDate' => 'required',

    ];

    protected $messages = [
        'startDate.required' => 'Chưa nhập ngày bắt đầu',
        'endDate.required' => 'Chưa nhập ngày kết thúc',
    ];

    public function export()
    {
        $this->resetErrorBag();

        $this->validate();

        ExportExcelJob::dispatch($this->systems, $this->startDate, $this->endDate, Auth::user());

        $this->dispatchBrowserEvent('showAlert', ['content' => 'File excel đang xử lí']);
        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.export-excel');
    }
}
