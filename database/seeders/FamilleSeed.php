<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Famille;
class FamilleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            Famille::create(['nom'=>'Famille '.$i]);
        }
    }
}
