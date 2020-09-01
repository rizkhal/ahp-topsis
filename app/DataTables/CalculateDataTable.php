<?php

namespace App\DataTables;

use App\Models\Calculate;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CalculateDataTable extends DataTable
{
    /**
     * Query of the calculate
     * 
     * @var collection
     */
    private $query;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($model) {
                return date('d F Y', strtotime($model->created_at));
            })
            ->addColumn('candidate', function($model) {
                return 'aa';
            })
            ->addColumn('action', function ($model) {
                return '
                    <a href="'.route('admin.calculate.show', $model->id).'" class="btn btn-sm btn-info">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="'.route('admin.calculate.edit', $model->id).'" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <button class="btn btn-sm btn-danger btn-destroy" data-url="'.route('admin.calculate.destroy', $model->id).'">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Calculate $model
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
            ->setTableId('calculatedatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('No')
                ->defaultContent('')
                ->data('DT_RowIndex')
                ->name('DT_RowIndex')
                ->title('No')
                ->render(null)
                ->orderable(false)
                ->searchable(false)
                ->footer(''),
            Column::computed('candidate', 'Candidate'),
            Column::make('created_at')
                ->title('Tanggal')
                ->width(100),
            Column::computed('action', 'Aksi')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Calculate_' . date('YmdHis');
    }
}
