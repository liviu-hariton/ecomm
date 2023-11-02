<?php

namespace App\DataTables;

use App\Models\Coupon;
use App\Traits\SettingsTrait;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    use SettingsTrait;

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
                    'edit' => '<a href="'.route('admin.coupons.edit', $query).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>',
                    'delete' => '<a href="'.route('admin.coupons.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="coupon-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('active', function($query) {
                return '<label class="custom-switch mt-2">
                        <input type="checkbox" id="status-'.$query->id.'" value="'.$query->status.'" '.($query->status === 1 ? 'checked' : '').' data-id="'.$query->id.'" data-model="App^Models^Coupon" class="custom-switch-input change-status">
                        <span class="custom-switch-indicator"></span>
                      </label>';
            })
            ->addColumn('discount', function($query) {
                $output = '-'.$query->discount_amount.' '.($query->discount_type === 'percentage' ? '%' : '<i class="'.$this->generalSettings('currency_icon').'"></i>');

                return $output;
            })
            ->addColumn('quantity', function($query) {
                return $query->qty;
            })
            ->addColumn('usage', function($query) {
                return '<span class="text-danger">'.($query->usages ?: 0).'</span> / <span class="text-success font-bold">'.$query->max_use.'</span>';
            })
            ->addColumn('time interval', function($query) {
                return $query->start_date.'<br />'.$query->end_date;
            })
            ->rawColumns(['action', 'active', 'discount', 'usage', 'time interval'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
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
            Column::make('name')->addClass('align-middle'),
            Column::make('code')->addClass('align-middle'),
            Column::make('discount')->addClass('align-middle'),
            Column::make('quantity')->addClass('align-middle text-center'),
            Column::make('usage')->addClass('align-middle text-center'),
            Column::make('time interval')->addClass('align-middle text-center'),
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
        return 'Coupon_' . date('YmdHis');
    }
}
