<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SysMenuGroupDataTable;
use App\Http\Controllers\Controller;
use App\Services\SysMenuGroupService;
use Illuminate\Http\Request;

class SysMenuGroupController extends Controller
{
    protected $service;

    public function __construct(SysMenuGroupService $sysMenuGroupService)
    {
        $this->service = $sysMenuGroupService;
    }

    public function index(SysMenuGroupDataTable $dataTable)
    {
        return $dataTable->render('admin.system-utility.menu-group.index');
    }

    public function create()
    {
        return view('admin.system-utility.menu-group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'segment_name' => 'required',
            'icon' => 'required',
            'ord' => 'required'
        ]);

        $name = $request->get('name');
        $segmentName = $request->get('segment_name');
        $icon = $request->get('icon');
        $order = $request->get('ord');

        return $this->service->store($name,$segmentName,$icon,$order);
    }

    public function editIndex(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->get('id');

        return view('admin.system-utility.menu-group.edit')
            ->with([
                'data' => $this->service->getData($id)
            ]);
    }

    public function editSubmit(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'segment_name' => 'required',
            'icon' => 'required',
            'ord' => 'required'
        ]);

        $id = $request->get('id');
        $name = $request->get('name');
        $segmentName = $request->get('segment_name');
        $icon = $request->get('icon');
        $order = $request->get('ord');

        return $this->service->edit($id,$name,$segmentName,$icon,$order);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        return $this->service->delete($request->get('id'));
    }
}
