<?php

namespace App\Services;

use App\Repositories\SysMenuRepository;

class SysMenuService
{
    private $repo;

    public function __construct(SysMenuRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getData($id = null)
    {
        return $this->repo->data($id);
    }

    public function storeData($groupID,$name,$segmentName,$route,$order,$id = null)
    {
        return $this->repo->store($groupID,$name,$segmentName,$route,$order,$id);
    }

    public function deleteData($id)
    {
        return $this->repo->delete($id);
    }
}
