<?php

namespace Database\Factories;

use App\Models\Obat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Obat::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar nama obat realistis agar tampilan dummy data terlihat rapi
        $namaObat = [
            'Paracetamol 500mg', 'Amoxicillin 500mg', 'Ibuprofen 400mg',
            'Cetirizine 10mg', 'Omeprazole 20mg', 'Vitamin C 1000mg',
            'Antasida Doen', 'Dexamethasone 0.5mg', 'Amlodipine 5mg',
            'Metformin 500mg', 'Neurobion Forte', 'Bodrex Extra'
        ];

        return [
            'kode_obat' => 'OBT-' . $this->faker->unique()->numerify('####'),
            'nama_obat' => $this->faker->randomElement($namaObat),
            'kategori' => $this->faker->randomElement(['Antibiotik', 'Vitamin', 'Analgetik', 'Suplemen', 'Antihistamin']),
            'stok' => $this->faker->numberBetween(5, 150),
            'satuan' => $this->faker->randomElement(['Tablet', 'Kapsul', 'Botol', 'Strip', 'Tube']),
            'harga' => $this->faker->numberBetween(2, 50) * 1000,
            'tanggal_expired' => $this->faker->dateTimeBetween('-1 months', '+3 years')->format('Y-m-d'),
        ];
    }
}
