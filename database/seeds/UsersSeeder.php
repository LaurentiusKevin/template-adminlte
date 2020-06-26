<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'superadmin',
                'email' => null,
                'name' => 'SUPERADMIN',
                'password' => \Illuminate\Support\Facades\Hash::make('opusdei21'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        foreach ($data as $d) {
            DB::table('users')->insert($d);
        }
    }
}
