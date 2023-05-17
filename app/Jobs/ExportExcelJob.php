<?php

namespace App\Jobs;

use App\Events\LivewireEvent;
use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Exports\SystemsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ExportExcelNotification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ExportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $systems;
    private $startDate;
    private $endDate;
    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($systems, $startDate, $endDate, $user)
    {
        $this->systems = $systems;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $filename = 'systems_' . time() . '_' . $user->id . '.xlsx';
        Excel::store(new SystemsExport($this->systems, $this->startDate, $this->endDate), $filename);
        Notification::send($user, new ExportExcelNotification($filename));
    }
}
