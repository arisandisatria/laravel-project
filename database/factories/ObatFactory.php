<?php

namespace Database\Factories;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Obat>
 */
class ObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        return [
            // Ganti $this->faker menjadi fake()
            'kode_obat' => fake()->unique()->numerify('OBT-####'),
            'nama_obat' => fake()->word() . ' 500mg',
            'kategori'  => fake()->randomElement(['Antibiotik', 'Analgetik', 'Vitamin']),
            'satuan'    => fake()->randomElement(['Tablet', 'Botol', 'Kapsul']),
            'stok'      => fake()->numberBetween(10, 200),
            'harga'     => fake()->numberBetween(2, 50) * 1000,
        ];
    }
}
