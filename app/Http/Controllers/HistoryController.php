<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $transaction = TransactionHeader::with('details.product.seller')->where('buyer_id', session('buyer')->id)->orderBy('created_at', 'desc')->get();
        return view('history', compact('transaction'));
    }
}
