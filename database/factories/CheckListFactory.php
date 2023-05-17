<?php

namespace Database\Factories;

use App\Models\CheckList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CheckList>
 */
class CheckListFactory extends Factory
{
    protected $model = CheckList::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'value' => $this->faker->name(),
        ];
    }
}
