<?php

namespace Database\Seeders;

use App\Models\Specifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specifications::create([
            'name' => '30',
        ]);
        Specifications::factory(5)->create();
    }
}
