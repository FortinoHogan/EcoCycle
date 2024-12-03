<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;

class ProfileController extends Controller
{
    //
    public function index(){
        $buyer = Buyer::all();
        return view('profile', compact('buyer'));
    }
}
