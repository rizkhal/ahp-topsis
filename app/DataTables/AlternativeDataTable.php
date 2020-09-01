<?php

namespace App\DataTables;

use App\Models\Alternative;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AlternativeDataTable extends DataTable
{
    /**
     * Query of the alternative
     *
     * @var object
     */
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
            ->addIndexColumn()
            ->editColumn('created_at', function($model) {
                return date('d F Y', strtotime($model->created_at));
            })
            ->editColumn('description', function($model) {
                if (is_null($model->description)) {
                    return '<span class="badge badge-info">Kosong</span>';
                }

                return $model->description;
            })
            ->addColumn('action', function ($model) {
                return '
                    <a href="' . route('admin.alternatives.edit', $model->id) . '" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <button class="btn btn-sm btn-danger btn-destroy" data-url="' . route('admin.alternatives.destroy', $model->id) . '">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['description', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Alternative $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Alternative $model)
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
            ->setTableId('alternative-table')
            ->addTableClass('table table-hover table-stripped')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(3, 'desc');
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
            Column::make('name')
                ->title('Nama'),
            Column::make('description')
                ->title('Deskripsi'),
            Column::make('created_at')
                ->title('Tanggal')
                ->width(100),
            Column::computed('action', 'Aksi')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(100),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Alternative_' . date('YmdHis');
    }
}
