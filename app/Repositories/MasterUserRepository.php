<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterUserRepository
{
    public function data($id = null)
    {
        if ($id == null) {
            return User::all();
        } else {
            return User::find($id);
        }
    }

    public function store($name,$email,$username,$password,$role,$id=null)
    {
        try {
            DB::beginTransaction();
            if ($id == null) {
                $data = new User();
                $data->name = $name;
                $data->email = $email;
                $data->username = $username;
                $data->password = Hash::make($password);
                $data->master_roles_id = $role;
            } else {
                $data = User::find($id);
                $data->name = $name;
                $data->email = $email;
                $data->username = $username;
                if ($password !== null) {
                    $data->password = Hash::make($password);
                }
                $data->master_roles_id = $role;
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
            DB::table('users')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    public function resetPassword($password,$id)
    {
        try {
            $data = User::find($id);
            $data->password = $password;
            $data->save();

            return 'success';
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
}
