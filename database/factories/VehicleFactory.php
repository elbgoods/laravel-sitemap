<?php

namespace Elbgoods\LaravelSitemap\Database\Factories;

use Elbgoods\LaravelSitemap\Tests\Dummies\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

final class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => 'Land',
        ];
    }
}
