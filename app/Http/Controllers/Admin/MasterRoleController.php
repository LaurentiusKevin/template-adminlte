<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MasterRoleDataTable;
use App\Http\Controllers\Controller;
use App\Services\MasterRoleService;
use Illuminate\Http\Request;

class MasterRoleController extends Controller
{
    private $service;

    public function __construct(MasterRoleService $service)
    {
        $this->service = $service;
    }

    public function index(MasterRoleDataTable $dataTable)
    {
        return $dataTable->render('admin.master-data.user-role.index');
    }

    public function createIndex()
    {
        return view('admin.master-data.user-role.create')
            ->with([
                'menu' => $this->service->menuData()
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request->get('name');
        $info = $request->get('info') ?? null;
        $view = $request->get('view');
        $create = $request->get('create');
        $edit = $request->get('edit');
        $delete = $request->get('delete');

        return $this->service->storeData($name,$info,$view,$create,$edit,$delete);
    }

    public function editIndex(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->get('id');
        return view('admin.master-data.user-role.edit')
            ->with([
                'menu' => $this->service->masterRoleData($id),
                'data' => $this->service->getData($id)
            ]);
    }

    public function editSubmit(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $id = $request->get('id');
        $name = $request->get('name');
        $info = $request->get('info') ?? null;
        $view = $request->get('view');
        $create = $request->get('create');
        $edit = $request->get('edit');
        $delete = $request->get('delete');

        return $this->service->storeData($name,$info,$view,$create,$edit,$delete,$id);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        return $this->service->deleteData($request);
    }
}
