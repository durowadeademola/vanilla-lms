<?php

namespace App\DataTables;

use App\Models\Semester;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SemesterDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

       /* $dataTable->addColumn('start_date', function ($query) {   
            return date('D-M-Y', strtotime($query->start_date)); 
        });
*/
        $dataTable->editColumn('academic_session', function ($query) {
            if($query->is_current == 1){
                return "<font color='green'> ". $query->academic_session ."</font>";
            } else {
                return $query->academic_session;
            }   
        })->escapeColumns('active')->make(true);

        $dataTable->editColumn('code', function ($query) {
            if($query->is_current == 1){ return "<font color='green'> ". $query->code ."</font>";
            } else { return $query->code; }
        })->escapeColumns('green')->make(true);

        $dataTable->editColumn('start_date', function ($query) {
            if($query->is_current == 1){ return "<font color='green'> ". date('(D) d-M-Y', strtotime($query->start_date)) ."</font>";
            } else { return date('(D) d-M-Y', strtotime($query->start_date)); }
        })->escapeColumns('active')->make(true);

        $dataTable->editColumn('end_date', function ($query) {
            if($query->is_current == 1){ return "<font color='green'> ". date('(D) d-M-Y', strtotime($query->end_date)) ."</font>";
            } else { return date('(D) d-M-Y', strtotime($query->end_date)); }
        })->escapeColumns('active')->make(true);

        $dataTable->editColumn('status', function ($query) {
            if ($query->status == 1) {
                $statusVal = 'Current Semester';
            } else {
                $statusVal = 'Semester Not Current';
            }
            if($query->is_current == 1){ return "<font color='green'> ". $statusVal ."</font>";
            } else { return $statusVal; }
        })->escapeColumns('active')->make(true);

        return $dataTable->addColumn('action', 'semesters.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Semester $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Semester $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    /* ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',], */
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner mt-5 ml-5 dt-btn-w',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner mt-5 ml-5 dt-btn-w',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner mt-5 ml-5 dt-btn-w',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner mt-5 ml-5 dt-btn-w',],
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
            'academic_session',
            ['title'=>'Semester Code','data'=>"code"],
            'start_date',
            'end_date',
            'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'semesters_datatable_' . time();
    }
}
