<?php

namespace App\DataTables;

use App\Constants\Gender;
use App\Models\Student;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
{
    private $query;

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
            ->editColumn('gender', function($model) {
                return Gender::label($model->gender);
            })
            ->addColumn('action', function ($model) {
                return '
                    <a href="'.route('admin.students.edit', $model->id).'" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil-alt"></i>
                    </a>
                    <button class="btn btn-sm btn-danger btn-destroy" data-url="'.route('admin.students.destroy', $model->id).'">
                        <i class="fa fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Student $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
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
            ->setTableId('student-table')
            ->addTableClass('table table-hover table-striped')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
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
            Column::make('name')->title('Name'),
            Column::make('nis')->title('Nomor Induk'),
            Column::make('gender')->title('Jenis Kelamin'),
            Column::make('address')->title('Alamat'),
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
        return 'Student_' . date('YmdHis');
    }
}
