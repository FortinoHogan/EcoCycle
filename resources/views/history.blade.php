@extends('layout.master')
@section('konten')
    @foreach ($transaction as $item)
        <p>{{ $item->status }}</p>
    @endforeach
@endsection