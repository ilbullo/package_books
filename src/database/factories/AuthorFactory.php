<?php

namespace Ilbullo\Books\Database\Factories;

use Ilbullo\Books\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{

    protected $model = Author::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->name(),
            'lastname'  => $this->faker->lastName()
        ];
    }

}
