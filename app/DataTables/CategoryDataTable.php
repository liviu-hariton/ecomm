<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;
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
        /**
         * Not a big fan of using HTML code inside PHP code (should be loaded from view and / or components)
         * but for the sake of the tutorial, let it be like this for now
         *
         * @TODO move the HTML code in external components
         */
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
                $buttons = [
                    'children' => $query->children->count() > 0 ? '<a href="'.route('admin.category.show', $query).'" class="btn btn-info btn-sm"><i class="fa fa-sitemap"></i></a>' : '',
                    'new_children' => '<a href="'.route('admin.category.create', ['parent' => $query->id]).'" class="btn btn-success btn-sm ml-1"><i class="fa fa-plus-square"></i></a>',
                    'edit' => '<a href="'.route('admin.category.edit', $query).'" class="btn btn-warning btn-sm ml-1"><i class="fa fa-pencil-alt"></i></a>',
                    'delete' => '<a href="'.route('admin.category.destroy', $query).'" class="btn btn-danger btn-sm ml-1 delete-item" data-table="category-table"><i class="fa fa-trash"></i></a>'
                ];

                return implode('', $buttons);
            })
            ->addColumn('icon', function($query) {
                return $query->icon !== 'empty' ? '<span class="btn btn-info"><i class="'.$query->icon.'"></i></span>' : '';
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
            ->addColumn('parent', function($query) {
                if($query->parent_id === null) {
                    $parent = '[ROOT]';
                } else {
                    $parent = $query->parent->parent_id === null ? '<a href="'.route('admin.category.index').'" class="text-info"><i class="fa fa-sitemap"></i> '.$query->parent->name.'</a>' : '<a href="'.route('admin.category.show', $query->parent->parent_id).'" class="text-info"><i class="fa fa-search"></i> '.$query->parent->name.'</a>';
                }

                return $parent;
            })
            ->addColumn('childs count', function($query) {
                return $query->children->count();
            })
            ->addColumn('products', function($query) {
                return $query->products->count();
            })
            ->rawColumns(['icon', 'action', 'slug', 'active', 'parent'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model, Request $request): QueryBuilder
    {
        $base_query = $model->newQuery();

        if(isset($request->category)) {
            $base_query->where('parent_id', $request->category);
        } else {
            $base_query->where('parent_id', null);
        }

        return $base_query;
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
            Column::make('parent'),
            Column::make('icon')->addClass('text-center')->width(50),
            Column::make('name'),
            Column::make('slug'),
            Column::make('childs count')->addClass('text-center'),
            Column::make('products')->addClass('align-middle text-center'),
            Column::make('active')->addClass('text-center'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(140)
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
