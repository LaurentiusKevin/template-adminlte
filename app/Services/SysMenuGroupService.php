<?php

namespace App\Services;


use App\Repositories\SysMenuGroupRepository;

class SysMenuGroupService
{
    private $repo;

    public function __construct(SysMenuGroupRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getData($id = null)
    {
        return $this->repo->data($id);
    }

    public function store($name,$segmentName,$icon,$order)
    {
        return $this->repo->store($name,$segmentName,$icon,$order,1);
    }

    public function edit($name,$segmentName,$icon,$order,$id)
    {
        return $this->repo->store($name,$segmentName,$icon,$order,1,$id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
