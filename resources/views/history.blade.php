@extends('layout.master')
@section('konten')
{{-- {{dd($transaction)}} --}}
    <div class="mx-40 mt-14 mb-20">
        <p class="font-bold text-[50px] text-[#3C552D] mb-10">My Orders</p>
        @foreach ($transaction as $t)
            <div class="border-b border-[#3C552D] pb-6 mb-6 px-4">
                <div class="flex justify-between border-b-2 pb-2 mb-2">
                    <div class="">
                        <p>{{ $t->created_at->format('M d, Y H:i:s') }}</p>
                        <p>Order number {{ $t->id }}</p>
                    </div>
                    <div class="flex justify-end">
                        <p class="text-green-600">{{ $t->status }}</p>
                    </div>
                </div>
                <div>
                    <div class="flex gap-6">
                        <div>
                            {{-- <img class="w-20 rounded-full object-cover" src="data:image/jpeg;base64,{{ base64_encode($t->product->image) }}" alt=""> --}}
                        </div>
                        <div>
                            <p>{{ $t->details->first()->product->seller->name }}</p>
                            <p>{{ $t->details->first()->product->seller->region }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
