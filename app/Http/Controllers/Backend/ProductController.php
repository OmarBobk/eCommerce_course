<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductsRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
                ['manage_products', 'show_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $products = Product::with('category', 'tags', 'firstMedia')
            ->when(\request()->keyword != null, function ($q) {
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($q) {
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.products.index', [
            'products' => $products,
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
                ['create_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $categories = ProductCategory::whereStatus(1)->get(['id', 'name']);
        $tags       = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.products.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductsRequest $request
     * @return RedirectResponse
     */
    public function store(ProductsRequest $request)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $data = [
            'name'                => $request->name,
            'slug'                => Str::slug($request->name),
            'description'         => $request->description,
            'price'               => $request->price,
            'quantity'            => $request->quantity,
            'featured'            => $request->featured,
            'status'              => $request->status,
            'product_category_id' => $request->product_category_id,
        ];

        $product = Product::create($data);

        // Create new records in the taggable table.
        $product->tags()->attach($request->tags);

        // Create Image
        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $img) {
                $file_name = $product->slug.'_'.time().'_'.$i.'.'.$img->getClientOriginalExtension();
                $file_size = $img->getSize();
                $file_type = $img->getMimeType();
                $path = public_path('assets/products/'.$file_name);

                Image::make($img->getRealPath())->resize(500, null, function ($c) {
                    $c->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name'     => $file_name,
                    'file_size'     => $file_size,
                    'file_type'     => $file_type,
                    'file_status'   => true,
                    'file_sort'     => $i,
                ]);
                $i++;
            }
        }

        return redirect()->route('admin.products.index')
            ->with([
                'msg' => 'Created Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('backend.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(Product $product)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $categories = ProductCategory::whereStatus(1)->get(['id', 'name']);
        $tags       = Tag::whereStatus(1)->get(['id', 'name']);

        return view('backend.products.edit', [
            'categories' => $categories,
            'tags' => $tags,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductsRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductsRequest $request, Product $product)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $data = [
            'name'                => $request->name,
            'slug'                => Str::slug($request->name),
            'description'         => $request->description,
            'price'               => $request->price,
            'quantity'            => $request->quantity,
            'featured'            => $request->featured,
            'status'              => $request->status,
            'product_category_id' => $request->product_category_id,
        ];

        $product->update($data);
        $product->tags()->sync($request->tags);

        // Create Image
        if ($request->images && count($request->images) > 0) {
            $i = $product->media()->count() + 1;

            foreach ($request->images as $img) {
                $file_name = $product->slug.'_'.time().'_'.$i.'.'.$img->getClientOriginalExtension();
                $file_size = $img->getSize();
                $file_type = $img->getMimeType();
                $path = public_path('assets/products/'.$file_name);

                Image::make($img->getRealPath())->resize(500, null, function ($c) {
                    $c->aspectRatio();
                })->save($path, 100);

                $product->media()->create([
                    'file_name'     => $file_name,
                    'file_size'     => $file_size,
                    'file_type'     => $file_type,
                    'file_status'   => true,
                    'file_sort'     => $i,
                ]);
                $i++;
            }
        }

        return redirect()->route('admin.products.index')
            ->with([
                'msg' => 'Updated Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['delete_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $medias = $product->media();

        if ($medias->count() > 0) {
            foreach ($medias as $media) {
                if (File::exists('assets/products/'.$media->file_name)) {
                    unlink('assets/products/'.$media->file_name);
                }
                $media->delete();
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with([
                'msg' => 'Deleted Successfully',
                'alert-type' => 'danger',
            ]);
    }

    public function remove_image(Request $request)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['delete_products'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $product = Product::findOrFail($request->product_id);
        $img     = $product->media()->whereId($request->image_id)->first();

        if (File::exists('assets/products/'.$img->file_name)) {
            unlink('assets/products/'.$img->file_name);
        }

        $img->delete();

        return true;

    }
}
