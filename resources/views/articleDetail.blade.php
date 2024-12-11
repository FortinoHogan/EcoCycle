@extends('layout.master')
@section('konten')
    <div class="p-4">
        <div class="block m-auto w-full max-w-[1200px] px-4">
            <p class="text-3xl font-bold text-center">{{ $article->title }}</p>
            <p class="text-md text-gray-500 mt-2 text-center">{{ $article->createdDate }}</p>
            <div class="mt-10 flex justify-center">
                <img src="data:image/jpeg;base64,{{ base64_encode($article->image) }}" alt=""
                    class="rounded-2xl h-60 w-full object-contain">
            </div>
            <p class="text-lg mt-6 text-justify">{{ $article->description }}</p>
        </div>
    </div>
@endsection
