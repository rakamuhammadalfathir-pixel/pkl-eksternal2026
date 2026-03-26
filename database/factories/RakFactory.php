<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rak>
 */
class RakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_rak' => 'Rak ' . $this->faker->bothify('??-##'), // Contoh: Rak AB-12
            'lokasi' => $this->faker->randomElement(['Lantai 1', 'Lantai 2', 'Sayap Kiri', 'Sayap Kanan']),
        ];
    }
}
