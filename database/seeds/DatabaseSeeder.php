<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->insert([
            'name' => 'admin',
                'email' => 'admin@esainca.com.ve',
            'password' => bcrypt('TUmX7ssN')
        ]);

//        DB::table('products')->insert([
//            'code' => str_random(4) . '-' . str_random(4) . '-' . str_random(2),
//            'style' => str_random(7) . '-' . str_random(4),
//            'measure' => str_random(1) . '-' . str_random(1) . '/' . str_random(2) . '"'
//        ]);

        Model::reguard();
    }
}
