<?php

use Illuminate\Database\Seeder;

class SysMenuGroupSeeder extends Seeder
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
                'id' => '1',
                'name' => 'System Utility',
                'segment_name' => 'system',
                'icon' => 'fas fa-cogs',
                'ord' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        foreach ($data as $d) {
            DB::table('sys_menu_groups')->insert($d);
        }
    }
}
