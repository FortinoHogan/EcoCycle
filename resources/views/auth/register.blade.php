@extends('layout.authMaster')

@section('konten')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        .bg-gradient-scrollable {
            background: #76b743;
            background: -webkit-linear-gradient(135deg, #1b9ad7, #76b743);
            background: linear-gradient(135deg, #1b9ad7, #76b743);
        }

        input:focus {
            outline: none;
        }
    </style>

    <section class="bg-gradient-scrollable fixed w-full h-full overflow-auto">
        <div class="py-4 mx-auto max-w-[340px] w-full">
            <div class="bg-white rounded-md overflow-hidden">
                <header class="border-b">
                    <img src="{{ asset('asset/Logo.png') }}" alt="" class="w-40 mx-auto">
                </header>
                <section class="py-8 px-6">
                    @if ($errors->any())
                        <div class="bg-[#d73930] py-3 px-4 text-white mb-3 flex items-center justify-between"
                            id="errorMsg">
                            <span>{{ $errors->first() }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                id="close" fill="#e8eaed">
                                <path
                                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg>
                        </div>
                    @endif
                    <div id="register-buyer-header" class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-2xl text-[#5c5c5c]">Register as Buyer</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                            fill="#5c5c5c">
                            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                        </svg>
                    </div>
                    <div id="register-buyer-form" class="{{ session('buyerRegis') ? '' : 'hidden' }} transition-transform duration-500 transform">
                        <form action="{{ route('register_buyer.post') }}" class="pt-4" method="POST"
                            onsubmit="showSpinner()">
                            @csrf
                            @method('POST')
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">EMAIL</label>
                                <input type="email" name="floating_email"
                                    class="w-full border border-black/10 outline-none h-10" required value="{{ old('floating_email') }}">
                            </div>
                            <div class="mb-6">
                                <label for="password" class="text-[#5c5c5c] mb-1">PASSWORD</label>
                                <div class="relative flex justify-between">
                                    <input id="passwordBuyer" type="password" name="floating_password"
                                        class="w-full border border-black/10 outline-none h-10" required>
                                    <button type="button" onclick="togglePasswordBuyer()"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center">
                                        <i id="eye-icon-buyer" class="fa-solid fa-eye text-gray-500"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">USERNAME</label>
                                <input type="text" name="floating_username"
                                    class="w-full border border-black/10 outline-none h-10" required value="{{ old('floating_username') }}">
                            </div>
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">PHONE NUMBER</label>
                                <input type="tel" name="floating_phone"
                                    class="w-full border border-black/10 outline-none h-10" required
                                    placeholder="[08XXXXXXXXX]" value="{{ old('floating_phone') }}">
                            </div>
                            <button type="submit" class="w-full py-2 bg-[#76b743] text-white h-10">
                                <span class="button__label">SIGN UP</span>
                            </button>
                        </form>
                    </div>
                    <hr class="border-b mt-6">
                </section>
                <section class="pb-8 px-6">
                    <div id="register-seller-header" class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-2xl text-[#5c5c5c]">Register as Seller</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                            fill="#5c5c5c">
                            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                        </svg>
                    </div>
                    <div id="register-seller-form" class="{{ session('sellerRegis') ? '' : 'hidden' }} transition-transform duration-500 transform">
                        <form action="{{ route('register_seller.post') }}" class="pt-4" method="POST"
                            onsubmit="showSpinner()">
                            @csrf
                            @method('POST')
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">EMAIL</label>
                                <input type="email" name="floating_email"
                                    class="w-full border border-black/10 outline-none h-10" required value="{{ old('floating_email') }}">
                            </div>
                            <div class="mb-6">
                                <label for="password" class="text-[#5c5c5c] mb-1">PASSWORD</label>
                                <div class="relative flex justify-between">
                                    <input id="passwordSeller" type="password" name="floating_password"
                                        class="w-full border border-black/10 outline-none h-10" required>
                                    <button type="button" onclick="togglePasswordSeller()"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center">
                                        <i id="eye-icon-seller" class="fa-solid fa-eye text-gray-500"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">STORE NAME</label>
                                <input type="text" name="floating_storeName"
                                    class="w-full border border-black/10 outline-none h-10" required value="{{ old('floating_storeName') }}">
                            </div>
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">PHONE NUMBER</label>
                                <input type="tel" name="floating_phone"
                                    class="w-full border border-black/10 outline-none h-10" required
                                    placeholder="[08XXXXXXXXX]" value="{{ old('floating_phone') }}">
                            </div>
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">REGION</label>
                                <input type="text" name="floating_region"
                                    class="w-full border border-black/10 outline-none h-10" required value="{{ old('floating_region') }}">
                            </div>
                            <button type="submit" class="w-full py-2 bg-[#76b743] text-white h-10">
                                <span class="button__label">SIGN UP</span>
                            </button>
                        </form>
                    </div>
                    <hr class="border-b mt-6">
                </section>
                <footer>
                    <span class="border-t-2 p-3 flex justify-center items-center">
                        <a href="{{ route('login.view') }}" class="text-center text-sm">LOGIN TO YOUR ACCOUNT</a>
                    </span>
                    <span class="border-t-2 p-3 flex justify-center items-center">
                        <a href="{{ route('home.view') }}" class="text-center text-sm">BACK TO HOME</a>
                    </span>
                </footer>
            </div>
        </div>
    </section>
    <div id="spinner"
        class="bg-[rgb(189,236,211)] opacity-70 hidden fixed min-h-[100%] w-[100%] z-[99] justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
            <rect width="2.8" height="12" x="1" y="6" fill="currentColor">
                <animate id="svgSpinnersBarsScale0" attributeName="y" begin="0;svgSpinnersBarsScale1.end-0.1s"
                    calcMode="spline" dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="0;svgSpinnersBarsScale1.end-0.1s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="5.8" y="6" fill="currentColor">
                <animate attributeName="y" begin="svgSpinnersBarsScale0.begin+0.1s" calcMode="spline" dur="0.6s"
                    keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.1s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="10.6" y="6" fill="currentColor">
                <animate attributeName="y" begin="svgSpinnersBarsScale0.begin+0.2s" calcMode="spline" dur="0.6s"
                    keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.2s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="15.4" y="6" fill="currentColor">
                <animate attributeName="y" begin="svgSpinnersBarsScale0.begin+0.3s" calcMode="spline" dur="0.6s"
                    keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.3s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="20.2" y="6" fill="currentColor">
                <animate id="svgSpinnersBarsScale1" attributeName="y" begin="svgSpinnersBarsScale0.begin+0.4s"
                    calcMode="spline" dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.4s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
        </svg>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById("register-buyer-header").addEventListener("click", function() {
            const form = document.getElementById("register-buyer-form");
            if (form.classList.contains("hidden")) {
                form.classList.remove("hidden");
                form.style.transform = "translateY(-15%)";
                setTimeout(() => {
                    form.style.transform = "translateY(0)";
                }, 10);
            } else {
                form.style.transform = "translateY(-15%)";
                setTimeout(() => {
                    form.classList.add("hidden");
                    form.style.transform = "translateY(0)";
                }, 200);
            }
        });

        document.getElementById("register-seller-header").addEventListener("click", function() {
            const form = document.getElementById("register-seller-form");
            if (form.classList.contains("hidden")) {
                form.classList.remove("hidden");
                form.style.transform = "translateY(-15%)";
                setTimeout(() => {
                    form.style.transform = "translateY(0)";
                }, 10);
            } else {
                form.style.transform = "translateY(-15%)";
                setTimeout(() => {
                    form.classList.add("hidden");
                    form.style.transform = "translateY(0)";
                }, 200);
            }
        });

        document.getElementById("close").addEventListener("click", function() {
            const error = document.getElementById("errorMsg");
            error.classList.add("hidden");
        });

        function togglePasswordBuyer() {
            const passwordField = document.getElementById("passwordBuyer");
            const eyeIcon = document.getElementById("eye-icon-buyer");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        function togglePasswordSeller() {
            const passwordField = document.getElementById("passwordSeller");
            const eyeIcon = document.getElementById("eye-icon-seller");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        function showSpinner() {
            document.getElementById("spinner").classList.remove("hidden");
            document.getElementById("spinner").classList.add("flex");
        }
    </script>
@endsection
