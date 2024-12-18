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

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-20px);
                opacity: 0;
            }
        }

        .slide-down {
            animation: slideDown 0.2s ease-out forwards;
        }

        .slide-up {
            animation: slideUp 0.2s ease-in forwards;
        }
    </style>

    <section class="bg-gradient-scrollable fixed w-full h-full overflow-auto">
        <div class="py-4 mx-auto max-w-[340px] w-full">
            <div class="bg-white rounded-md overflow-hidden">
                <header class="border-b">
                    <img src="{{ asset('asset/Logo.png') }}" alt="" class="w-40 mx-auto">
                </header>
                <section class="py-8 px-6">
                    @if (session('error'))
                        <div class="bg-[#d73930] py-3 px-4 text-white mb-3 flex items-center justify-between"
                            id="errorMsg">
                            <span>{{ session('error') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                id="closeError" fill="#e8eaed" class="cursor-pointer">
                                <path
                                    d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                            </svg>
                        </div>
                    @endif

                    <div id="login-buyer-header" class="flex justify-between items-center mb-4 cursor-pointer">
                        <h2 class="font-bold text-2xl text-[#5c5c5c]">@lang("lang.login_buyer")</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                            fill="#5c5c5c" id="buyerDropdownIcon">
                            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                        </svg>
                    </div>

                    <div id="login-buyer-form"
                        class="{{ session('buyerLogin') ? '' : 'hidden' }} transition-transform duration-500 transform">
                        <form action="{{ route('login_buyer.post') }}" class="pt-4" method="POST"
                            onsubmit="showSpinner()">
                            @csrf
                            <div class="mb-6">
                                <label for="floating_email" class="text-[#5c5c5c] mb-1">EMAIL</label>
                                <input id="floating_email" type="email" name="floating_email"
                                    class="w-full border border-black/10 outline-none h-10" required>
                            </div>
                            <div class="mb-6">
                                <label for="passwordBuyer" class="text-[#5c5c5c] mb-1">@lang("lang.password")</label>
                                <div class="relative flex justify-between">
                                    <input id="passwordBuyer" type="password" name="floating_password"
                                        class="w-full border border-black/10 outline-none h-10" required>
                                    <button type="button" onclick="togglePasswordBuyer()"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center">
                                        <i id="eye-icon-buyer" class="fa-solid fa-eye text-gray-500"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-2 bg-[#76b743] text-white h-10">
                                <span class="button__label">@lang("lang.login")</span>
                            </button>
                        </form>
                    </div>
                    <hr class="border-b mt-6">
                </section>

                <section class="pb-8 px-6">
                    <div id="login-seller-header" class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-2xl text-[#5c5c5c]">@lang("lang.login_seller")</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                            fill="#5c5c5c" id="sellerDropdownIcon">
                            <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                        </svg>
                    </div>
                    <div id="login-seller-form"
                        class="{{ session('sellerLogin') ? '' : 'hidden' }} transition-transform duration-500 transform">
                        <form action="{{ route('login_seller.post') }}" class="pt-4" method="POST"
                            onsubmit="showSpinner()">
                            @csrf
                            @method('POST')
                            <div class="mb-6">
                                <label for="" class="text-[#5c5c5c] mb-1">EMAIL</label>
                                <input type="email" name="floating_email"
                                    class="w-full border border-black/10 outline-none h-10" required>
                            </div>
                            <div class="mb-6">
                                <label for="password" class="text-[#5c5c5c] mb-1">@lang("lang.password")</label>
                                <div class="relative flex justify-between">
                                    <input id="passwordSeller" type="password" name="floating_password"
                                        class="w-full border border-black/10 outline-none h-10" required>
                                    <button type="button" onclick="togglePasswordSeller()"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center">
                                        <i id="eye-icon-seller" class="fa-solid fa-eye text-gray-500"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="w-full py-2 bg-[#76b743] text-white h-10">
                                <span class="button__label">@lang("lang.login")</span>
                            </button>
                        </form>
                    </div>
                    <hr class="border-b mt-6">
                </section>
                <footer>
                    <span class="border-t-2 p-3 flex justify-center items-center">
                        <a href="{{ route('register.view') }}" class="text-center text-sm">@lang("lang.register_account")</a>
                    </span>
                    <span class="border-t-2 p-3 flex justify-center items-center">
                        <a href="{{ route('home.view') }}" class="text-center text-sm">@lang("lang.back_home")</a>
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
        document.addEventListener("DOMContentLoaded", function() {
            const buyerHeader = document.getElementById("login-buyer-header");
            const buyerForm = document.getElementById("login-buyer-form");
            const buyerDropdownIcon = document.getElementById("buyerDropdownIcon");
            const sellerHeader = document.getElementById("login-seller-header");
            const sellerForm = document.getElementById("login-seller-form");
            const sellerDropdownIcon = document.getElementById(
                "sellerDropdownIcon");
            const closeError = document.getElementById("closeError");
            const errorMsg = document.getElementById("errorMsg");

            buyerHeader.addEventListener("click", function() {
                if (buyerForm.classList.contains("hidden")) {
                    buyerForm.classList.remove("hidden", "slide-up");
                    buyerForm.classList.add("slide-down");
                    buyerDropdownIcon.style.transform = "rotate(180deg)";
                } else {
                    buyerForm.classList.remove("slide-down");
                    buyerForm.classList.add("slide-up");
                    buyerDropdownIcon.style.transform = "rotate(0deg)";

                    setTimeout(() => {
                        buyerForm.classList.add("hidden");
                    }, 300);
                }
            });

            sellerHeader.addEventListener("click", function() {
                if (sellerForm.classList.contains("hidden")) {
                    sellerForm.classList.remove("hidden", "slide-up");
                    sellerForm.classList.add("slide-down");
                    sellerDropdownIcon.style.transform = "rotate(180deg)";
                } else {
                    sellerForm.classList.remove("slide-down");
                    sellerForm.classList.add("slide-up");
                    sellerDropdownIcon.style.transform = "rotate(0deg)";

                    setTimeout(() => {
                        sellerForm.classList.add("hidden");
                    }, 300);
                }
            });

            if (closeError) {
                closeError.addEventListener("click", function() {
                    errorMsg.style.display = "none";
                });
            }
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
