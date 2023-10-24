<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Load the categories tree, with parent - childs relations
     */
    public function categoriesTree(string $return_type = 'select_options', int $parent_id = null, int $padding = 0, array $selected = [], array $ignore = [], string $branch = '')
    {
        $categories_array = [];
        $categories_options = '';

        foreach(Category::where('parent_id', $parent_id)->get() as $category)
        {
            if(!in_array($category->id, $ignore)) {
                switch($return_type)
                {
                    case "array":
                        $categories_array[] = [
                            'item' => $category,
                            'selected' => in_array($category->id, $selected) ?? false,
                            'branch' => $branch,
                            'children' => $this->categoriesTree(
                                return_type: $return_type,
                                parent_id: $category->id,
                                padding: $padding + 10,
                                selected: $selected,
                                ignore: $ignore,
                                branch: '|- '
                            )
                        ];
                        break;
                    case "select_options":
                        $sel = in_array($category->id, $selected) ? ' selected="selected"' : '';

                        $categories_options .= '<option value="'.$category->id.'" data-padding="'.$padding.'"'.$sel.'>'.$branch.$category->name.'</option>';

                        $categories_options .= $this->categoriesTree(
                            return_type: $return_type,
                            parent_id: $category->id,
                            padding: $padding + 10,
                            selected: $selected,
                            ignore: $ignore,
                            branch: '|- '
                        );
                        break;
                }

            }
        }

        if($return_type == 'array') {
            return $categories_array;
        }

        if($return_type == 'select_options') {
            return $categories_options;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.category.create', [
            'categories_tree' => $this->categoriesTree(
                selected: [$request->parent]
            )
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $validated = $request->validated();

        Category::create($validated);

        toastr('Category created successfully');

        return $validated['parent_id'] === null ? redirect()->route('admin.category.index') : redirect()->route('admin.category.show', $validated['parent_id']);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryDataTable $dataTable, Request $request)
    {
        return $dataTable->render('admin.category.index', [
            'category' => Category::findOrFail($request->category)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
            'categories_tree' => $this->categoriesTree(
                selected: [$category->parent_id]
            )
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $validated['slug'] = \Str::slug($validated['slug']);

        $category->update($validated);

        toastr('Category updated successfully');

        return redirect()->route('admin.category.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        /**
         * All direct children will become root categories
         * (no parent as the current parent will be deleted)
         */
        Category::where('parent_id', $category->id)->update([
            'parent_id' => null
        ]);

        $category->delete();

        if(\request()->ajax()) {
            return response([
                'status' => 'success',
                'message' => 'Item deleted successfully!'
            ]);
        } else {
            toastr('Item deleted successfully!');

            return redirect()->route('admin.category.index');
        }
    }
}
