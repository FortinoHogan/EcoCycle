@extends('layout.authMaster')

@section('konten')
    <div class="flex items-center justify-center mt-20">
        <div class="flex flex-col justify-center max-w-lg border border-[#3C552D] p-10 rounded-md bg-[#3C552D]">

            <div class="flex flex-col gap-2">
                <span class="text-4xl text-white font-medium ">SELLER account</span>
                <span class="text-2xl text-white font-poppins font-medium ">Sign Up your seller account</span>
            </div>

            <form class="pt-8" method="POST" action="{{ route('register_seller.post') }}">
                @csrf
                @method('POST')
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="floating_email" id="floating_email"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder=" " required />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-accent duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                        address</label>
                </div>
                <div class="relative z-0 w-full mb-5 group mt-5">
                    <input type="password" name="floating_password" id="floating_password"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder=" " required />
                    <label for="floating_password"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                </div>
                <div class="relative z-0 w-full mb-5 group mt-5">
                    <input type="text" name="floating_storeName" id="floating_storeName"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder="" required />
                    <label for="floating_storeName"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-accent duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Store Name</label>
                </div>
                <div class="relative z-0 w-full mb-5 group mt-5">
                    <input type="tel" pattern="[0-9]{8-15}" name="floating_phone" id="floating_phone"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder="" required />
                    <label for="floating_phone"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-accent duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
                        Number [08XXXXXXXXX]</label>
                </div>
                <div class="relative z-0 w-full mb-5 group mt-5">
                    <input type="text" name="floating_region" id="floating_region"
                        class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-accent focus:outline-none focus:ring-0 focus:border-accent peer"
                        placeholder="" required />
                    <label for="floating_region"
                        class="peer-focus:font-medium absolute text-sm text-gray-200 dark:text-accent duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-accent peer-focus:dark:text-accent peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Region</label>
                </div>
                <div class="flex justify-center mt-16">
                    <button type="submit"
                        class="w-full text-[#3C552D] bg-white font-medium py-2 rounded-md hover:text-[#3C552D] hover:bg-gray-400  transition-all duration-500">Register</button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center pt-6 mb-20">
        <a href="{{ route('buyerRegister.view') }}" class=" text-xl text-[#EB5B00] font-semibold mb-4 hover:text-gray-500 transition-all duration-500">Register your
            personal Buyer account</a>
        <span class="text-[#3C552D] text-lg font-medium">Already have an account? <a href="{{ route('sellerLogin.view') }}"
                class="text-secondary hover:text-gray-500 transition-all duration-500">Login Here!</a></span>
    </div>
@endsection
