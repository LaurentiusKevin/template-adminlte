<?php

namespace App\Services;

use App\Repositories\MasterRoleRepository;
use App\Repositories\SysMenuGroupRepository;
use App\Repositories\SysMenuRepository;

class MasterRoleService
{
    private $repo;
    private $group;
    private $menu;

    public function __construct(MasterRoleRepository $repo, SysMenuGroupRepository $group, SysMenuRepository $menu)
    {
        $this->repo = $repo;
        $this->group = $group;
        $this->menu = $menu;
    }

    public function menuData()
    {
        $menu = [];
        foreach ($this->group->data() AS $group) {
            $menu[$group->id] = [
                'name' => $group->name,
                'menu' => $this->menu->dataByGroupID($group->id)
            ];
        }
        return $menu;
    }

    public function getData($id = 0)
    {
        return $this->repo->data($id);
    }

    public function storeData($name, $info, $view, $create, $edit, $delete, $id = null)
    {
        return $this->repo->store($name, $info, $view, $create, $edit, $delete, $id);
    }

    public function masterRoleData($id)
    {
//        return $this->repo->roleMenu($id);
        $menu = [];
        foreach ($this->group->data() AS $group) {
            $menu[$group->id] = [
                'name' => $group->name,
                'menu' => $this->repo->roleMenu($group->id,$id)
            ];
        }
        return $menu;
    }

    public function deleteData($request)
    {
        $id = $request->get('id');
        return $this->repo->delete($id);
    }
}
