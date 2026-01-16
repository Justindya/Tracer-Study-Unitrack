<?php

namespace Database\Seeders;

use App\Models\loker;
use Illuminate\Database\Seeder;

class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        loker::factory()->count(10)->create();
    }
}
