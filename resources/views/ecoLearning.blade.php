@extends('layout.master')
@section('konten')

<div class="">
    @foreach ($articles as $a)
        <div class="flex flex-row justify-center mx-40 my-10 border border-[#3C552D] rounded-2xl gap-5">
            <div>
                <img src="data:image/jpeg;base64,{{ base64_encode($a->image) }}" alt=""
                class="w-100 h-100 rounded-2xl object-cover">
            </div>
            <div class="flex flex-col justify-between gap-5 truncate">
                <p class="text-xl font-semibold ">{{$a->title}}</p>
                <p class="text-sm text-gray-500">{{$a->createdDate}}</p>
                <p class="text-md ">{{$a->description}}</p>
            </div>
        </div>
    @endforeach
</div>


@endsection
