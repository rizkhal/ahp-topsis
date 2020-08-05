<?php

namespace App\DataTables;

use App\Models\Criteria;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CriteriaDataTable extends DataTable
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
            ->addIndexColumn()
            ->editColumn('created_at', function ($model) {
                return $model->created_at->diffForHumans();
            })
            ->addColumn('action', function ($model) {
                return '
                    <button type="button" data-id="'.$model->id.'" class="btn-edit btn btn-warning"><i class="fa fa-pencil-alt"></i></button>
                    <button type="button" data-url="'.route('admin.criteria.destroy', $model->id).'" class="btn-destroy btn btn-danger"><i class="fa fa-trash"></i></button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AhpDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Criteria $model)
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
            ->addTableClass('table table-hover table-stripped')
            ->setTableId('criteria-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(1)
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
                ->title('Nama Criteria'),
            Column::make('bobot')
                ->title('Bobot Criteria'),
            Column::make('created_at')
                ->title('Di Buat'),
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
        return 'Ahp_' . date('YmdHis');
    }
}
