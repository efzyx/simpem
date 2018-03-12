<?php

use Illuminate\Database\Seeder;
use App\Models\Supir;
use Faker\Factory as Faker;

class SupirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            Supir::insert([
            'no_supir' => $faker->unique()->randomDigit,
            'nama_supir' => $faker->name,
         ]);
        }
    }
}
