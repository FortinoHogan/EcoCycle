@extends('layout.master')

@section('konten')
    <style>
        .scrollbar-hidden::-webkit-scrollbar {
            width: 0;
            display: none;
        }
    </style>
    <div class="p-4">
        <div class="block m-auto w-[100%] max-w-[1200px]">
            <h2 class="font-bold text-2xl text-[#5c5c5c] mb-4">My Shop</h2>
            <div class="flex justify-end mb-4">
                <button
                    class="hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500"
                    onclick="toggleModal(true)">
                    ADD
                </button>
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

                                <a href="{{ route('detail_seller', $product_id = $prod->id) }}"
                                    class="inline-flex items-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4  focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">SEE
                                    MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <div id="modalWrapper" style="display: none;"
        class="bg-black bg-opacity-40 fixed inset-0 z-50 items-center justify-center" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg max-w-[640px] w-[90%] p-8 h-5/6 overflow-y-auto scrollbar-hidden"
            onclick="stopPropagation(event)">
            <h2 class="font-bold text-xl text-[#5c5c5c] text-center p-8">Add Product</h2>
            <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input id="name" name="name"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none">
                </div>

                <div class="mb-6">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input id="price" name="price"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none">
                </div>

                <div class="mb-6">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input id="stock" name="stock"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none">
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
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none">
                </div>

                <div class="mb-6">
                    <label for="origin" class="block text-sm font-medium text-gray-700">Origin</label>
                    <input id="origin" name="origin"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none">
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 p-2 w-full rounded-sm border border-[#5c5c5c] border-opacity-30 focus:outline-none outline-none resize-none"></textarea>
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
