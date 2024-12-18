<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    public function index()
    {
        $buyer = session('buyer');
        return view('profile', compact('buyer'));
    }

    public function shop()
    {
        $searchQuery = request('search');
        $sortOption = request('sort');

        $query = Product::query();

        if ($searchQuery) {
            $query->where('name', 'like', "%{$searchQuery}%");
        }

        switch ($sortOption) {
            case 'alphabetical-ascending':
                $query->orderBy('name', 'asc');
                break;
            case 'alphabetical-descending':
                $query->orderBy('name', 'desc');
                break;
            case 'most-price':
                $query->orderBy('price', 'desc');
                break;
            case 'least-price':
                $query->orderBy('price', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(6)->appends([
            'search' => $searchQuery,
            'sort' => $sortOption,
        ]);

        return view('shop', compact('products', 'searchQuery', 'sortOption'));
    }

    public function register_personal(Request $request)
    {
        session(['buyerRegis' => true]);
        $request->validate([
            'floating_email' => [
                'required',
                'email',
                'unique:buyers,email',
                'regex:/^.+@gmail\.com$/',
            ],
            'floating_password' => 'required|min:8',
            'floating_username' => 'required|min:4',
            'floating_phone' => 'required|regex:/^[0-9]{8,15}$/',
        ], [
            'floating_email.unique' => __('lang.email_unique'),
            'floating_email.required' => __('lang.email_required'),
            'floating_email.email' => __('lang.email_email'),
            'floating_email.regex' => __('lang.email_regex'),

            'floating_password.required' => __('lang.password_required'),
            'floating_password.min' => __('lang.password_min'),
            'floating_username.required' => __('lang.username_required'),
            'floating_username.min' => __('lang.username_min'),
            'floating_phone.required' => __('lang.phone_required'),
            'floating_phone.regex' => __('lang.phone_regex'),
        ]);

        $user = User::create([
            'role' => 'buyer',
        ]);
        echo '<script>console.log("' . $user->id . '"); </script>';

        Buyer::create([
            'user_id' => $user->id,
            'email' => $request->floating_email,
            'password' => Hash::make($request->floating_password),
            'name' => $request->floating_username,
            'phone' => $request->floating_phone,
            'greenPoint' => '0',
            'role' => 'Buyer',
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

        $buyer = Buyer::with('address')->where('email', $request->floating_email)->first();

        if ($buyer && Hash::check($request->floating_password, $buyer->password)) {
            session(['buyer' => $buyer]);

            $user = User::where('id', $buyer->user_id)->first();

            Auth::login($user);

            $request->session()->regenerate();

            return redirect()->route('home.view')->with('success', 'Login successful');
        }


        return redirect()->route('login.view')->with(['error' => 'Invalid email or password', 'buyerLogin' => true]);
    }

    public function logout_personal()
    {
        session()->forget('buyer');

        Auth::logout();

        return redirect()->route('home.view')->with('success', 'Logout successful');
    }

    public function change_password(Request $request)
    {
        if (!Hash::check($request->old_password, session('buyer')->password)) {
            return redirect()->route('profile')->with('changePasswordError', 'Old password is incorrect');
        }

        $request->validate([
            'new_password' => 'required|min:8',
        ], [
            'new_password.required' => __('lang.password_required'),
            'new_password.min' => __('lang.password_min'),
        ]);
        $buyer = Buyer::find(session('buyer')->id);
        $buyer->password = Hash::make($request->new_password);
        $buyer->save();

        session(['buyer' => $buyer]);

        return redirect()->route('profile')->with('changePasswordSuccess', 'Password changed successfully');
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
        $request->validate([
            'username' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9]{8,15}$/',
        ], [
            'username.required' => __('lang.username_required'),
            'username.min' => __('lang.username_min'),
            'email.required' => __('lang.email_required'),
            'email.email' => __('lang.email_email'),
            'phone.required' => __('lang.phone_required'),
            'phone.regex' => __('lang.phone_regex')
        ]);

        $buyer = Buyer::find($id);
        $buyer->email = $request->email;
        $buyer->name = $request->username;
        $buyer->phone = $request->phone;
        $buyer->save();

        session(['buyer' => $buyer]);

        return redirect()->route('profile')->with('updateSuccess', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
