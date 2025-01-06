<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaduan>
 */
class PengaduanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(2, 5),
            'kategori_id' => fake()->numberBetween(1, 3),
            'judul' => fake()->sentence(),
            'isi_laporan' => fake()->paragraphs(7, true),
        ];
    }
}
