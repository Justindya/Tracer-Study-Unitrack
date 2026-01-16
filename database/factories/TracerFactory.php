<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tracer>
 */
class TracerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alumni_id' => \App\Models\alumni::factory(),
            'mulai_kerja' => $this->faker->date(),
            'nama_instansi' => $this->faker->company(),
            'jabatan' => $this->faker->jobTitle(),
            'kesesuaian_kerja' => $this->faker->randomElement(['Sesuai', 'Tidak Sesuai']),
            'kelurahan' => $this->faker->citySuffix(),
            'kab_kota' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
            'kode_pos' => $this->faker->postcode(),
            'tgl_update' => $this->faker->date(),
        ];
    }
}
