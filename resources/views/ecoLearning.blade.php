@extends('layout.master')
@section('konten')
    <style>
        @media (max-width: 640px) {
            #card {
                flex-direction: column;
            }
        }
    </style>
    <div class="p-4 mb-16">
        <div class="block m-auto w-full max-w-[1200px] px-4">
            <div class="flex flex-col justify-center items-end w-full mb-4 gap-4">
                <form action="{{ route('ecolearning') }}" class="relative text-gray-600">
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
                <form action="{{ route('ecolearning') }}" class="flex items-center gap-3">
                    <label for="sort" class="text-sm font-medium text-gray-900 dark:text-white">@lang('lang.sort_by'):</label>
                    <select id="sort" name="sort"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        onchange="this.form.submit()">
                        <option value="release-date" {{ request('sort') == 'release-date' ? 'selected' : '' }}>@lang('lang.release_date')</option>
                        <option value="alphabetical-ascending"
                            {{ request('sort') == 'alphabetical-ascending' ? 'selected' : '' }}>
                            @lang('lang.alphabet_asc')
                        </option>
                        <option value="alphabetical-descending"
                            {{ request('sort') == 'alphabetical-descending' ? 'selected' : '' }}>
                            @lang('lang.alphabet_desc')
                        </option>
                    </select>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                </form>
            </div>
            @foreach ($articles as $a)
                <div class="flex flex-row justify-center my-10 p-3 border border-[#3C552D] rounded-2xl gap-5 w-full"
                    id="card">
                    <div class="sm:w-1/4 border-black">
                        <img src="data:image/jpeg;base64,{{ base64_encode($a->image) }}" alt=""
                            class="w-full h-full rounded-bl-2xl rounded-tl-2xl max-sm:rounded-tr-2xl max-sm:rounded-br-2xl object-cover ">
                    </div>
                    <div class="sm:w-3/4 flex flex-col justify-between gap-3 truncate">
                        <div>
                            <p class="text-xl font-semibold ">{{ $a->title }}</p>
                            <p class="text-sm text-gray-500 mt-2">{{ $a->createdDate }}</p>
                            <p class="text-md mt-4">{{ $a->description }}</p>
                        </div>
                        <div class="flex justify-end">
                            <a href="{{ route('article_detail', ['id' => $a->id]) }}"
                                class="font-medium border border-black mb-1 py-1 px-5 rounded-2xl hover:bg-[#3C552D] hover:text-white transition-all duration-500">@lang('lang.see_more')</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-center">
                {{ $articles->appends(['search' => request('search'), 'sort' => request('sort')])->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
