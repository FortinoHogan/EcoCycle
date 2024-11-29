@extends('layout.master')

@section('konten')

<div style="margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; animation: fadeIn 0.5s ease-in-out;">
    <!-- Input Section -->
    <div id="input-container" style="display: flex; align-items: center; gap: 15px; padding: 12px; border: 1px solid #ddd; border-radius: 10px; background: #f9f9f9; position: relative;">
        <!-- Profile Photo -->
        <img src="{{asset('asset/profile.webp')}}" alt="Profile" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">

        <!-- Input Box -->
        <div style="flex-grow: 1; display: flex; align-items: center; position: relative;">
            <input
                class="rounded-full"
                id="discussion-box"
                placeholder="Start a discussion"
                style="padding: 12px 15px; border: 1px solid #ddd;  outline: none; resize: none; overflow: hidden; font-size: 14px; line-height: 1.5; width: 100%; color: #333; background-color: transparent;"></input>
        </div>

        <!-- Upload Photo -->
        <label for="file-upload" style="cursor: pointer; display: flex; align-items: center;">
           <i class="fa-regular fa-image" style="font-size: 18px;"></i>
        </label>
        <input type="file" id="file-upload" style="display: none;">

        <!-- Post Button -->
        <button id="post-button" style="background-color: #3C552D; color: #fff; border: none; padding: 10px 20px; border-radius: 20px; cursor: pointer; font-size: 14px;">Post</button>
    </div>

    <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">

    <!-- Discussion Section -->
    <div style="margin-top: 20px;">
        <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 20px;">
            <img src="{{asset('asset/profile.webp')}}" alt="User" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
            <div>
                <h4 style="margin-bottom: 5px; font-size: 16px; color: #333;">John Doe</h4>
                <p style="margin-bottom: 10px; color: #555;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                <div style="display: flex; align-items: center; gap: 12px; font-size: 14px; color: #777;">
                    <a href="" style="margin-right: 5px;">
                        <i class="fa-regular fa-comment" style="font-size: 16px;"></i>
                    </a>
                    <span onclick="toggleLike(this)" style="cursor: pointer;">
                        <i class="fa-regular fa-heart" style="font-size: 16px;"></i>
                    </span>
                    <a href="" style="margin-left: 5px;">
                        <i class="fa-solid fa-share" style="font-size: 16px;"></i>
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
