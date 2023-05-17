<?php

namespace Database\Seeders;

use App\Models\CheckList;
use App\Models\Device;
use App\Models\Project;
use App\Models\Shift;
use App\Models\Specification;
use App\Models\System;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'tan',
            'email' => 'tan@123.com',
            'password' => Hash::make('12345678')
        ]);


        //User::factory(1000)->create();

        //Project::factory()->count(2)->create();


        $shift = Shift::factory(3)->create();

        Project::factory(3)->create()->each(function ($project) use ($shift) {
            System::factory(10)->create([
                'project_id' => $project->id,
            ])->each(function ($system) use ($shift) {
                $shiftIds = $shift->random(rand(1, 3))->pluck('id');
                $system->shifts()->attach($shiftIds);
                foreach ($shiftIds as $shiftId) {
                    $task = Task::factory()->create([
                        'system_id' => $system->id,
                        'shift_id' => $shiftId,
                        'date' => now(),
                    ]);
                }
                Device::factory(10)->create([
                    'system_id' => $system->id,
                ])->each(function ($device) use ($task) {
                    Specification::factory(3)->create([
                        'device_id' => $device->id,
                    ])->each(function ($specification) use ($task) {
                            CheckList::factory(1)->create([
                                'specification_id' => $specification->id,
                                'task_id' => $task->id,
                            ]);
                    });
                });
            });
        });
    }
}
