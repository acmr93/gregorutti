<?php

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
        $this->call(UserTablaSeeder::class);
        $this->call(EmpresaTableSeeder::class);
        $this->call(MetadatosTableSeeder::class);
    }
}
