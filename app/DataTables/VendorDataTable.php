<?php

namespace App\DataTables;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorDataTable extends DataTable
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
                    'edit' => '<a href="'.route('admin.vendor.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>',
                    'delete' => '<a href="'.route('admin.vendor.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="vendor-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('url', function($query) {
                return '<a href="'.$query->slug.'" target="_blank">'.$query->slug.' <i class="fas fa-external-link-alt"></i></a>';
            })
            ->addColumn('logo', function($query) {
                return '<img src="'.asset($query->banner).'" title="'.$query->name.'" alt="'.$query->name.'" class="img-fluid" />';
            })
            ->addColumn('products', function($query) {
                $pcount = $query->products->count();

                return $pcount > 0 ? '<a href="'.route('admin.product.index', ['vid' => $query->id]).'" class="btn btn-sm btn-secondary"><i class="fa fa-th-list"></i> '.$pcount.'</a>' : $pcount;
            })
            ->rawColumns(['logo', 'action', 'url', 'products'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vendor $model): QueryBuilder
    {
        return $model->newQuery()->where('user_id', '<>', auth()->user()->id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendor-table')
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
            Column::make('id')->addClass('align-middle'),
            Column::make('logo')->width(100),
            Column::make('shop_name')->addClass('align-middle'),
            Column::make('phone')->addClass('align-middle'),
            Column::make('email')->addClass('align-middle'),
            Column::make('url')->addClass('align-middle'),
            Column::make('products')->addClass('align-middle text-center'),

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
        return 'Vendor_' . date('YmdHis');
    }
}
