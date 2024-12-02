@extends('layout.authMaster')

@section('konten')
    <div class="flex items-center justify-center mt-20 ">
        <div class="flex flex-col justify-center max-w-lg border bg-[#3C552D] border-[#3C552D] p-10 rounded-md">

            <div class="flex flex-col gap-2">
                <span class="text-4xl font-medium text-white">SELLER account</span>
                <span class="text-2xl font-poppins font-medium text-white">Login with seller account</span>
            </div>

            <!-- Show error message if any -->
            @if (session('error'))
                <div class="text-red-500 text-xs mt-2 mb-2">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login_seller.post') }}" class="pt-4" method="POST">
                @csrf
                @method('POST')

                <!-- Email input field -->
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="floating_email" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder=" " required value="{{ old('floating_email') }}" />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-accent duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                        address</label>

                    <!-- Show email validation error -->
                    @error('floating_email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password input field -->
                <div class="relative z-0 w-full mb-5 group mt-5">
                    <input type="password" name="floating_password" id="floating_password"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder=" " required />
                    <label for="floating_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>

                    <!-- Show password validation error -->
                    @error('floating_password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit button -->
                <div class="flex justify-center mt-16">
                    <button type="submit"
                        class="w-full text-[#3C552D] bg-white font-medium py-2 rounded-md hover:text-[#3C552D] hover:bg-gray-400 transition-all duration-500">Log
                        In</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex flex-col items-center pt-6 mb-20">
        <a href="{{ route('buyerLogin.view') }}"
            class="text-xl text-[#EB5B00] font-semibold mb-4 hover:text-gray-400 transition-all duration-500">Login to your
            personal Buyer account</a>
        <span class="text-[#3C552D] text-lg font-medium">Doesn't have an account? <a
                href="{{ route('sellerRegister.view') }}" class="hover:text-gray-400 transition-all duration-500">Create a
                Seller Account</a></span>
    </div>
@endsection
