<?php

use Illuminate\Database\Seeder;

class ContratistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 1;
        factory(\App\Contratista::class, $count)->create();
    }
}
