<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'description' => $this->faker->sentence(2),
            'position' => $this->faker->jobTitle(),
            'role_id' => Role::IS_USER,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt("password"), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::IS_ADMIN,
            ];
        });
    }

    public function writer()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::IS_WRITER,
            ];
        });
    }
}
