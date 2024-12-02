@extends('layout.master')

@section('konten')
    @foreach ($cart as $item)
    <p>{{ $item->name }}</p>
    @endforeach
@endsection
