<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\TransactionHeader;

class AddressController extends Controller
{
    public function set_address(Request $request)
    {
        $address = (object) $request->all();
        $buyer = session('buyer');

        Address::create([
            'buyer_id' => $buyer->id,
            'recipient_name' => $address->name,
            'phone' => $address->phone,
            'street' => $address->street,
            'subdistrict' => $address->subdistrict,
            'city' => $address->city,
            'province' => $address->province,
            'postal_code' => $address->postal,
            'main' => false
        ]);

        Address::where('id', $address->address_id)->update(['main' => false]);
        Address::where('id', Address::latest()->first()->id)->update(['main' => true]);
        TransactionHeader::where('id', $address->id)->update(['address_id' => Address::latest()->first()->id]);

        return redirect()->route('checkout', ['transaction_id' => $address->id]);
    }

    public function change_address(Request $request) {
        $transaction = (object) $request->all();
        $buyer_id = session('buyer')->id;

        Address::where('buyer_id', $buyer_id)->update(['main' => false]);
        Address::where('id', $transaction->main_address)->update(['main' => true]);

        return redirect()->route('checkout', ['transaction_id' => $transaction->id]);
    }
}
