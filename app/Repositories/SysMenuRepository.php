<?php

namespace App\Repositories;

use App\Models\SysMenu;
use Illuminate\Support\Facades\DB;

class SysMenuRepository
{
    public function data($id = null)
    {
        $table = DB::table('sys_menus');
        if ($id == null) {
            return DB::select("
                select sys_menus.id,
                       smg.name as group_name,
                       sys_menus.name,
                       sys_menus.segment_name,
                       route,
                       sys_menus.ord,
                       sys_menus.status
                from sys_menus
                join sys_menu_groups smg on sys_menus.group_id = smg.id
            ");
        } else {
            return $table->where('id','=',$id)->first();
        }
    }

    public function dataByGroupID($id)
    {
        return DB::table('sys_menus')->where('group_id','=',$id)->get();
    }

    public function store($groupID,$name,$segmentName,$route,$order,$id = null)
    {
        try {
            if ($id == null) {
                $data = new SysMenu();
                $data->group_id = $groupID;
                $data->name = $name;
                $data->segment_name = $segmentName;
                $data->route = $route;
                $data->ord = $order;
            } else {
                $data = SysMenu::find($id);
                $data->group_id = $groupID;
                $data->name = $name;
                $data->segment_name = $segmentName;
                $data->route = $route;
                $data->ord = $order;
            }
            $data->save();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('sys_menus')->where('id','=',$id)->delete();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
}
