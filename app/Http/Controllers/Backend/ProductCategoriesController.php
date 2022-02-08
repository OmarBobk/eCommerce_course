<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function index()
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['manage_product_categories', 'show_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        $categories = ProductCategory::withCount('products')
            ->when(\request()->keyword != null, function ($q) {
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($q) {
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.products_categories.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function create()
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        $main_categories = ProductCategory::whereNull('parent_id')
            ->get(['id', 'name']);

        return view('backend.products_categories.create', [
            'main_categories' => $main_categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(ProductCategoryRequest $request): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ];

        if ($image = $request->file('cover')) {
            $file_name = Str::slug($data['name']) . "." . $image->getClientOriginalExtension();
            $path = public_path('/assets/product_categories/' . $file_name);

            Image::make($image->getRealPath())->resize(500, null, function ($const) {
                $const->aspectRatio();
            })->save($path, 100);

            $data['cover'] = $file_name;
        }

        ProductCategory::create($data);

        return redirect()->route('admin.product_categories.index')
            ->with([
                'msg' => 'Created Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param ProductCategory $productCategory
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(ProductCategory $productCategory)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['display_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        return view('backend.products_categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCategory $productCategory
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(ProductCategory $productCategory)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        $main_categories = ProductCategory::whereNull('parent_id')
            ->get(['id', 'name']);

        return view('backend.products_categories.edit', [
            'main_categories' => $main_categories,
            'productCategory' => $productCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductCategoryRequest $request
     * @param ProductCategory $productCategory
     * @return RedirectResponse
     */
    public function update(
        ProductCategoryRequest $request,
        ProductCategory        $productCategory
    ): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }
        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ];

        if ($image = $request->file('cover')) {

            if ($productCategory->cover != null &&
                File::exists('assets/product_categories/' . $productCategory->cover)) {
                unlink('assets/product_categories/' . $productCategory->cover);
            }

            $file_name = Str::slug($data['name']) . "." . $image->getClientOriginalExtension();
            $path = public_path('/assets/product_categories/' . $file_name);

            Image::make($image->getRealPath())->resize(500, null, function ($const) {
                $const->aspectRatio();
            })->save($path, 100);

            $data['cover'] = $file_name;
        }

        $productCategory->update($data);

        return redirect()->route('admin.product_categories.index')
            ->with([
                'msg' => 'Updated Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCategory $productCategory
     * @return RedirectResponse
     */
    public function destroy(ProductCategory $productCategory): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['delete_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        if (File::exists('assets/product_categories/' . $productCategory->cover)) {
            unlink('assets/product_categories/' . $productCategory->cover);
        }

        $productCategory->delete();

        return redirect()->route('admin.product_categories.index')
            ->with([
                'msg' => 'Deleted Successfully',
                'alert-type' => 'danger',
            ]);
    }

    public function remove_image(Request $request)
    {

        $not_allowed = auth()->user()
            ->ability('admin',
                ['delete_product_categories'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
            ->with([
                'msg' => 'You Are Not Allowed To Go There',
                'alert-type' => 'danger',
            ]);
        }

        $category = ProductCategory::findOrFail($request->product_category_id);

        if (File::exists('assets/product_categories/' . $category->cover)) {
            unlink('assets/product_categories/' . $category->cover);
            $category->update(['cover' => null]);
        }

        return true;
    }
}
