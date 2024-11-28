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
      <h1 class="text-xl font-bold text-[#3C552D]">Hi, John Doe</h1>
      <button class="px-4 py-2 text-center text-[#3C552D] bg-white border-2 border-[#3C552D] rounded-full shadow-lg hover:bg-[#2a4120] hover:text-[#3C552D] flex items-center justify-center">
        Save
      </button>
    </div>

    <div class="p-6">
        <div class="flex flex-col items-center">
            <!-- Avatar Section -->
            <div class="relative group">
                <!-- Profile Picture -->
                <img
                    class="w-24 h-24 rounded-full border"
                    src="{{asset('asset/profile.webp')}}"
                    alt="profile"
                />
                <!-- Hover Effect -->
                <label
                    class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                >
                    <span class="text-sm text-white text-center">Upload a photo</span>
                    <input type="file" class="hidden" />
                </label>
            </div>

            <!-- User Info -->
            <h2 class="mt-4 text-lg font-bold">John Doe</h2>
            <p class="text-sm text-gray-500 mt-1">johndoe@gmail.com - EcoNewbie</p>
            {{-- Loyalty Point --}}
            <p class="text-sm text-gray-500 mt-1">Your current point : 0</p>
            <!-- Loyalty Program Progress Bar -->
            <div class="w-full mt-4">
                <h3 class="text-sm font-medium text-gray-700">Loyalty Program</h3>
                <div class="w-full bg-gray-200 rounded-full h-4 mt-2 shadow-sm">
                <div
                    class="bg-[#749d5c] h-4 rounded-full"
                    style="width: 15%;"
                ></div>
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
            <!-- Username -->
            <div>
              <label for="username" class="block text-sm font-medium text-gray-700">
                Username
              </label>
              <input
                id="username"
                name="username"
                type="text"
                value="John Doe"
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
              />
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email <span class="text-red-500">*</span>
              </label>
              <input
                id="email"
                name="email"
                type="email"
                value="johndoe@gmail.com"
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
              />
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-medium text-gray-700">
                  Password
                </label>
                <div class="relative">
                  <!-- Input password -->
                  <input
                    id="password"
                    name="password"
                    type="password"
                    value="password"
                    class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 pr-10"
                  />
                  <!-- Icon mata -->
                  <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 px-3 flex items-center"
                  >
                    <!-- Eye Icon for hidden password -->
                    <i id="eye-icon" class="fa-solid fa-eye text-gray-500"></i>
                  </button>
                </div>
              </div>

            <!-- Full Name -->
            <div>
              <label for="fullname" class="block text-sm font-medium text-gray-700">
                Full Name <span class="text-red-500">*</span>
              </label>
              <input
                id="fullname"
                name="fullname"
                type="text"
                value="John Doe"
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
              />
            </div>
      <!-- Title -->
      <div>
        <label for="title" class="block text-sm font-medium text-gray-700">
          Title
        </label>
        <input
          id="title"
          name="title"
          type="text"
          value="EcoNewbie"
          class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
          disabled
        />
      </div>

      <!-- Language -->
      <div>
        <label for="language" class="block text-sm font-medium text-gray-700">
          Language
        </label>
        <select
          id="language"
          name="language"
          class="mt-1 w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
        >
          <option selected>English</option>
          <option>Bahasa Indonesia</option>
        </select>
      </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const eyeIcon = document.getElementById("eye-icon");

      if (passwordField.type === "password") {
        // Show the password
        passwordField.type = "text";
        // Change the icon to 'eye-slash'
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
      } else {
        // Hide the password
        passwordField.type = "password";
        // Change the icon to 'eye'
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      }
    }
  </script>

<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
@endsection
