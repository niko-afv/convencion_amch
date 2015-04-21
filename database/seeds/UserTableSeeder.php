<?php


class UserTableSeeder extends \Illuminate\Database\Seeder{

    public function run()
    {
        \DB::table('users')->insert(array(
            'name'=>'Nicolás Fredes',
            'email' => 'niko.afv@gmail.com',
            'password'=> \Hash::make('benjamin13')
        ));

        // $this->call('UserTableSeeder');
    }
} 