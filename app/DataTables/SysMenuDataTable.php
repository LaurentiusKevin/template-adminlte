<?php

namespace App\DataTables;

use App\Services\SysMenuService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SysMenuDataTable extends DataTable
{
    private $routeCreate;
    private $routeEdit;
    private $routeDelete;

    public function __construct()
    {
        $this->routeCreate = route('admin.system.menu.view.create');
        $this->routeEdit = route('admin.system.menu.view.edit');
        $this->routeDelete = route('admin.system.menu.api.submit-delete');
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
     * @param SysMenuService $service
     * @return array|Model|Builder|object
     */
    public function query(SysMenuService $service)
    {
        return $service->getData();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
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
                        'className' => 'btn btn-success',
                        'action' => 'function(e, dt, node, config) { create("'.$this->routeCreate.'") }'
                    ],
                    [
                        'text' => '<i class="fas fa-edit"></i> Edit',
                        'className' => 'btn btn-warning',
                        'action' => 'function(e, dt, node, config) { editData("'.$this->routeEdit.'") }'
                    ],
                    [
                        'text' => '<i class="fas fa-trash"></i> Delete',
                        'className' => 'btn btn-danger',
                        'action' => 'function(e, dt, node, config) { deleteData("'.$this->routeDelete.'") }'
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
            Column::make('group_name'),
            Column::make('name'),
            Column::make('segment_name'),
            Column::make('route'),
            Column::make('ord'),
            Column::make('status')
                ->render('function (data, type, row, meta) {
                    if(data == 0) {
                        return "disabled"
                    } else {
                        return "active"
                    }
                }'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SysMenu_' . date('YmdHis');
    }
}
