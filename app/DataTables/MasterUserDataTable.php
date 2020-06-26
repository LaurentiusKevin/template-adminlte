<?php

namespace App\DataTables;

use App\MasterUser;
use App\Models\User;
use App\Services\MasterUserService;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MasterUserDataTable extends DataTable
{
    private $routeCreate;
    private $routeEdit;
    private $routeDelete;
    private $resetPassword;

    public function __construct()
    {
        $this->routeCreate = route('admin.master-data.user-aplikasi.view.create');
        $this->routeEdit = route('admin.master-data.user-aplikasi.view.edit');
        $this->routeDelete = route('admin.master-data.user-aplikasi.api.submit-delete');
        $this->resetPassword = route('admin.master-data.user-aplikasi.api.submit-reset-password');
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
    }

    /**
     * Get query source of dataTable.
     *
     * @param MasterUserService $service
     * @return User[]|Collection
     */
    public function query(MasterUserService $service)
    {
        return $service->getData();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('listData')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => [
                    [
                        'text' => '<i class="fas fa-plus"></i> Create',
                        'className' => 'btn btn-sm btn-success',
                        'action' => 'function(e, dt, node, config) { create("'.$this->routeCreate.'") }'
                    ],
                    [
                        'text' => '<i class="fas fa-edit"></i> Edit',
                        'className' => 'btn btn-sm btn-warning',
                        'action' => 'function(e, dt, node, config) { editData("'.$this->routeEdit.'") }'
                    ],
                    [
                        'text' => '<i class="fas fa-trash"></i> Delete',
                        'className' => 'btn btn-sm btn-danger',
                        'action' => 'function(e, dt, node, config) { deleteData("'.$this->routeDelete.'") }'
                    ],
                    [
                        'text' => '<i class="fas fa-key"></i> Reset Password',
                        'className' => 'btn btn-sm btn-primary',
                        'action' => 'function(e, dt, node, config) { resetPassword("'.$this->resetPassword.'") }'
                    ]
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('email'),
            Column::make('username'),
            Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MasterUser_' . date('YmdHis');
    }
}
