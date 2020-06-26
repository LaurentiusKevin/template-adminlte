<?php

use Illuminate\Database\Seeder;

class SysMenuSeeder extends Seeder
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
                'group_id' => '1',
                'name' => 'Menu Group',
                'segment_name' => 'menu-group',
                'route' => 'admin.system.menu-group.view.index',
                'ord' => '2',
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'group_id' => '1',
                'name' => 'Menu',
                'segment_name' => 'menu',
                'route' => 'admin.system.menu.view.index',
                'ord' => '3',
                'status' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        foreach ($data as $d) {
            DB::table('sys_menus')->insert($d);
        }
    }
}
