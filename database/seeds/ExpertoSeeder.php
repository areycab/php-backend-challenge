<?php

use Illuminate\Database\Seeder;

class ExpertoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Experto::class, 5)->create();
    }
}
