<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $ths = TransactionHeader::with('details.product.seller')->where('buyer_id', session('buyer')->id)->orderBy('created_at', 'desc')->get();

        $tids = $ths->pluck('id');

        $tds = TransactionDetail::with('product.seller')
            ->whereIn('transaction_id', $tids)
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->orderBy('sellers.id', 'desc')
            ->select('transaction_details.*')
            ->get();

        return view('history', compact('ths', 'tds'));
    }
}
