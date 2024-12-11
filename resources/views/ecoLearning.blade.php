@extends('layout.master')
@section('konten')
    <style>
        @media (max-width: 640px) {
            #card {
                flex-direction: column;
            }
        }
    </style>
    <div class="p-4 mb-16">
        <div class="block m-auto w-full max-w-[1200px] px-4">
            @foreach ($articles as $a)
                <div class="flex flex-row justify-center my-10 p-3 border border-[#3C552D] rounded-2xl gap-5" id="card">
                    <div class="sm:max-w-[250px] border-black">
                        <img src="data:image/jpeg;base64,{{ base64_encode($a->image) }}" alt=""
                            class="w-full h-full rounded-bl-2xl rounded-tl-2xl max-sm:rounded-tr-2xl max-sm:rounded-br-2xl object-cover ">
                    </div>
                    <div class="flex flex-col justify-between gap-3 truncate">
                        <div>
                            <p class="text-xl font-semibold ">{{ $a->title }}</p>
                            <p class="text-sm text-gray-500 mt-2">{{ $a->createdDate }}</p>
                            <p class="text-md mt-4">{{ $a->description }}</p>
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('article_detail', ['id' => $a->id]) }}"
                                class="font-medium border border-black mb-1 py-1 px-5 rounded-2xl hover:bg-[#3C552D] hover:text-white transition-all duration-500">See
                                more...</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
