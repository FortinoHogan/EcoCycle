@extends('layout.master')

@section('konten')
    <div class="container mx-auto">
        <div class="my-10">
            <p class="font-bold text-5xl">Checkout</p>
            <p class="font-bold text-3xl mt-5">Your order</p>
        </div>
        @if (empty($cart))
            <p>Your cart is empty!</p>
        @else
            @foreach ($cart as $item)
                <div class="mt-5 flex justify-between">
                    <div class="flex gap-5 items-center">
                        <img class="size-20 object-cover"
                            src="data:image/jpeg;base64,{{ base64_encode($item->product->image) }}" alt="">
                        <p>{{ $item->product->name }}</p>
                    </div>
                    <div class="flex gap-20 items-center font-semibold">
                        <p>Quantity: {{ $item->quantity }}</p>
                        <p>IDR {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
            @endforeach
            <hr class="my-5">
            <div class="flex text-lg justify-between font-semibold">
                <p>Total ({{ $cart->count() }} item)</p>
                <p>IDR {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            </div>
            <div class="flex mt-10 gap-5 items-center">
                <p class="text-2xl font-bold">Shipping Address</p>
                <button class="rounded-md border border-black px-5 py-1">Change</button>
            </div>
            <div class="mt-10">
                <p class="text-2xl font-bold">Order Summary</p>
                <div class="font-semibold mt-4">
                    <div class="flex justify-between">
                        <p>Subtotal ({{ $cart->count() }} item)</p>
                        <p>IDR {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Shipping Fee</p>
                        <p>IDR {{ number_format($transaction->shipping_fee, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-10 text-2xl font-bold flex justify-between">
                <p>Grand Total</p>
                <p>IDR {{ number_format($transaction->grand_total, 0, ',', '.') }}</p>
            </div>
            <div class="mt-10 flex justify-center items-center">
                <button id="pay-button"
                    class="inline-flex items-center rounded-lg bg-green-700 px-7 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    PAY
                </button>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key={{ env('MIDTRANS_CLIENT_KEY') }}></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $transaction->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    fetch('{{ route('process-success') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                transaction_id: {{ $transaction->id }},
                                midtrans_data: result
                            }),
                        })
                        .then(response => {
                            if (response.redirected) {
                                // Redirect to the new view
                                window.location.href = response.url;
                            } else {
                                return response.json();
                            }
                        })
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
