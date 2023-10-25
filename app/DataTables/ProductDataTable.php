<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
                    'edit' => '<a href="'.route('admin.product.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>',
                    'options' => '<div class="dropdown dropleft d-inline">
                                      <button type="button" class="btn btn-sm btn-primary dropdown-toggle ml-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="'.route('admin.image-gallery.index', ['pid' => $query->id]).'"><i class="fa fa-images"></i> Image gallery</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-th-list"></i> Variants</a>
                                      </div>
                                  </div>',
                    'delete' => '<a href="'.route('admin.product.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="product-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('image', function($query) {
                return '<img src="'.asset($query->image).'" title="'.$query->name.'" alt="'.$query->name.'" class="img-fluid" />';
            })
            ->addColumn('name', function($query) {
                $output = '<strong>'.$query->name.'</strong>';

                $output .= '<ul class="list-unstyled mt-2">
                                <li class="text-small">SKU: '.$query->sku.' </li>
                                <li class="text-small">Category: <a href="'.route('admin.category.show', $query->category).'">'.$query->category->name.'</a></li>
                                <li class="text-small">Brand: <a href="'.route('admin.brand.edit', $query->brand).'">'.$query->brand->name.'</a></li>
                            </ul>';

                return $output;
            })
            ->addColumn('vendor', function($query) {
                return $query->vendor->user->name;
            })
            ->addColumn('stock', function($query) {
                return '<span class="badge badge-primary">'.$query->qty.'</span>';
            })
            ->addColumn('url', function($query) {
                return '<a href="'.$query->slug.'" target="_blank">'.$query->slug.' <i class="fas fa-external-link-alt"></i></a>';
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^Product" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('approved', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="featured-'.$query->id.'" value="'.$query->approved.'" '.($query->approved === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^Product" class="custom-switch-input change-approved">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('price', function($query) {
                $output = '';

                if($query->offer_price > 0) {
                    $output = '<del class="text-danger text-small">'.$query->price.'</del>';
                    $output .= '<br />'.$query->offer_price;
                } else {
                    $output .= $query->price;
                }

                return $output;
            })
            ->rawColumns(['action', 'approved', 'active', 'url', 'image', 'name', 'stock', 'price'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        $base_query = $model->newQuery()->with('brand', 'category', 'vendor');

        return $base_query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0, 'desc')
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
            Column::make('image')->width(80),
            Column::make('name')->addClass('align-middle'),
            Column::make('url')->addClass('align-middle'),
            Column::make('vendor')->addClass('align-middle'),
            Column::make('stock')->addClass('align-middle'),
            Column::make('price')->addClass('text-right align-middle'),
            Column::make('approved')->addClass('text-center align-middle'),
            Column::make('active')->addClass('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(130)
                ->addClass('text-center align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
