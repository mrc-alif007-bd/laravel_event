<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    // List all coupons
    public function index()
    {
        $coupons = Coupon::all();
        return view('backend.admin.coupons.index', compact('coupons'));
    }

    // Create coupon form
    public function create()
    {
        return view('backend.admin.coupons.create');
    }

    // Store new coupon
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:coupons,code|max:20',
            'discount_type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:1',
            'expires_at' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        Coupon::create($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon created successfully');
    }

    // Edit coupon form
    public function edit(Coupon $coupon)
    {
        return view('backend.admin.coupons.edit', compact('coupon'));
    }

    // Update coupon
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id . '|max:20',
            'discount_type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:1',
            'expires_at' => 'nullable|date',
            'usage_limit' => 'nullable|integer|min:1',
        ]);

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon updated successfully');
    }

    // Delete coupon
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')
            ->with('success', 'Coupon deleted successfully');
    }
}
