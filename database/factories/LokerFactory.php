<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\loker>
 */
class LokerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggal_mulai = Carbon::instance($this->faker->dateTimeBetween('now', '+2 months'));
        $tanggal_selesai = Carbon::instance($this->faker->dateTimeBetween($tanggal_mulai, '+6 months'));

        return [
            'judul' => $this->faker->jobTitle(),
            'perusahaan' => $this->faker->company(),
            'lokasi' => $this->faker->city() . ', ' . $this->faker->country(),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'deskripsi' => $this->faker->paragraphs(3, true),
            'kontak' => $this->faker->email() . ' | ' . $this->faker->phoneNumber(),
        ];
    }
}
