<?php

namespace Database\Factories;

use App\Models\Ticap;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
        $fname = [
            'Joshua', 'John Paul', 'Christian', 'Justine', 'John Mark', ' John Lloyd', 'Jerome', 'Adrian', 'John Michael', 'Angelo',
            'Angel', 'Angelica', 'Nicole', 'Angela', 'Mary Joy', 'Mariel', 'Jasmine', 'Mary Grace', 'Kimberly', 'Stephanie'
        ];
        $mname = [
            'Sanchez', 'Torres', 'de Leon', 'Domingo', 'Martinez', 'Rodriguez', 'Santiago', 'Soriano', 'Delos Santos', 'Diaz', 
            'Hernandez', 'Tolentino', 'Valdez', 'Ramirez', 'Morales', 'Mercado', 'Tan', 'Aguilar', 'Navarro', 'Manalo'
        ];
        $lname = [
            'Garcia', 'Reyes', 'Ramos', 'Mendoza', 'Santos', 'Flores', 'dela Cruz', 'Gonzales', 'Bautista', 'Villanueva', 'Fernandez', 'Cruz',
            'de Guzman', 'Lopez', 'Perez', 'Castillo', 'Francisco', 'Rivera', 'Aquino', 'Castro'
        ];

        $randFname = array_rand($fname);
        $randMname = array_rand($mname);
        $randLname = array_rand($lname);

        return [
            'first_name' => $fname[$randFname],
            'middle_name' => $mname[$randMname],
            'last_name' => $lname[$randLname],
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('123'), // password
            'remember_token' => Str::random(10),
            'ticap_id' => Ticap::latest()->pluck('id')->first(),
            'email_verified' => 1,

            // 'name' => $this->faker->name(),
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
