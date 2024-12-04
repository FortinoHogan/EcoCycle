<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    public function index()
    {
        $buyer = session('buyer');
        return view('profile', compact('buyer'));
    }

    public function shop() {
        $product = Product::with(['description'])->get();

        return view('shop', compact('product'));
    }

    public function index_login_personal()
    {
        return view('auth.buyerLogin');
    }

    public function index_register_personal()
    {
        return view('auth.buyerRegister');
    }

    public function register_personal(Request $request)
    {
        $request->validate([
            'floating_email' => 'required|email|unique:buyers,email',
            'floating_password' => 'required|min:8',
            'floating_username' => 'required|min:4',
            'floating_phone' => 'required|regex:/^[0-9]{8,15}$/',
        ], [
            'floating_email.required' => 'The email address is required.',
            'floating_email.email' => 'Please enter a valid email address.',
            'floating_email.unique' => 'This email is already registered. Please choose another one.',
            'floating_password.required' => 'Password is required.',
            'floating_password.min' => 'Password must be at least 8 characters.',
            'floating_username.required' => 'Username is required.',
            'floating_username.min' => 'Username must be at least 4 characters.',
            'floating_phone.required' => 'Phone number is required.',
            'floating_phone.regex' => 'Phone number must be between 8 and 15 digits.',
        ]);

        Buyer::create([
            'email' => $request->floating_email,
            'password' => Hash::make($request->floating_password),
            'name' => $request->floating_username,
            'phone' => $request->floating_phone,
            'greenPoint' => '0',
            'role' => 'Buyer',
            'profileImage' => null,
        ]);

        return redirect()->route('buyerLogin.view')->with('success', 'Registration successful');

    }

    public function login_personal(Request $request)
    {
        $request->validate([
            'floating_email' => 'required|email',
            'floating_password' => 'required',
        ]);

        $buyer = Buyer::with('address')->where('email', $request->floating_email)->first();

        if ($buyer && Hash::check($request->floating_password, $buyer->password)) {
            session(['buyer' => $buyer]);
            return redirect()->route('home.view')->with('success', 'Login successful');
        }


        return redirect()->route('buyerLogin.view')->withErrors([
            'login' => 'Invalid email or password. Please try again.'
        ]);
    }

    public function logout_personal()
    {
        session()->forget('buyer');

        return redirect()->route('home.view')->with('success', 'Logout successful');
    }

    public function change_password(Request $request)
    {
        if (session('buyer')->password != $request->old_password) {
            return redirect()->route('buyerProfile.view')->with('error', 'Old password is incorrect');
        }

        if ($request->new_password != $request->confirm_password) {
            return redirect()->route('buyerProfile.view')->with('error', 'Password confirmation is incorrect');
        }

        $buyer = Buyer::find(session('buyer')->id);
        $buyer->password = $request->new_password;
        $buyer->save();

        session(['buyer' => $buyer]);

        return redirect()->route('buyerProfile.view')->with('success', 'Password changed successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
