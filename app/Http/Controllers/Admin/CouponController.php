<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.coupons.index')->with([
            'coupons' => Coupon::query()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(Request $request)
    {
        //
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function store(AddCouponRequest $request)
    {
        //
        if ($request->validated()) {
            Coupon::query()->create($request->validated());
            return redirect()->route('admin.coupons.index')->with([
                'success' => 'Coupon has been added Successfully'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
        return view('admin.coupons.edit')->with([
            'coupon' => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        //
        if ($request->validated()) {
            $coupon->update($request->validated());
            return redirect()->route('admin.coupons.index')->with([
                'success' => 'Coupon has been updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with([
            'success' => 'Coupon has been deleted Successfully'
        ]);
    }
}
