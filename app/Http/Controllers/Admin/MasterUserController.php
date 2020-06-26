<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MasterUserDataTable;
use App\Http\Controllers\Controller;
use App\Services\MasterRoleService;
use App\Services\MasterUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MasterUserController extends Controller
{
    private $service;
    private $role;

    public function __construct(MasterUserService $service, MasterRoleService $role)
    {
        $this->service = $service;
        $this->role = $role;
    }

    public function index(MasterUserDataTable $dataTable)
    {
        return $dataTable->render('admin.master-data.user-aplikasi.index');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'password' => 'required'
        ]);

        $id = $request->get('id');
        $password = $request->get('password');

        return $this->service->resetPassword($password,$id);
    }

    public function createIndex()
    {
        $char = '0123456789';
        $charLength = strlen($char);
        $randomChar = '';
        for ($i = 0; $i < 5; $i++) {
            $randomChar .= $char[rand(0, $charLength - 1)];
        }
        return view('admin.master-data.user-aplikasi.create')
            ->with([
                'password' => $randomChar,
                'role' => $this->role->getData()
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'master_roles_id' => 'required'
        ]);

        $name = $request->get('name');
        $email = $request->get('email') ?? '';
        $username = $request->get('username');
        $password = $request->get('password');
        $role = $request->get('master_roles_id');

        return $this->service->storeData($name,$email,$username,$password,$role);
    }

    public function editIndex(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->get('id');

        return view('admin.master-data.user-aplikasi.edit')
            ->with([
                'role' => $this->role->getData(),
                'data' => $this->service->getData($id)
            ]);
    }

    public function editSubmit(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'username' => 'required',
            'master_roles_id' => 'required'
        ]);

        $id = $request->get('id');
        $name = $request->get('name');
        $email = ($request->get('email') == '') ? null : $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password') ?? null;
        $role = $request->get('master_roles_id');

        return $this->service->storeData($name,$email,$username,$password,$role,$id);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->get('id');

        return $this->service->delete($id);
    }
}
