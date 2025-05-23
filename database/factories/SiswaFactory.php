<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jenis_kelamin = ['P','L'];
        $level = ['X','XI','XII'];
        return [
            'nisn' => fake()->unique()->randomNumber(9),
            'nis' => fake()->unique()->regexify('^[0-9]{3}\-[0-9]{3}$'),
            'nama' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement($jenis_kelamin),
            'id_kelas' => fake()->numberBetween(1, 12),
            'alamat' => fake()->address(),
            'no_telp' => fake()->e164PhoneNumber(),
            'id_spp' => fake()->numberBetween(1, 5),
            'level' => fake()->randomElement($level),
            //
        ];
    }
}
