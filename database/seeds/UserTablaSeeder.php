<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class UserTablaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'pablo',
            'email' => 'pablo@gmail.com',
            'password' => bcrypt('pablopablo'),
            'rol' => 'admin',
            'username' => 'pablo',
        ]);
    }
}
