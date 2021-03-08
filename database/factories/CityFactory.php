<?php

namespace Elbgoods\LaravelSitemap\Database\Factories;

use Elbgoods\LaravelSitemap\Tests\Dummies\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

final class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city,
        ];
    }
}
