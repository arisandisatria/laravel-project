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
        'kode_obat' => $this->faker->unique()->numerify('OBT-####'),
        'nama_obat' => $this->faker->word() . ' 500mg',
        'kategori' => $this->faker->randomElement(['Antibiotik', 'Analgetik', 'Vitamin']),
        'satuan' => $this->faker->randomElement(['Tablet', 'Botol', 'Kapsul']),
        'stok' => $this->faker->numberBetween(10, 200),
        'harga' => $this->faker->numberBetween(2, 50) * 1000,
    ];
}
}
