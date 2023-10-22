<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $edit_button = '<a href="'.route('admin.category.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>';
                $delete_button = '<a href="'.route('admin.category.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="category-table"><i class="fa fa-trash"></i></a>';

                return $edit_button.$delete_button;
            })
            ->addColumn('icon', function($query) {
                return '<span class="btn btn-info"><i class="'.$query->icon.'"></i></span>';
            })
            ->addColumn('slug', function($query) {
                return '<a href="'.$query->slug.'" target="_blank">'.$query->slug.' <i class="fas fa-external-link-alt"></i></a>';
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^Category" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->rawColumns(['icon', 'action', 'slug', 'active'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id')->addClass('text-center')->width(50),
            Column::make('icon')->addClass('text-center')->width(50),
            Column::make('name'),
            Column::make('slug'),
            Column::make('active')->addClass('text-center'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
