<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
                $buttons = [
                    'edit' => '<a href="'.route('admin.brand.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>',
                    'delete' => '<a href="'.route('admin.brand.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="brand-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('url', function($query) {
                return '<a href="'.$query->slug.'" target="_blank">'.$query->slug.' <i class="fas fa-external-link-alt"></i></a>';
            })
            ->addColumn('logo', function($query) {
                return '<img src="'.asset($query->logo).'" title="'.$query->name.'" alt="'.$query->name.'" class="img-fluid" />';
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^Brand" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('featured', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="featured-'.$query->id.'" value="'.$query->featured.'" '.($query->featured === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^Brand" class="custom-switch-input change-featured">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->rawColumns(['logo', 'action', 'featured', 'active', 'url'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('id')->width(50)->addClass('align-middle'),
            Column::make('logo')->width(100),
            Column::make('name')->addClass('align-middle'),
            Column::make('url')->addClass('align-middle'),
            Column::make('featured')->addClass('text-center align-middle'),
            Column::make('active')->addClass('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
