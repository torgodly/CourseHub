<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //
    public function redeem()
    {
        $user = auth()->user();

        $data = request()->validate([
            'code' => 'required|string|max:255',
        ]);

        // Assuming you have a Voucher model and a method to redeem it
        $voucher = \App\Models\Voucher::where('code', $data['code'])->first();

        if (!$voucher) {
            return redirect()->back()->withErrors(['code' => __('Voucher code is invalid.')]);
        }

        if ($voucher->is_redeemed) {
            return redirect()->back()->withErrors(['code' => __('Voucher code has already been redeemed.')]);
        }

        // Redeem the voucher
        $voucher->redeem($user);

        return redirect()->route('profile.show')->with('success', __('Voucher redeemed successfully.'));
    }
}
