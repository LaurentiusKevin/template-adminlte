<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SysMenuDataTable;
use App\Http\Controllers\Controller;
use App\Services\SysMenuGroupService;
use App\Services\SysMenuService;
use Illuminate\Http\Request;

class SysMenuController extends Controller
{
    private $service;
    private $menuGroup;

    public function __construct(SysMenuService $service, SysMenuGroupService $menuGroup)
    {
        $this->service = $service;
        $this->menuGroup = $menuGroup;
    }

    public function index(SysMenuDataTable $dataTable)
    {
        return $dataTable->render('admin.system-utility.menu.index');
    }

    public function createIndex()
    {
        return view('admin.system-utility.menu.create')
            ->with([
                'group' => $this->menuGroup->getData()
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
            'name' => 'required',
            'segment_name' => 'required',
            'route' => 'required',
            'ord' => 'required'
        ]);

        $groupID = $request->get('group_id');
        $name = $request->get('name');
        $segmentName = $request->get('segment_name');
        $route = $request->get('route');
        $order = $request->get('ord');

        return $this->service->storeData($groupID,$name,$segmentName,$route,$order);
    }

    public function editIndex(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->get('id');

        return view('admin.system-utility.menu.edit')
            ->with([
                'data' => $this->service->getData($id),
                'group' => $this->menuGroup->getData()
            ]);
    }

    public function editSubmit(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'group_id' => 'required',
            'name' => 'required',
            'segment_name' => 'required',
            'route' => 'required',
            'ord' => 'required'
        ]);

        $id = $request->get('id');
        $groupID = $request->get('group_id');
        $name = $request->get('name');
        $segmentName = $request->get('segment_name');
        $route = $request->get('route');
        $order = $request->get('ord');

        return $this->service->storeData($groupID,$name,$segmentName,$route,$order,$id);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->get('id');

        return $this->service->deleteData($id);
    }
}
