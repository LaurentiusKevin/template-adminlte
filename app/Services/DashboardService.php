<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardService
{
    public function sidebar()
    {
//        $username = Session::get('username');
//
//        if ($username == 'superadmin') {
            $group = DB::table('sys_menus')
                ->select('sys_menu_groups.id','sys_menu_groups.name','sys_menu_groups.segment_name','sys_menu_groups.icon','sys_menu_groups.ord','sys_menu_groups.status','sys_menu_groups.created_at','sys_menu_groups.updated_at')
                ->join('sys_menu_groups','sys_menus.group_id','=','sys_menu_groups.id')
                ->orderBy('sys_menu_groups.ord','asc')
                ->distinct()
                ->get();

            $dtMenu = DB::table('sys_menus')
                ->select('sys_menus.id', 'sys_menus.group_id', 'sys_menus.name', 'sys_menus.segment_name', 'sys_menus.route', 'sys_menus.ord','sys_menus.status', 'sys_menus.created_at', 'sys_menus.updated_at')
                ->orderBy('sys_menus.ord','asc')
                ->get();

            $menu = [];
            foreach ($dtMenu as $m) {
                $menu[$m->group_id][] = [
                    'id' => $m->id,
                    'group_id' => $m->group_id,
                    'name' => $m->name,
                    'segment_name' => $m->segment_name,
                    'route' => $m->route,
                    'ord' => $m->ord,
                    'created_at' => $m->created_at,
                    'updated_at' => $m->updated_at,
                ];
            }
//        } else {
//            $group = DB::table('sys_permission')
//                ->select('sys_menu_groups.id','sys_menu_groups.name','sys_menu_groups.segment_name','sys_menu_groups.icon','sys_menu_groups.ord','sys_menu_groups.created_at','sys_menu_groups.status','sys_menu_groups.updated_at')
//                ->join('sys_menus','sys_permission.id_menu','=','sys_menus.id')
//                ->join('sys_menu_groups','sys_menus.group_id','=','sys_menu_groups.id')
//                ->where('sys_permission.username','=',$username)
//                ->where('sys_menu_groups.status','<>',1)
//                ->orderBy('sys_menu_groups.ord','asc')
//                ->distinct()
//                ->get();
//
//            $dtMenu = DB::table('sys_permission')
//                ->select('sys_menus.id', 'sys_menus.group_id', 'sys_menus.name', 'sys_menus.segment_name', 'sys_menus.route', 'sys_menus.ord','sys_menus.status', 'sys_menus.created_at', 'sys_menus.updated_at')
//                ->join('sys_menus','sys_permission.id_menu','=','sys_menus.id')
//                ->where('sys_permission.username','=',$username)
//                ->where('sys_menus.status','<>',1)
//                ->orderBy('sys_menus.ord','asc')
//                ->get();
//
//            $menu = [];
//            foreach ($dtMenu as $m) {
//                $menu[$m->group_id][] = [
//                    'id' => $m->id,
//                    'group_id' => $m->group_id,
//                    'name' => $m->name,
//                    'segment_name' => $m->segment_name,
//                    'route' => $m->route,
//                    'ord' => $m->ord,
//                    'status' => $m->status,
//                    'created_at' => $m->created_at,
//                    'updated_at' => $m->updated_at,
//                ];
//            }
//        }

        $i = 0;
        $sidebar = [];
        foreach ($group as $g) {
            $sidebar[$i]['group'] = [
                'name' => $g->name,
                'segment_name' => $g->segment_name,
                'icon' => $g->icon,
                'status' => $g->status,
            ];
            $sidebar[$i]['menu'] = $menu[$g->id];
            $i++;
        }
        return $sidebar;
    }
}
