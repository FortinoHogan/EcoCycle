<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class sellerController extends Controller
{
    public function index()
    {
        $seller = Seller::all();
        return view('sellerProfile', compact('seller'));
    }

    public function index_login_personal(){
        return view('auth.sellerLogin');
    }

    public function index_register_personal(){
        return view('auth.sellerRegister');
    }

    public function register_personal(Request $request){
        Seller::create([
            'email' => $request->floating_email,
            'password' => $request->floating_password,
            'name' => $request->floating_storeName,
            'phone' => $request->floating_phone,
            'region' => $request->floating_region,
            'role' => 'Seller',
            'balance' => '0',
            'profileImage' => null,
        ]);

        return redirect()->route('sellerLogin.view')->with('success', 'Registration successful');

    }

    public function login_personal(Request $request)
    {
        $request->validate([
            'floating_email' => 'required|email',
            'floating_password' => 'required',
        ]);

        $seller = Seller::where('email', "LIKE", $request->floating_email)->first();

        if ($seller && $seller->password == $request->floating_password) {
            session(['seller' => $seller]);
            return redirect()->route('home.view')->with('success', 'Login successful');
        }

        return redirect()->route('sellerLogin.view')->with('error', 'Invalid email or password');
    }

    public function logout_personal()
    {
        session()->forget('seller');

        return redirect()->route('home.view')->with('success', 'Logout successful');
    }

    public function change_password(Request $request)
    {
        if(session('seller')->password != $request->old_password){
            return redirect()->route('sellerProfile.view')->with('error', 'Old password is incorrect');
        }

        if($request->new_password != $request->confirm_password){
            return redirect()->route('sellerProfile.view')->with('error', 'Password confirmation is incorrect');
        }

        $seller = Seller::find(session('seller')->id);
        $seller->password = $request->new_password;
        $seller->save();

        session(['seller' => $seller]);

        return redirect()->route('sellerProfile.view')->with('success', 'Password changed successfully');
    }
}
