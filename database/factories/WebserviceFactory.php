<?php

namespace Database\Factories;

use App\Models\Webservice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Webservice>
 */
class WebserviceFactory extends Factory
{
    protected $model = Webservice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'url' => fake()->unique()->url(),
            'request_method' => fake()->randomElement([Request::METHOD_GET, Request::METHOD_POST]),
            'response_type' => fake()->randomElement(Webservice::$responseTypes),
            'schedule_frequency' => fake()->randomElement(['everyTenMinutes()', 'hourly()']),
        ];
    }
}
