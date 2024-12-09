@extends('layout.master')

@section('konten')
    <style>
        .scrollbar-hidden::-webkit-scrollbar {
            width: 0;
            display: none;
        }
    </style>
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
                <button id="add-address" onclick="toggleModal(true)" class="rounded-md border border-black px-5 py-1">
                    {{ $transaction->address_id ? 'Change' : 'Add' }}
                </button>
            </div>
            @if ($selected_address)
                <div class="mt-4">
                    <p>{{ $selected_address->buyer->name }}</p>
                    <p>{{ $selected_address->buyer->phone }}</p>
                    <p>{{ $selected_address->street }}</p>
                    <p>{{ $selected_address->subdistrict }}, {{ $selected_address->city }},
                        {{ $selected_address->province }}</p>
                    <p>{{ $selected_address->postal_code }}</p>
                </div>
            @endif
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
    <div id="addModalWrapper" style="display: none;"
        class="bg-black bg-opacity-40 fixed inset-0 z-50 items-center justify-center" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg max-w-[640px] w-[90%] p-8 h-5/6 overflow-y-auto scrollbar-hidden"
            onclick="stopPropagation(event)">
            <h2 class="font-bold text-xl text-[#5c5c5c] text-center p-8">Add Shipping Address</h2>
            <form action="{{ route('set-address') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="address_id" id="address_id" value="{{ $transaction->address_id }}">
                <input type="hidden" name="id" id="id" value="{{ $transaction->id }}">

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="{{ session('buyer')->name }}" placeholder="Name...">
                </div>

                <div class="mb-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input id="phone" name="phone"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="{{ session('buyer')->phone }}" placeholder="08...">
                </div>

                <div class="mb-6">
                    <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                    <input id="street" name="street"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="" placeholder="Jl. Kebon Jeruk No. XX">
                </div>

                <div class="mb-6">
                    <label for="province" class="block text-sm font-medium text-gray-700">Province</label>
                    <input id="province" name="province"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="" placeholder="DKI Jakarta">
                </div>

                <div class="mb-6">
                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                    <input id="city" name="city"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="" placeholder="Kota Jakarta Barat">
                </div>

                <div class="mb-6">
                    <label for="subdistrict" class="block text-sm font-medium text-gray-700">Subdistrict</label>
                    <input id="subdistrict" name="subdistrict"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="" placeholder="Palmerah">
                </div>

                <div class="mb-6">
                    <label for="postal" class="block text-sm font-medium text-gray-700">Postal Code</label>
                    <input id="postal" name="postal"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        value="" placeholder="11430">
                </div>
                <div class="flex justify-center">
                    <button
                        class="hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500">ADD
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="setModalWrapper" style="display: none;"
        class="bg-black bg-opacity-40 fixed inset-0 z-50 items-center justify-center" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg max-w-[640px] w-[90%] p-8 h-5/6 overflow-y-auto scrollbar-hidden"
            onclick="stopPropagation(event)">
            <h2 class="font-bold text-xl text-[#5c5c5c] text-center p-8">Select Shipping Address</h2>
            <hr>
            <form action="{{ route('change-address') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach ($addresses as $address)
                    <div class="my-5 flex items-center gap-5">
                        <input type="hidden" name="id" id="id" value="{{ $transaction->id }}">
                        <input type="radio" id="address-checked-{{ $address->id }}" name="main_address"
                            value="{{ $address->id }}" @if ($address->main) checked @endif>
                        <label for="address-checked-{{ $address->id }}">
                            <p class="font-bold">{{ $address->buyer->name }}</p>
                            <p>{{ $address->buyer->phone }}</p>
                            <p>{{ $address->street }}</p>
                            <p>{{ $address->subdistrict }}, {{ $address->city }}, {{ $address->province }}</p>
                            <p>{{ $address->postal_code }}</p>
                        </label>
                    </div>
                    <hr>
                @endforeach
                <div class="flex mt-8 gap-5 justify-center">
                    <button onclick="addNewAddress()"
                        class="w-full hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md font-bold align-middle transition-all ease-in-out duration-500">ADD
                        NEW ADDRESS
                    </button>
                    <button
                        class="w-full hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md font-bold align-middle transition-all ease-in-out duration-500">CHOOSE
                    </button>
                </div>
            </form>
        </div>
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

        function toggleModal(isVisible) {
            const add = document.getElementById('add-address');
            const modal = add.innerHTML.trim() === "Add" ? document.getElementById('addModalWrapper') : document
                .getElementById('setModalWrapper');
            if (isVisible) {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }

        function addNewAddress() {
            event.preventDefault();
            const setModal = document.getElementById('setModalWrapper');
            const addModal = document.getElementById('addModalWrapper');

            setModal.style.display = 'none';
            addModal.style.display = 'flex';
        }

        function closeModal() {
            toggleModal(false);
        }

        function stopPropagation(event) {
            event.stopPropagation();
        }
    </script>
@endsection
