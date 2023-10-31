<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
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
                    'edit' => '<a href="'.route('admin.product.edit', $query->product).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>',
                    'options' => '<div class="dropdown dropleft d-inline">
                                      <button type="button" class="btn btn-sm btn-primary dropdown-toggle ml-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cogs"></i>
                                      </button>
                                      <div class="dropdown-menu">
                                        <a class="dropdown-item" href="'.route('admin.image-gallery.index', ['pid' => $query->product->id]).'"><i class="fa fa-images"></i> Image gallery</a>
                                        <a class="dropdown-item" href="'.route('admin.variant.index', ['pid' => $query->product->id]).'"><i class="fa fa-th-list"></i> Variants</a>
                                      </div>
                                  </div>',
                    'delete' => '<a href="'.route('admin.flash-sale.remove-product', ['fiid' => $query->id]).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="flashsaleitem-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('image', function($query) {
                return '<img src="'.asset($query->product->image).'" title="'.$query->product->name.'" alt="'.$query->product->name.'" class="img-fluid" />';
            })
            ->addColumn('name', function($query) {
                $output = '<strong>'.$query->product->name.'</strong>';

                $output .= '<ul class="list-unstyled mt-2">
                                <li class="text-small">SKU: '.$query->product->sku.' </li>
                                <li class="text-small">Category: <a href="'.route('admin.category.edit', $query->product->category).'">'.$query->product->category->name.'</a></li>
                                <li class="text-small">Brand: <a href="'.route('admin.brand.edit', $query->product->brand).'">'.$query->product->brand->name.'</a></li>
                            </ul>';

                return $output;
            })
            ->addColumn('vendor', function($query) {
                if(auth()->user()->id === $query->product->vendor->user_id) {
                    $output = '<a href="'.route('admin.vendor-profile.index').'"><i class="fas fa-user-circle"></i> '.auth()->user()->name.'</a>';
                } else {
                    $output = '<a href="'.route('admin.vendor.edit', $query->product->vendor).'"><i class="fas fa-user-circle"></i> '.$query->product->vendor->user->name.'</a>';
                }

                return $output;
            })
            ->addColumn('stock', function($query) {
                return '<span class="badge badge-primary">'.$query->product->qty.'</span>';
            })
            ->addColumn('url', function($query) {
                return '<a href="'.$query->product->slug.'" target="_blank">'.$query->product->slug.' <i class="fas fa-external-link-alt"></i></a>';
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^FlashSaleItem" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('home carousel', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="home-carousel-'.$query->id.'" value="'.$query->home_carousel.'" '.($query->home_carousel === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^FlashSaleItem" class="custom-switch-input change-home-carousel">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('price', function($query) {
                $output = '';

                if($query->product->offer_price > 0) {
                    $output = '<del class="text-danger text-small">'.$query->product->price.'</del>';
                    $output .= '<br />'.$query->product->offer_price;
                } else {
                    $output .= $query->product->price;
                }

                return $output;
            })
            ->addColumn('variants', function($query) {
                return $query->product->variants->count();
            })
            ->rawColumns(['action', 'home carousel', 'active', 'url', 'image', 'name', 'stock', 'price', 'vendor'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery()->with('product');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
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
            Column::make('image')->width(80),
            Column::make('name')->addClass('align-middle'),
            Column::make('variants')->addClass('text-center align-middle'),
            Column::make('url')->addClass('align-middle'),
            Column::make('vendor')->addClass('align-middle'),
            Column::make('stock')->addClass('text-center align-middle'),
            Column::make('price')->addClass('text-right align-middle'),
            Column::make('home carousel')->addClass('text-center align-middle'),
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
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
