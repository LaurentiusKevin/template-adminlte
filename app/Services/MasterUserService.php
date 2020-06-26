<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\MasterUserRepository;
use Illuminate\Support\Facades\Hash;

class MasterUserService
{
    private $repo;

    public function __construct(MasterUserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getData($id = null)
    {
        if ($id == null) {
            return $this->repo->data();
        } else {
            return $this->repo->data($id);
        }
    }

    public function storeData($name,$email,$username,$password,$role,$id=null)
    {
        return $this->repo->store($name,$email,$username,$password,$role,$id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function resetPassword($password,$id)
    {
        return $this->repo->resetPassword(Hash::make($password), $id);
    }
}
