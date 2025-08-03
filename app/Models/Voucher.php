<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $guarded = ['id'];

    //isRedeemed
    public function isRedeemed(): bool
    {
        return $this->redeemed_at !== null;
    }

    public function redeem($user): void
    {
        $user = $user ?? auth()->user();
        $user->wallet->deposit($this->amount, [__('Voucher Redeem') . $this->code]);
        $this->redeemed_at = now();
        $this->save();
    }
}
