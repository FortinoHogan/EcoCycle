@extends('layout.master')

@section('konten')
    <style>
        .scrollbar-hidden::-webkit-scrollbar {
            width: 0;
            display: none;
        }
    </style>
    <div class="p-4">
        <div class="block m-auto w-full max-w-[1200px] px-4">
            <div class="flex justify-between items-center w-full flex-wrap">
                <h2 class="font-bold text-[50px] text-[#3C552D] mb-5">My Shop</h2>
                <div class="flex flex-col justify-center items-end w-full mb-4 gap-4">
                    <form action="{{ route('shop.index') }}" class="relative text-gray-600">
                        <input class="border-2 border-gray-300 bg-white h-10 w-[200px] rounded-lg text-sm focus:outline-none"
                            type="text" name="search" placeholder="Search" style="padding-right: 2.5rem"
                            value="{{ request('search') }}">
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
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
                    <form action="{{ route('shop.index') }}" class="flex items-center gap-3">
                        <label for="sort" class="text-sm font-medium text-gray-900 dark:text-white">Sort by:</label>
                        <select id="sort" name="sort"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            onchange="this.form.submit()">
                            <option value="release-date" {{ request('sort') == 'release-date' ? 'selected' : '' }}>Release
                                Date</option>
                            <option value="alphabetical-ascending"
                                {{ request('sort') == 'alphabetical-ascending' ? 'selected' : '' }}>
                                Alphabetical Ascending
                            </option>
                            <option value="alphabetical-descending"
                                {{ request('sort') == 'alphabetical-descending' ? 'selected' : '' }}>
                                Alphabetical Descending
                            </option>
                            <option value="most-price" {{ request('sort') == 'most-price' ? 'selected' : '' }}>Most Price
                            </option>
                            <option value="least-price" {{ request('sort') == 'least-price' ? 'selected' : '' }}>Least Price
                            </option>
                        </select>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>
                </div>
            </div>
            <div class="flex justify-end my-4">
                <button
                    class="hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500"
                    onclick="toggleModal(true)">
                    ADD
                </button>
            </div>
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                @if (count($products) == 0)
                    <p class="text-2xl font-bold text-[#3C552D]">No product found</p>
                @endif
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

                            <div class="mt-4 flex justify-between gap-4 max-sm:flex-col sm:items-center max-sm:items-start">
                                <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp.
                                    {{ number_format($prod->price, 0, ',', '.') }}</p>

                                <a href="{{ route('detail_seller', $product_id = $prod->id) }}"
                                    class="inline-flex items-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">SEE
                                    MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center">
                {{ $products->appends(['search' => request('search'), 'sort' => request('sort')])->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    <div id="modalWrapper" style="{{ $errors->any() ? 'display: flex;' : 'display: none;' }}"
        class="bg-black bg-opacity-40 fixed inset-0 z-50 items-center justify-center" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg max-w-[640px] w-[90%] p-8 h-5/6 overflow-y-auto scrollbar-hidden"
            onclick="stopPropagation(event)">
            <h2 class="font-bold text-xl text-[#5c5c5c] text-center p-8">Add Product</h2>
            @if ($errors->any())
                <div class="bg-[#d73930] py-3 px-4 text-white mb-3 flex items-center justify-between" id="errorMsg">
                    <span>{{ $errors->first() }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        id="closeError" fill="#e8eaed" class="cursor-pointer">
                        <path
                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg>
                </div>
            @endif
            <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data" onsubmit="showSpinner()">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input id="name" name="name"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        required value="{{ old('name') }}">
                </div>

                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input id="price" name="price"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        required value="{{ old('price') }}">
                </div>

                <div class="mb-6">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input id="stock" name="stock"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        required value="{{ old('stock') }}">
                </div>

                <div class="mb-6">
                    <label for="picture" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" name="image"
                        class="mt-1 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        onchange="previewImage(event)">

                    <div id="imagePreview" class="mt-4">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
                    <input id="ingredients" name="ingredients"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        required value="{{ old('ingredients') }}">
                </div>

                <div class="mb-6">
                    <label for="origin" class="block text-sm font-medium text-gray-700">Origin</label>
                    <input id="origin" name="origin"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none"
                        required value="{{ old('origin') }}">
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none resize-none">{{ old('description') }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
                    <div
                        class="relative mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none focus:border-transparent flex justify-between items-center">
                        <button id="dropdownButton" type="button" class="flex items-center justify-between w-full">
                            Select Categories
                            <span class="ml-2 text-xs text-gray-500">+</span>
                        </button>
                        <div id="dropdownMenu"
                            class="absolute mt-2 top-10 left-0 w-full bg-white border border-[#5c5c5c] border-opacity-30 rounded-sm shadow-lg hidden">
                            <div class="p-2 max-h-60 overflow-y-auto scrollbar-hidden">
                                @foreach ($categories as $category)
                                    <label class="flex items-center mb-2">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                            class="mr-2 rounded-sm">
                                        {{ $category->category }}
                                    </label>
                                @endforeach
                            </div>
                            <button style="background-color: #76b743" id="dropdownButtonDone"
                                class="hover:opacity-80 border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500 ml-2 mb-2"
                                type="button">Done</button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-5">
                    <button type="button"
                        class="hover:opacity-80 py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500 bg-gray-500"
                        onclick="closeModal()">CANCEL</button>
                    <button
                        class="hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500">ADD
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="spinner"
        class="bg-[rgb(189,236,211)] opacity-70 hidden top-0 fixed min-h-[100%] w-[100%] z-[99] justify-center items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24">
            <rect width="2.8" height="12" x="1" y="6" fill="currentColor">
                <animate id="svgSpinnersBarsScale0" attributeName="y" begin="0;svgSpinnersBarsScale1.end-0.1s"
                    calcMode="spline" dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="0;svgSpinnersBarsScale1.end-0.1s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="5.8" y="6" fill="currentColor">
                <animate attributeName="y" begin="svgSpinnersBarsScale0.begin+0.1s" calcMode="spline" dur="0.6s"
                    keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.1s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="10.6" y="6" fill="currentColor">
                <animate attributeName="y" begin="svgSpinnersBarsScale0.begin+0.2s" calcMode="spline" dur="0.6s"
                    keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.2s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="15.4" y="6" fill="currentColor">
                <animate attributeName="y" begin="svgSpinnersBarsScale0.begin+0.3s" calcMode="spline" dur="0.6s"
                    keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.3s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
            <rect width="2.8" height="12" x="20.2" y="6" fill="currentColor">
                <animate id="svgSpinnersBarsScale1" attributeName="y" begin="svgSpinnersBarsScale0.begin+0.4s"
                    calcMode="spline" dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="6;1;6" />
                <animate attributeName="height" begin="svgSpinnersBarsScale0.begin+0.4s" calcMode="spline"
                    dur="0.6s" keySplines=".36,.61,.3,.98;.36,.61,.3,.98" values="12;22;12" />
            </rect>
        </svg>
    </div>
@endsection

@section('scripts')
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownButtonDone = document.getElementById('dropdownButtonDone');
        const dropdownMenu = document.getElementById('dropdownMenu');


        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        dropdownButtonDone.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        if (document.getElementById("closeError")) {
            document.getElementById("closeError").addEventListener("click", function() {
                document.getElementById("errorMsg").style.display = "none";
            });
        }

        function previewImage(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Preview';
                    img.className = 'w-32 h-32 object-cover border rounded';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }

        function toggleModal(isVisible) {
            const modal = document.getElementById('modalWrapper');
            if (isVisible) {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }

        function closeModal() {
            toggleModal(false);
        }

        function stopPropagation(event) {
            event.stopPropagation();
        }

        function showSpinner() {
            document.getElementById("spinner").classList.remove("hidden");
            document.getElementById("spinner").classList.add("flex");
        }

        @if (session('insertSuccess'))
            Swal.fire({
                title: 'Insert Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#76b743'
            });
        @endif

        @if (session('deleteSuccess'))
            Swal.fire({
                title: 'Delete Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#76b743'
            });
        @endif
    </script>
@endsection
