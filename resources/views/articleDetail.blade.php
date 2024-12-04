@extends('layout.master')
@section('konten')
    <div class="mx-40 mt-16 mb-20">
        <p class="text-3xl font-bold text-center">{{ $article->title }}</p>
        <p class="text-md text-gray-500 mt-2 text-center">{{ $article->createdDate }}</p>
        <div class="mt-10">
            <img src="data:image/jpeg;base64,{{ base64_encode($article->image) }}"
                 alt=""
                 class="rounded-2xl object-contain">
        </div>
        <p class="text-lg mt-6 text-justify">{{ $article->description }}</p>
    </div>
@endsection
