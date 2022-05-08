<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductCouponRequest;
use App\Models\ProductCoupon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProductCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['manage_product_coupons', 'show_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $coupons = ProductCoupon::query()
            ->when(\request()->keyword != null, function ($q) {
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != null, function ($q) {
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);

        return view('backend.products_coupons.index', [
            'coupons' => $coupons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        return view('backend.products_coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCouponRequest $request
     * @return RedirectResponse
     */
    public function store(ProductCouponRequest $request): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['create_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        ProductCoupon::create($request->validated());

        return redirect()->route('admin.product_coupons.index')
            ->with([
                'msg' => 'Created Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param ProductCoupon $productCoupon
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(ProductCoupon $productCoupon)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['display_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        return view('backend.products_coupons.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCoupon $productCoupon
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(ProductCoupon $productCoupon)
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }


        return view('backend.products_coupons.edit', [
            'productCoupon' => $productCoupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductCouponRequest $request
     * @param ProductCoupon $productCoupon
     * @return RedirectResponse
     */
    public function update(
        ProductCouponRequest $request,
        ProductCoupon        $productCoupon
    ): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['update_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $productCoupon->update($request->validated());

        return redirect()->route('admin.product_coupons.index')
            ->with([
                'msg' => 'Updated Successfully',
                'alert-type' => 'success',
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCoupon $productCoupon
     * @return RedirectResponse
     */
    public function destroy(ProductCoupon $productCoupon): RedirectResponse
    {
        $not_allowed = auth()->user()
            ->ability('admin',
                ['delete_product_coupons'],
                ['validate_all' => false]);
        if(!$not_allowed) {
            return redirect()->route('admin.index')
                ->with([
                    'msg' => 'You Are Not Allowed To Go There',
                    'alert-type' => 'danger',
                ]);
        }

        $productCoupon->delete();

        return redirect()->route('admin.product_coupons.index')
            ->with([
                'msg' => 'Deleted Successfully',
                'alert-type' => 'danger',
            ]);
    }

}
