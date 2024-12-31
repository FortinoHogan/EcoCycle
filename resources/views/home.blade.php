@extends('layout.master')
@section('konten')
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                didOpen: () => {
                    const confirmButton = Swal.getConfirmButton();
                    confirmButton.style.color = 'black';
                    confirmButton.style.border = '1px solid #ccc';
                }
            });
        </script>
    @endif
    <div class="mb-40">
        <div class="konten1 flex justify-center items-center px-60 mt-24 mb-32 gap-10 max-md:flex-col max-sm:px-8">
            <div class="image-container animate-slideInFromLeft">
                <img src="{{ asset('asset/orang.png') }}" class="max-w-[400px] max-sm:w-[200px] max-md:w-[300px]"
                    alt="">
            </div>

            <div class="text-container flex flex-col gap-8 text-center animate-slideInFromRight">
                <p class="text-3xl font-bold text-[#3C552D]">@lang('lang.love_env')</p>
                <p>@lang('lang.bawah_judul')</p>
                @if (session('buyer'))
                    <div>
                        <a href="{{ route('shop.view') }}"
                            class="text-sm font-medium border border-[#3C552D] text-[#3C552D] px-5 py-2 rounded-xl hover:bg-[#3C552D] hover:text-white">@lang('lang.shop_now')</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="konten2 mx-32 max-sm:mx-8 flex flex-col items-center">
            <p class="text-center font-bold text-[40px] text-[#3C552D] mb-7">@lang('lang.benefits')</p>
            <div class="flex gap-16 max-sm:flex max-sm:flex-col max-sm:gap-10">
                <div class="max-sm:flex max-sm:flex-col sm:w-1/2">
                    <div class="text-end mb-10 animate-fromTopLeft max-sm:text-center">
                        <p class="font-medium text-lg">@lang('lang.benefits_1')</p>
                        <p class="text-[#616161]">@lang('lang.benefits_1_1')</p>
                    </div>
                    <div class="text-end animate-fromBottomLeft max-sm:text-center">
                        <p class="font-medium text-lg">@lang('lang.benefits_2')</p>
                        <p class="text-[#616161]">@lang('lang.benefits_2_2')</p>
                    </div>
                </div>
                <div class="max-sm:flex max-sm:flex-col sm:w-1/2">
                    <div class="mb-10 animate-fromTopRight max-sm:text-center">
                        <p class="font-medium text-lg">@lang('lang.benefits_3')</p>
                        <p class="text-[#616161]">@lang('lang.benefits_3_3')</p>
                    </div>
                    <div class="animate-fromBottomRight max-sm:text-center">
                        <p class="font-medium text-lg">@lang('lang.benefits_4')</p>
                        <p class="text-[#616161]">@lang('lang.benefits_4_4')</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
