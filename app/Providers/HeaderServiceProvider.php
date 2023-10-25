<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HeaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $constraint = function ($query) {
            $query->whereNull('parent_id')->where('status', '1');
        };

        $tree = Category::withRecursiveQueryConstraint(function (Builder $query) {
            $query->where('categories.status', '1');
        }, function () use ($constraint) {
            return Category::treeOf($constraint)->get()->toTree();
        });

        View::share('main_menu_categories', $tree);
    }
}
