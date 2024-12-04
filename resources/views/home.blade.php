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
                <p class="text-3xl font-bold text-[#3C552D]">Love the Environment Starting Now!</p>
                <p>It's time to take part in efforts to save the environment by buying recycled products</p>
                <div>
                    <a href="#"
                        class="text-sm font-medium border border-[#3C552D] text-[#3C552D] px-5 py-2 rounded-xl hover:bg-[#3C552D] hover:text-white">Shop
                        Now!</a>
                </div>
            </div>
        </div>

        <div class="konten2 mx-32 max-sm:mx-8">
            <p class="text-center font-bold text-[40px] text-[#3C552D] mb-7">BENEFITS</p>
            <div class="flex gap-3 max-sm:flex max-sm:flex-col max-sm:gap-10">
                <div class="max-sm:flex max-sm:flex-col">
                    <div class="text-end w-11/12 mb-10 animate-fromTopLeft max-sm:text-center">
                        <p class="font-medium text-lg">Mendukung Lingkungan</p>
                        <p class="text-[#616161]">Membeli produk daur ulang dan organik membantu mengurangi limbah dan
                            mendukung keberlanjutan.</p>
                    </div>
                    <div class="text-end w-11/12 animate-fromBottomLeft max-sm:text-center">
                        <p class="font-medium text-lg">Transparansi Produk</p>
                        <p class="text-[#616161]">Setiap produk dilengkapi informasi asal bahan dan dampak lingkungannya,
                            mempermudah keputusan
                            pembelian yang bertanggung jawab.</p>
                    </div>
                </div>
                <div class="max-sm:flex max-sm:flex-col">
                    <div class="mb-10 w-11/12 animate-fromTopRight max-sm:text-center">
                        <p class="font-medium text-lg">Komunitas Pendukung</p>
                        <p class="text-[#616161]">Bergabung dengan EcoForum untuk berbagi pengalaman, tips, dan ulasan
                            bersama pengguna lain yang peduli pada lingkungan.</p>
                    </div>
                    <div class="animate-fromBottomRight w-11/12 max-sm:text-center">
                        <p class="font-medium text-lg">Edukasi Gaya Hidup Hijau</p>
                        <p class="text-[#616161]">Akses ke artikel, video, dan tantangan ramah lingkungan untuk
                            menginspirasi
                            gaya hidup berkelanjutan.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
