<?php

namespace Database\Factories;

use App\Models\Webservice;
use App\Models\WebserviceRequests;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Response;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WebserviceRequestsFactory extends Factory
{
    protected $model = WebserviceRequests::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'webservice_id' => Webservice::factory()->create([
                'response_template' => json_encode(fake()->randomElements)
            ])->id,
            'is_success' => fake()->boolean,
            'status_code' => fake()->randomElement([Response::HTTP_OK, Response::HTTP_CREATED])
        ];
    }
}
