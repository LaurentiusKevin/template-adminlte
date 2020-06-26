<?php

namespace App\Repositories;

use App\Models\SysMenuGroup;
use Illuminate\Support\Facades\DB;

class SysMenuGroupRepository
{
    public function data($id = null)
    {
        $table = DB::table('sys_menu_groups');
        if ($id == null) {
            return $table->orderBy('ord')->get();
        } else {
            return $table->where('id','=',$id)->first();
        }
    }

    public function store($name, $segmentName, $icon, $ord, $status, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($id == null) {
                $data = new SysMenuGroup();
                $data->name = $name;
                $data->segment_name = $segmentName;
                $data->icon = $icon;
                $data->ord = $ord;
                $data->status = $status;
            } else {
                $data = SysMenuGroup::find($id);
                $data->name = $name;
                $data->segment_name = $segmentName;
                $data->icon = $icon;
                $data->ord = $ord;
                $data->status = $status;
            }
            $data->save();
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
            DB::table('sys_menu_groups')
                ->where('id','=',$id)
                ->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
}
