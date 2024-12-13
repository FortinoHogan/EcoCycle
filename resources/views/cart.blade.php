@extends('layout.master')

@section('konten')
    <div class="p-4 mb-32">
        <div class="block m-auto w-full max-w-[1200px] px-4">
            <div class="container mx-auto">
                <h1 class="font-bold text-[50px] text-[#3C552D] mb-10">CART</h1>
                @if ($cart->isEmpty())
                    <p class="font-medium">Your cart is empty!</p>
                @else
                    <div>
                        @foreach ($cart as $item)
                            <hr class="mt-5">
                            <div class="flex my-5 items-center justify-between">
                                <div class="flex gap-5 items-center">
                                    <input class="appearance-none accent-green-700 product-checkbox" type="checkbox"
                                        data-id="{{ $item->product_id }}" />
                                    <img class="size-20 object-cover"
                                        src="data:image/jpeg;base64,{{ base64_encode($item->product->image) }}"
                                        alt="">
                                    <p>{{ $item->product->name }}</p>
                                </div>
                                <p class="cursor-pointer remove-item" data-id="{{ $item->product_id }}">x</p>
                            </div>
                            <div class="w-full h-20 bg-[#EAEAEA]">
                                <div class="flex justify-between items-center h-full px-5">
                                    <div class="flex">
                                        <span
                                            class="px-2 font-semibold border-black border bg-[#F7FAF7] cursor-pointer update-cart"
                                            data-id="{{ $item->product_id }}" data-action="decrement">-</span>
                                        <span class="px-3 border-y-black border bg-[#F7FAF7]">{{ $item->quantity }}</span>
                                        <span
                                            class="px-2 font-semibold border-black border bg-[#F7FAF7] cursor-pointer update-cart"
                                            data-id="{{ $item->product_id }}" data-action="increment">+</span>
                                    </div>
                                    <p>IDR {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between font-semibold mt-5">
                                <p>Total ({{ $item->quantity }} item)</p>
                                <p>IDR {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                    <hr class="my-5">
                    <div class="w-full">
                        <button
                            class="btn-checkout float-right inline-flex items-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Check Out
                        </button>
                    </div>
                    {{-- <a href="{{ route('checkout.confirm') }}" class="btn btn-primary">Proceed to Payment</a> --}}
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const updateButtons = document.querySelectorAll('.update-cart');
            const removeButtons = document.querySelectorAll('.remove-item');
            const checkoutButton = document.querySelector('.btn-checkout');

            updateButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const productId = button.getAttribute('data-id');
                    const action = button.getAttribute('data-action');

                    fetch('{{ route('update-quantity') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                action: action
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === 'Cart updated') {
                                location.reload(); // Reload to update cart totals
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });

            removeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const productId = button.getAttribute('data-id');

                    fetch('{{ route('remove-from-cart') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                product_id: productId
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message === 'Item removed') {
                                location.reload(); // Reload to update the cart
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });

            // Checkout logic
            checkoutButton.addEventListener('click', () => {
                const checkedProducts = [];
                const checkboxes = document.querySelectorAll('.product-checkbox:checked');

                checkboxes.forEach(checkbox => {
                    checkedProducts.push(checkbox.getAttribute('data-id'));
                });

                if (checkedProducts.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No items selected',
                        text: 'Please select at least one product to checkout.',
                    });
                    return;
                }

                // Disable the button and show loading state
                checkoutButton.disabled = true;
                checkoutButton.innerHTML = `
                        <svg class="animate-spin -ms-2 me-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C6.268 0 2 4.268 2 9.5S6.268 19 12 19v-2a8 8 0 01-8-8z"></path>
                        </svg>
                        Processing...`;

                fetch('{{ route('process-checkout') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            product_ids: checkedProducts
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
                    .then(data => {
                        if (data && data.message) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Checkout Complete',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false,
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Checkout Failed',
                            text: 'There was an issue processing your checkout. Please try again.',
                        });
                    })
                    .finally(() => {
                        // Restore the button state
                        checkoutButton.disabled = false;
                        checkoutButton.innerHTML = 'Check Out';
                    });
            });
        });
    </script>
@endsection
