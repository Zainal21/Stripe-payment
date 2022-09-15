<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PlanProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name'=> 'Paket Intensif',
            'slug'=> Str::slug('Paket Intensif'),
            'stripe_plan'=> 'Basic',
            'cost'=> 100000,
            'description'=> 'Paket murah untuk profesional',
        ]);

        DB::table('plans')->insert([
            'name'=> 'Paket Bayi',
            'slug'=> Str::slug('Paket Bayi'),
            'stripe_plan'=> 'Promo',
            'cost'=> 100000,
            'description'=> 'Paket murah untuk pelajar',
        ]);
    }
}
