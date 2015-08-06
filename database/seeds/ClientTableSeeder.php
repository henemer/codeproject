<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \CodeProject\Entities\Project::truncate();
        \CodeProject\Entities\Client::truncate();


        factory(\CodeProject\Entities\Client::class, 10)->create();

    }
}
