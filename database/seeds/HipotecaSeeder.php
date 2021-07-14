<?php

use Illuminate\Database\Seeder;

class HipotecaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Hipoteca::class, 20)->create();
    }
}
