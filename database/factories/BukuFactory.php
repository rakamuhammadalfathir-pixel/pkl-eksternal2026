<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(3),
            'pengarang' => $this->faker->name(),
            'sinopsis' => $this->faker->paragraph(),
            'penerbit' => $this->faker->company(),
            'tahun' => $this->faker->year(),
            'stok' => $this->faker->numberBetween(1, 50),
            'kategori_id' => \App\Models\Kategori::all()->random()->id,
            'rak_id' => \App\Models\Rak::all()->random()->id,
        ];
    }
}
