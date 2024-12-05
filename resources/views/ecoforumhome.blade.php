@extends('layout.master')

@section('konten')

<div class="min-h-[62vh] mx-auto bg-white rounded-lg shadow-md p-6 animate__animated animate__fadeIn">
    <!-- Input Section -->
    <div id="input-container" class="flex items-center gap-4 p-3 border border-gray-300 rounded-lg bg-gray-50 relative">
        <!-- Profile Photo -->
        <img src="{{asset('asset/profile.webp')}}" alt="Profile" class="w-12 h-12 rounded-full object-cover">

        <!-- Input Box -->
        <div class="flex-grow flex items-center relative">
            <input class="w-full p-3 border border-gray-300 rounded-full text-sm text-gray-700 bg-transparent focus:outline-none focus:ring-2 focus:ring-green-400" id="discussion-box" placeholder="Start a discussion">
        </div>

        <!-- Upload Photo -->
        <label for="file-upload" class="cursor-pointer flex items-center">
           <i class="fa-regular fa-image text-xl"></i>
        </label>
        <input type="file" id="file-upload" class="hidden">

        <!-- Post Button -->
        <button id="post-button" class="bg-green-600 text-white px-6 py-2 rounded-full text-sm cursor-pointer hover:bg-green-500">Post</button>
    </div>

    <hr class="my-6 border-t border-gray-300">

    <!-- Discussion Section -->
    <div class="mt-6">
        <div class="flex items-start gap-3 mb-6">
            <img src="{{asset('asset/profile.webp')}}" alt="User" class="w-12 h-12 rounded-full object-cover">
            <div>
                <h4 class="text-lg text-gray-800 mb-2">John Doe</h4>
                <p class="text-gray-600 text-sm mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700">
                        <i class="fa-regular fa-comment"></i>
                    </a>
                    <span onclick="toggleLike(this)" class="cursor-pointer">
                        <i class="fa-regular fa-heart"></i>
                    </span>
                    <a href="#" class="hover:text-gray-700">
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Expand text box
    const textarea = document.getElementById('discussion-box');
    textarea.addEventListener('input', function () {
        this.style.height = '40px';
        this.style.height = this.scrollHeight + 'px';
    });

    // Like script
    function toggleLike(element) {
        const icon = element.querySelector('i');
        if (icon.classList.contains('fa-regular')) {
            icon.classList.remove('fa-regular');
            icon.classList.add('fa-solid');
        } else {
            icon.classList.remove('fa-solid');
            icon.classList.add('fa-regular');
        }
    }
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@endsection
