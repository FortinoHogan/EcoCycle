@extends('layout.master')

@section('konten')
<div class="container">
    <h1>Checkout</h1>
    @if(empty($cart))
        <p>Your cart is empty!</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td><img src="data:image/jpeg;base64,{{ base64_encode($item['image']) }}" alt="{{ $item['name'] }}" style="height: 50px;"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp. {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <a href="{{ route('checkout.confirm') }}" class="btn btn-primary">Proceed to Payment</a> --}}
    @endif
</div>
@endsection