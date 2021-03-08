<?php

namespace Elbgoods\LaravelSitemap\Database\Factories;

use Elbgoods\LaravelSitemap\Tests\Dummies\Models\Fruit;
use Illuminate\Database\Eloquent\Factories\Factory;

final class FruitFactory extends Factory
{
    protected $model = Fruit::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
