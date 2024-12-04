@extends('layout.master')
@section('konten')
    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($product as $prod)
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="h-56 w-full">
                            <a href="#">
                                <img class="mx-auto h-full dark:hidden"
                                    src="data:image/jpeg;base64,{{ base64_encode($prod->image) }}" alt="" />
                                <img class="mx-auto hidden h-full dark:block"
                                    src="data:image/jpeg;base64,{{ base64_encode($prod->image) }}" alt="" />
                            </a>
                        </div>
                        <div class="mt-6 flex items-center justify-between gap-4">
                            <span
                                class="me-2 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                Organik
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="#"
                                class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $prod->name }}</a>

                            <p class="mt-2 text-sm font-medium text-gray-500 dark:text-gray-400">Stock: {{ $prod->stock }}
                                left</p>
                            <p class="mt-2 text-sm font-medium text-gray-900">
                                {{ Str::limit($prod->description->description, 50) }}</p>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp.
                                    {{ number_format($prod->price, 0, ',', '.') }}</p>
                                <button onclick="window.location.href='{{ route('detail', $product_id = $prod->id) }}'" id="pay-button" type="submit"
                                    class="inline-flex items-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    SEE MORE
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full text-center">
                <button type="button"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Show
                    more</button>
            </div>
        </div>
    </section>
@endsection
