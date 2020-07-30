<?php

namespace App\DataTables;

use App\Models\Calculate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CalculateDataTable extends DataTable
{
    protected $query;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable()
    {
        return datatables()
            ->eloquent($this->query)
            ->editColumn('created_at', function($model) {
                return $model->created_at->diffForHumans();
            })
            ->addColumn('action', function($model) {
                return '
                    <button type="button" class="btn btn-info">
                        <i class="fa fa-eye"></i>
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\CalculateDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Calculate $model)
    {
        $this->query = $model->newQuery();
        return $this->applyScopes($this->query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->addTableClass('table table-hover table-striped')
            ->setTableId('calculatedatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(3, 'desc')
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('description'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Ahp-Topsis_' . date('YmdHis');
    }
}
