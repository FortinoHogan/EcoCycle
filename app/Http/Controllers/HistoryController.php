<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        // $transaction = TransactionHeader::with(['details.product', 'address'])
        //     ->where('status', 'paid')
        //     ->where('buyer_id', session('buyer')->id)
        //     ->get();

        $transaction = TransactionHeader::with('details.product.seller')->where('buyer_id', session('buyer')->id)->orderBy('created_at', 'desc')->get();

        // dd($transaction);

        return view('history', ['transaction' => $transaction]);
    }
}