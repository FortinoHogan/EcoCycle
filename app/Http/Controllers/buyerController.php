<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;

class buyerController extends Controller
{
    public function index()
    {
        $buyer = Buyer::all();
        return view('buyerProfile', compact('buyer'));
    }

    public function index_login_personal(){
        return view('auth.buyerLogin');
    }

    public function index_register_personal(){
        return view('auth.buyerRegister');
    }

    public function register_personal(Request $request){
        Buyer::create([
            'email' => $request->floating_email,
            'password' => $request->floating_password,
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

        $buyer = Buyer::with('address')->where('email', "LIKE", $request->floating_email)->first();

        if ($buyer && $buyer->password == $request->floating_password) {
            session(['buyer' => $buyer]);
            return redirect()->route('home.view')->with('success', 'Login successful');
        }

        return redirect()->route('buyerLogin.view')->with('error', 'Invalid email or password');
    }

    public function logout_personal()
    {
        session()->forget('buyer');

        return redirect()->route('home.view')->with('success', 'Logout successful');
    }

    public function change_password(Request $request)
    {
        if(session('buyer')->password != $request->old_password){
            return redirect()->route('buyerProfile.view')->with('error', 'Old password is incorrect');
        }

        if($request->new_password != $request->confirm_password){
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
