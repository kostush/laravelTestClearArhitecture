<?php
namespace Database\Factories;

use App\Models\HealthCheckModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Src\Domains\HealthCheck\Interfaces\HealthCheckEntityInterface;
use Src\Domains\HealthCheck\Interfaces\HealthCheckFactoryInterface;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthCheckModel>
 */
class HealthCheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner' => fake()->uuid(),
            'db' => fake()->boolean(),
            'cache' => fake()->boolean(),
        ];
    }

}
