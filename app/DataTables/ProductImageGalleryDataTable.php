<?php

namespace App\DataTables;

use App\Models\ProductImageGallery;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductImageGalleryDataTable extends DataTable
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
                    'edit' => '<a href="'.route(userRole().'.image-gallery.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>',
                    'delete' => '<a href="'.route(userRole().'.image-gallery.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="productimagegallery-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('image', function($query) {
                return '<img src="'.asset($query->image).'" title="'.$query->image.'" alt="'.$query->image.'" class="img-fluid" />';
            })
            ->addColumn('vendor', function($query) {
                return $query->product->vendor->user->name;
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^ProductImageGallery" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->rawColumns(['image', 'action', 'url', 'active'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductImageGallery $model): QueryBuilder
    {
        $base_query = $model->newQuery()->with('product')->where('product_id', request('pid'));

        return $base_query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productimagegallery-table')
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
            Column::make('vendor')->addClass('align-middle'),
            Column::make('image')->width(150),
            Column::make('title')->addClass('align-middle'),
            Column::make('alt')->addClass('align-middle'),
            Column::make('sort_order')->addClass('align-middle text-center'),
            Column::make('active')->addClass('align-middle text-center'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('align-middle text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductImageGallery_' . date('YmdHis');
    }
}
