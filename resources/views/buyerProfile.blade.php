@extends('layout.master')
@section('konten')
    @foreach ($buyer as $b)
        <div class="flex justify-center items-center">
            <img src="data:image/jpeg;base64,{{ base64_encode($b->profileImage) }}" alt=""
                class="w-40 h-40 object-cover mb-4 rounded-full p-3">
        </div>
    @endforeach
@endsection
