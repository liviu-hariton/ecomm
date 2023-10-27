<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
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
                    'edit' => '<a href="'.route('admin.product-variant-item.edit', ['viid' => $query->id]).'" class="btn btn-warning btn-sm ml-1"><i class="fa fa-pencil-alt"></i></a>',
                    'delete' => '<a href="'.route('admin.product-variant-item.destroy', ['viid' => $query->id]).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="productvariantitem-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('vendor', function($query) {
                return $query->product->vendor->user->name;
            })
            ->addColumn('product', function($query) {
                return $query->product->name;
            })
            ->addColumn('variant name', function($query) {
                return $query->product_variant->name;
            })
            ->addColumn('item name', function($query) {
                return $query->name;
            })
            ->addColumn('default', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="default-'.$query->id.'" value="'.$query->is_default.'" '.($query->is_default === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-vid="'.$query->product_variant_id.'" data-model="App^Models^ProductVariantItem" class="custom-switch-input defaults change-default">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^ProductVariantItem" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->rawColumns(['action', 'active', 'default'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        $base_query = $model->newQuery()->with('product_variant', 'product')->where('product_variant_id', request('vid'));

        return $base_query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariantitem-table')
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
            Column::make('id')->width(50)->addClass('align-middle'),
            Column::make('vendor')->addClass('align-middle'),
            Column::make('product')->addClass('align-middle'),
            Column::make('variant name')->addClass('align-middle'),
            Column::make('item name')->addClass('align-middle'),
            Column::make('price')->addClass('text-right align-middle'),
            Column::make('default')->addClass('align-middle text-center'),
            Column::make('active')->addClass('align-middle text-center'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('align-middle text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
