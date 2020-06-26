<?php

namespace App\Repositories;

use App\Models\MasterRole;
use App\Models\RoleMenu;
use Illuminate\Support\Facades\DB;

class MasterRoleRepository
{
    private $menu;

    public function __construct(SysMenuRepository $menu)
    {
        $this->menu = $menu;
    }

    public function data($id = null)
    {
        if ($id == null) {
            return DB::table('master_roles')->get();
        } else {
            return DB::table('master_roles')->where('id','=',$id)->first();
        }
    }

    public function roleMenu($groupID,$masterRoleID)
    {
        return DB::select("
                SELECT sm.id,
                       sm.group_id,
                       sm.name,
                       sm.ord,
                       sm.status,
                       rm.id AS role_menus_id,
                       rm.master_roles_id,
                       rm.sys_menus_id,
                       rm.view,
                       rm.create,
                       rm.edit,
                       rm.delete
                FROM role_menus rm
                LEFT JOIN sys_menus sm on rm.sys_menus_id = sm.id
                WHERE sm.group_id = ? AND rm.master_roles_id = ?
            ",[$groupID,$masterRoleID]);
    }

    public function storeRoleMenu($masterRoleID, $view, $create, $edit, $delete)
    {
        try {
            DB::beginTransaction();
            DB::table('role_menus')->where('master_roles_id','=',$masterRoleID)->delete();
            $dataMenus = $this->menu->data();
            foreach ($dataMenus as $menu) {
                $data = new RoleMenu();
                $data->master_roles_id = $masterRoleID;
                $data->sys_menus_id = $menu->id;
                if ($view !== null) {
                    $data->view = (in_array($menu->id,$view)) ? 1 : 0;
                }
                if ($create !== null) {
                    $data->create = (in_array($menu->id,$create)) ? 1 : 0;
                }
                if ($edit !== null) {
                    $data->edit = (in_array($menu->id,$edit)) ? 1 : 0;
                }
                if ($delete !== null) {
                    $data->delete = (in_array($menu->id,$delete)) ? 1 : 0;
                }
                $data->save();
            }
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    public function store($name, $info, $view, $create, $edit, $delete, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($id == 0) {
                $data = new MasterRole();
                $data->name = $name;
                $data->info = $info;
            } else {
                $data = MasterRole::find($id);
                $data->name = $name;
                $data->info = $info;
            }
            $data->save();
            $this->storeRoleMenu($data->id, $view, $create, $edit, $delete);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            DB::table('master_roles')
                ->where('id','=',$id)
                ->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
}
