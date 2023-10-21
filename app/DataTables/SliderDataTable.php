<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        /**
         * Not a big fan of using HTML code inside PHP code (should be loaded from view and / or components)
         * but for the sake of the tutorial, let it be like this for now
         */
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $edit_button = '<a href="'.route('admin.slider.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>';
                $delete_button = '<a href="'.route('admin.slider.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="slider-table"><i class="fa fa-trash"></i></a>';

                return $edit_button.$delete_button;
            })
            ->addColumn('banner', function($query) {
                return '<img src="'.asset($query->banner).'" title="'.$query->title.'" alt="'.$query->title.'" class="img-fluid" />';
            })
            ->addColumn('url', function($query) {
                return '<a href="'.$query->btn_url.'" target="_blank">'.$query->btn_url.' <i class="fas fa-external-link-alt"></i></a>';
            })
            ->addColumn('active', function($query) {
                return $query->status === 1 ? '<span class="badge badge-success">yes</span>' : '<span class="badge badge-secondary">no</span>';
            })
            ->rawColumns(['banner', 'action', 'url', 'active'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
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
            Column::make('id')->width(50),
            Column::make('banner')->width(200),
            Column::make('title'),
            Column::make('type'),
            Column::make('starting_price'),
            Column::make('url'),
            Column::make('sort_order')->addClass('text-center'),
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
        return 'Slider_' . date('YmdHis');
    }
}
