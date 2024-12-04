<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $seller = Seller::all();
        return view('sellerProfile', compact('seller'));
    }

    public function index_login_personal()
    {
        return view('auth.sellerLogin');
    }

    public function index_register_personal()
    {
        return view('auth.sellerRegister');
    }

    public function register_personal(Request $request)
    {
        $request->validate([
            'floating_email' => 'required|email|unique:sellers,email',
            'floating_storeName' => 'required|unique:sellers,name',
            'floating_password' => 'required|min:8',
            'floating_phone' => 'required|numeric',
            'floating_region' => 'required|string',
        ], [
            'floating_email.unique' => 'The email address has already been taken.',
            'floating_email.required' => 'The email address is required.',
            'floating_email.email' => 'Please enter a valid email address.',

            'floating_storeName.unique' => 'The store name is already taken.',
            'floating_storeName.required' => 'The store name is required.',

            'floating_password.required' => 'The password is required.',
            'floating_password.min' => 'The password must be at least 8 characters.',

            'floating_phone.required' => 'The phone number is required.',
            'floating_phone.numeric' => 'Please enter a valid phone number.',

            'floating_region.required' => 'The region is required.',
        ]);

        Seller::create([
            'email' => $request->floating_email,
            'password' => Hash::make($request->floating_password),  // Hash the password
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

        if ($seller && Hash::check($request->floating_password, $seller->password)) {
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
        if (session('seller')->password != $request->old_password) {
            return redirect()->route('sellerProfile.view')->with('error', 'Old password is incorrect');
        }

        if ($request->new_password != $request->confirm_password) {
            return redirect()->route('sellerProfile.view')->with('error', 'Password confirmation is incorrect');
        }

        $seller = Seller::find(session('seller')->id);
        $seller->password = $request->new_password;
        $seller->save();

        session(['seller' => $seller]);

        return redirect()->route('sellerProfile.view')->with('success', 'Password changed successfully');
    }
}
