@extends('layout.master')
@section('konten')
    <section class="bg-gray-50 antialiased dark:bg-gray-900 md:py-12">
        <div class="p-4">
            <div class="block m-auto w-full max-w-[1200px] px-4">
                <div class="flex justify-end items-center w-full mb-4">
                    <form action="{{ route('shop.view') }}" class="relative text-gray-600">
                        <input
                            class="border-2 border-gray-300 bg-white h-10 w-[200px] rounded-lg text-sm focus:outline-none"
                            type="text" name="search" placeholder="Search" style="padding-right: 2.5rem"
                            value="{{ request('search') }}">
                        <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve" width="512px" height="512px">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </form>

                </div>
                <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $prod)
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
                            <div class="mt-6 flex items-center gap-1">
                                @foreach ($prod->product_categories as $category)
                                    <span
                                        class="me-2 rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                        {{ $category->category->category }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a href="#"
                                    class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $prod->name }}</a>

                                <p class="mt-2 text-sm font-medium text-gray-500 dark:text-gray-400">Stock:
                                    {{ $prod->stock }}
                                    left</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">
                                    {{ Str::limit($prod->description->description, 50) }}</p>

                                <div class="mt-4 flex items-center justify-between gap-4 flex-wrap">
                                    <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp.
                                        {{ number_format($prod->price, 0, ',', '.') }}</p>

                                    <button onclick="window.location.href='{{ route('detail', $product_id = $prod->id) }}'"
                                        id="pay-button" type="submit"
                                        class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-medium text-white hover:opacity-45 focus:outline-none focus:ring-4  focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                        style="background-color: #3C552D">
                                        See more...</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-center">
                    {{ $products->appends(['search' => request('search')])->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </section>
@endsection
