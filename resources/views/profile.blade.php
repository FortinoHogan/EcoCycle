@extends('layout.master')

@section('konten')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-transition {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>

    <div class="mx-40 mt-14 mb-32 pb-10 bg-white rounded-lg shadow-md page-transition">
        <div class="flex justify-between items-center px-10 py-4 border-b border-[#3C552D]">
            <h1 class="text-xl font-bold text-[#3C552D]">Hi, {{ $buyer->name }}</h1>
        </div>

        <div class="p-10">
            <div class="flex flex-col items-center">
                <!-- Avatar Section -->
                <div class="relative group">
                    <!-- Profile Picture -->
                    <img class="w-24 h-24 rounded-full border" src="{{ asset('asset/profile.webp') }}" alt="profile" />
                    <!-- Hover Effect -->
                    <label
                        class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <span class="text-sm text-white text-center">Upload a photo</span>
                        <input type="file" class="hidden" />
                    </label>
                </div>

                <!-- User Info -->
                <h2 class="mt-4 text-lg font-bold">{{ $buyer->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">{{ $buyer->email }} -
                    @if ($buyer->greenPoint >= 0 && $buyer->greenPoint <= 25)
                        EcoNewbie
                    @elseif($buyer->greenPoint >= 26 && $buyer->greenPoint <= 50)
                        EcoAlly
                    @elseif($buyer->greenPoint >= 51 && $buyer->greenPoint <= 75)
                        EcoWarrior
                    @elseif($buyer->greenPoint >= 76 && $buyer->greenPoint <= 100)
                        EcoGuardian
                    @endif
                </p>
                {{-- Loyalty Point --}}
                <p class="text-sm text-gray-500 mt-1">Your current point : {{ $buyer->greenPoint }}</p>
                <!-- Loyalty Program Progress Bar -->
                <div class="w-full mt-4">
                    <h3 class="text-sm font-medium text-gray-700">Loyalty Program</h3>
                    <div class="w-full bg-gray-200 rounded-full h-4 mt-2 shadow-sm">
                        <div class="bg-[#749d5c] h-4 rounded-full" id="progress-bar" style="width: 0%;"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>EcoNewbie </span>
                        <span>EcoAlly</span>
                        <span>EcoWarrior</span>
                        <span>EcoGuardian</span>
                    </div>
                </div>
            </div>

            <!-- Account Section -->
            <form class="mt-6 space-y-4" action="{{ route('profile.update', $buyer->id) }}" method="POST"
                onsubmit="showSpinner()">
                @csrf
                @if ($errors->has('email') || $errors->has('username') || $errors->has('phone'))
                    <div class="bg-[#d73930] py-3 px-4 text-white mb-3 flex items-center justify-between" id="errorMsg">
                        <span>{{ $errors->first() }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            id="closeError" fill="#e8eaed" class="cursor-pointer"
                            onclick="document.getElementById('errorMsg').remove()">
                            <path
                                d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg>
                    </div>
                @endif
                <!-- Name -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <input id="username" name="username" type="text" value="{{ $buyer->name }}"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email <span class="text-red-500"></span>
                    </label>
                    <input id="email" name="email" type="email" value="{{ $buyer->email }}"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />
                </div>

                {{-- Phone num --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Phone number <span class="text-red-500"></span>
                    </label>
                    <input id="phone" name="phone" type="text" value="{{ $buyer->phone }}"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />
                </div>

                <!-- Password -->
                {{-- <button type="button" onclick="toggleModal(true)"
                    class="block text-sm font-medium text-gray-700 hover:text-blue-500 hover:underline">Change
                    Password</button> --}}

                <div class="flex justify-center items-center">
                    <button
                        class="px-8 py-1 mt-8 text-center rounded-full text-[#3C552D] bg-white border-2 border-[#3C552D] shadow-lg hover:bg-[#2a4120] hover:text-white transition-all duration-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="modalWrapper"
        style="{{ session('changePasswordError') || $errors->has('new_password') ? 'display: flex;' : 'display: none;' }}"
        class="bg-black bg-opacity-40 fixed inset-0 z-50 items-center justify-center" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg max-w-[640px] w-[90%] p-8 h-fit overflow-y-auto scrollbar-hidden"
            onclick="stopPropagation(event)">
            <h2 class="font-bold text-xl text-[#5c5c5c] text-center p-8">Change Password</h2>
            @if (session('changePasswordError'))
                <div class="bg-[#d73930] py-3 px-4 text-white mb-3 flex items-center justify-between" id="errorMsg">
                    <span>{{ session('changePasswordError') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        id="closeError" fill="#e8eaed" class="cursor-pointer"
                        onclick="document.getElementById('errorMsg').remove()">
                        <path
                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg>
                </div>
            @endif
            @if ($errors->has('new_password'))
                <div class="bg-[#d73930] py-3 px-4 text-white mb-3 flex items-center justify-between" id="errorMsg">
                    <span>{{ $errors->first('new_password') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        id="closeError" fill="#e8eaed" class="cursor-pointer">
                        <path
                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg>
                </div>
            @endif
            <form action="{{ route('change-password') }}" method="POST" enctype="multipart/form-data"
                onsubmit="showSpinner()">
                @csrf
                <div class="mb-6">
                    <label for="oldPassword" class="text-[#5c5c5c] mb-1">OLD PASSWORD</label>
                    <div class="relative flex justify-between">
                        <input id="oldPassword" type="password" name="old_password"
                            class="w-full border border-black/10 outline-none h-10" required>
                        <button type="button" onclick="toggleOldPassword()"
                            class="absolute inset-y-0 right-0 px-3 flex items-center">
                            <i id="eye-icon-old" class="fa-solid fa-eye text-gray-500"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="newPassword" class="text-[#5c5c5c] mb-1">NEW PASSWORD</label>
                    <div class="relative flex justify-between">
                        <input id="newPassword" type="password" name="new_password"
                            class="w-full border border-black/10 outline-none h-10" required>
                        <button type="button" onclick="toggleNewPassword()"
                            class="absolute inset-y-0 right-0 px-3 flex items-center">
                            <i id="eye-icon-new" class="fa-solid fa-eye text-gray-500"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-center gap-5">
                    <button type="button"
                        class="hover:opacity-80 py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500 bg-gray-500"
                        onclick="closeModal()">CANCEL</button>
                    <button
                        class="hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500">SAVE
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="spinner"
        class="bg-[rgb(189,236,211)] opacity-70 hidden top-0 fixed min-h-[100%] w-[100%] z-[99] justify-center items-center">
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
        function toggleModal(isVisible) {
            const modal = document.getElementById('modalWrapper');
            if (isVisible) {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }

        function closeModal() {
            toggleModal(false);
        }

        function stopPropagation(event) {
            event.stopPropagation();
        }

        function showSpinner() {
            document.getElementById("spinner").classList.remove("hidden");
            document.getElementById("spinner").classList.add("flex");
        }

        function toggleOldPassword() {
            const passwordField = document.getElementById("oldPassword");
            const eyeIcon = document.getElementById("eye-icon-old");

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

        function toggleNewPassword() {
            const passwordField = document.getElementById("newPassword");
            const eyeIcon = document.getElementById("eye-icon-new");

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

        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");

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

        function updateProgressBar(greenPoint) {
            const validPoint = Math.max(0, Math.min(greenPoint, 100));

            const progressBar = document.getElementById('progress-bar');

            let width = 0;
            if (validPoint == 0) {
                width = 0
            } else if (validPoint > 0 && validPoint <= 25) {
                width = 25;
            } else if (validPoint >= 26 && validPoint <= 50) {
                width = 50;
            } else if (validPoint >= 51 && validPoint <= 75) {
                width = 75;
            } else if (validPoint >= 76 && validPoint <= 100) {
                width = 100;
            }

            progressBar.style.width = `${width}%`;
        }

        @if (session('changePasswordSuccess'))
            Swal.fire({
                title: 'Change Password Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#76b743'
            });
        @endif

        @if (session('updateSuccess'))
            Swal.fire({
                title: 'Update Profile Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#76b743'
            });
        @endif

        updateProgressBar(<?php echo $buyer->greenPoint; ?>);
    </script>
@endsection
