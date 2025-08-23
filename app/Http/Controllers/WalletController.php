<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $wallet = $user->wallet; // Assuming you have a wallet relationship on the User model
        // $wallet->load('transactions');

        return view('wallet.index', compact('wallet'));
    }
}
