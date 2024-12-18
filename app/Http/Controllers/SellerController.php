<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        $seller = Seller::all();
        return view('sellerProfile', compact('seller'));
    }

    public function register_personal(Request $request)
    {
        session(['sellerRegis' => true]);
        $request->validate([
            'floating_email' => [
                'required',
                'email',
                'unique:sellers,email',
                'regex:/^.+@gmail\.com$/',
            ],
            'floating_storeName' => 'required|unique:sellers,name',
            'floating_password' => 'required|min:8',
            'floating_phone' => 'required|regex:/^[0-9]{8,15}$/',
            'floating_region' => 'required|string',
        ], [
            'floating_email.unique' => 'The email address has already been taken.',
            'floating_email.required' => 'The email address is required.',
            'floating_email.email' => 'Please enter a valid email address.',

            'floating_password.required' => 'The password is required.',
            'floating_password.min' => 'The password must be at least 8 characters.',

            'floating_storeName.unique' => 'The store name is already taken.',
            'floating_storeName.required' => 'The store name is required.',

            'floating_phone.required' => 'Phone number is required.',
            'floating_phone.regex' => 'Phone number must be between 8 and 15 digits.',

            'floating_region.required' => 'The region is required.',
            'floating_region.string' => 'Please enter a valid region.',
        ]);

        $user = User::create([
            'role' => 'seller',
        ]);

        Seller::create([
            'user_id' => $user->id,
            'email' => $request->floating_email,
            'password' => Hash::make($request->floating_password),
            'name' => $request->floating_storeName,
            'phone' => $request->floating_phone,
            'region' => $request->floating_region,
            'role' => 'Seller',
            'balance' => '0',
            'profileImage' => null,
        ]);

        return redirect()->route('login.view')->with('success', 'Registration successful');

    }

    public function login_personal(Request $request)
    {
        $request->validate([
            'floating_email' => [
                'required',
                'email',
                'regex:/^.+@gmail\.com$/',
            ],
            'floating_password' => 'required',
        ]);

        $seller = Seller::where('email', "LIKE", $request->floating_email)->first();

        if ($seller && Hash::check($request->floating_password, $seller->password)) {
            session(['seller' => $seller]);
            
            $user = User::where('id', $seller->user_id)->first();

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('home.view')->with('success', 'Login successful');
        }

        return redirect()->route('login.view')->with(['error' => 'Invalid email or password', 'sellerLogin' => true]);
    }

    public function logout_personal()
    {
        session()->forget('seller');

        Auth::logout();

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
