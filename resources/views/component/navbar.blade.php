<nav class="bg-[#E9EEDC] ">
    <div class="flex flex-wrap justify-between items-center px-8">
        <div>
            <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('asset/Logo.png') }}" class="w-20" alt="Flowbite Logo" />
            </a>
        </div>
        <div class="flex justify-end items-center w-80 gap-6">
            <a href="#"
                class="text-sm text-[#E9EEDC] font-medium border py-2 px-[18px] border-[#3C552D] rounded-md bg-[#3C552D]">Sign
                Up</a>
            <a href="#"
                class="text-sm text-[#3C552D] font-medium border py-2 px-[25px] border-[#3C552D] rounded-md">Login</a>
        </div>
    </div>
</nav>
<nav class="bg-[#3C552D]">
    <div class="px-8 py-3">
        <div class="flex items-center jus">
            <ul class="flex flex-row font-medium space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <a href="#" class="text-[#E9EEDC] hover:underline" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{route('ecoforum.index')}}" class="text-[#E9EEDC] hover:underline">EcoForum</a>
                </li>
                <li>
                    <a href="#" class="text-[#E9EEDC] hover:underline">EcoLearning</a>
                </li>
                <li>
                    <a href="{{route('profile')}}" class="text-[#E9EEDC] hover:underline">Profile</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

