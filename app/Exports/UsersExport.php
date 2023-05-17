<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return User::whereIn('id', $this->users)->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'tên',
            'email',
            'kích hoạt',
            'ngày tạo',
            'ngày cập nhật',
            'verified',
        ];
    }
}
