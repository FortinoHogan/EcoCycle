@extends('layout.master')

@section('konten')
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

    <div class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-md page-transition">
        <div class="flex justify-between items-center px-6 py-4 border-b border-[#3C552D]">
            <h1 class="text-xl font-bold text-[#3C552D]">Hi, {{ $buyer->name }}</h1>
        </div>

        <div class="p-6">
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
            <form class="mt-6 space-y-4">
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
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Phone number <span class="text-red-500"></span>
                    </label>
                    <input id="email" name="email" type="email" value="{{ $buyer->phone }}"
                        class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />
                </div>

                <!-- Password -->
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="relative">
                        <!-- Input password -->
                        <input id="password" name="password" type="password" value="{{ $buyer->password }}"
                            class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 pr-10" />
                        <!-- Icon mata -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-3 flex items-center">
                            <i id="eye-icon" class="fa-solid fa-eye text-gray-500"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex justify-center items-center">
            <button
                class="px-8 py-1 mt-4 mb-10 text-center rounded-full text-[#3C552D] bg-white border-2 border-[#3C552D] shadow-lg hover:bg-[#2a4120] hover:text-white transition-all duration-500">
                Save
            </button>
        </div>
    </div>

    <script>
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
        updateProgressBar(<?php echo $buyer->greenPoint; ?>);
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
@endsection
