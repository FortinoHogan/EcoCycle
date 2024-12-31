@extends('layout.master')

@section('konten')
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-2xl px-4 2xl:px-0">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-2">Thanks for your order!</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Your order <a href="#"
                    class="font-medium text-gray-900 dark:text-white hover:underline">#{{ $transaction->order_id }}</a> will
                be processed within
                24 hours during working days. We will notify you by email once your order has been shipped.</p>
            <div
                class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Date</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                        {{ \Carbon\Carbon::parse($transaction->transaction_time)->format('d F Y') }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Payment Method</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                        {{ $transaction->payment_type }}
                        @if (isset($transaction->va_numbers) && isset($transaction->va_numbers[0]['bank']))
                            {{ $transaction->va_numbers[0]['bank'] }}
                        @endif
                    </dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Name</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ session('buyer')->name }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Address</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $address->street }},
                        {{ $address->subdistrict }}, {{ $address->city }}, {{ $address->province }},
                        {{ $address->postal_code }}</dd>
                </dl>
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Phone</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ session('buyer')->phone }}</dd>
                </dl>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('shop.view') }}"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Return
                    to Shopping</a>
            </div>
        </div>
    </section>
@endsection
