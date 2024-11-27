@extends('layout.master')
@section('konten')

    <div class="mb-40">
        <div class="konten1 flex justify-center items-center m-10 px-60 mt-24 mb-32 ">
            <div class="image-container animate-slideInFromLeft">
                <img src="{{ asset('asset/orang.png') }}" class="max-w-[400px]" alt="">
            </div>

            <div class="text-container ms-10 flex flex-col gap-8 text-center animate-slideInFromRight">
                <p class="text-3xl font-bold text-[#3C552D]">Love the Environment Starting Now!</p>
                <p>It's time to take part in efforts to save the environment by buying recycled products</p>
                <div>
                    <a href="#"
                        class="text-sm font-medium border border-[#3C552D] text-[#3C552D] px-5 py-2 rounded-xl hover:bg-[#3C552D] hover:text-white">Shop
                        Now!</a>
                </div>
            </div>
        </div>

        <div class="konten2 mx-32">
            <p class="text-center font-bold text-[40px] text-[#3C552D] mt-20 mb-10">BENEFITS</p>
            <div class="flex gap-20">
                <div class="w-[800px]">
                    <div class="text-end mb-10 animate-fromTopLeft">
                        <p class="font-medium text-lg">Mendukung Lingkungan</p>
                        <p class="text-[#616161]">Membeli produk daur ulang dan organik membantu mengurangi limbah dan
                            mendukung keberlanjutan.</p>
                    </div>
                    <div class="text-end animate-fromBottomLeft">
                        <p class="font-medium text-lg">Transparansi Produk</p>
                        <p class="text-[#616161]">Setiap produk dilengkapi informasi asal bahan dan dampak lingkungannya,
                            mempermudah keputusan
                            pembelian yang bertanggung jawab.</p>
                    </div>
                </div>
                <div class="w-[800px]">
                    <div class="mb-10 animate-fromTopRight">
                        <p class="font-medium text-lg">Komunitas Pendukung</p>
                        <p class="text-[#616161]">Bergabung dengan EcoForum untuk berbagi pengalaman, tips, dan ulasan
                            bersama pengguna lain yang peduli pada lingkungan.</p>
                    </div>
                    <div class="animate-fromBottomRight">
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
