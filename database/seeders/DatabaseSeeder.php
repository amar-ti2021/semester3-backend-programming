<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Status::factory()->create([
            'id' => 1,
            'desc' => 'positive',
        ]);
        \App\Models\Status::factory()->create([
            'id' => 2,
            'desc' => 'recovered',
        ]);
        \App\Models\Status::factory()->create([
            'id' => 3,
            'desc' => 'dead',
        ]);
        \App\Models\Patient::factory(100)->create();
    }
}
