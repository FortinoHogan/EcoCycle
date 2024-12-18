@extends('layout.master')

@section('konten')
    <style>
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(-20px);
                opacity: 0;
            }
        }

        .slide-down {
            animation: slideDown 0.2s ease-out forwards;
        }

        .slide-up {
            animation: slideUp 0.2s ease-in forwards;
        }
    </style>
    <div class="p-4">
        <div class="block m-auto w-full max-w-[1200px] px-4">
            <h1 class="font-bold text-[50px] text-[#3C552D] mb-10">@lang('lang.my_order')</h1>
            @if ($ths->isEmpty())
                <p class="font-medium mb-10">@lang('lang.no_order')</p>
            @endif
            @foreach ($ths as $t)
                <div class="border-b border-[#3C552D] pb-6 mb-6">
                    <div class="flex justify-between border-b-2 pb-2 mb-2">
                        <div class="">
                            <p class="font-medium">{{ $t->created_at->format('M d, Y H:i:s') }}</p>
                            <p>@lang('lang.order_number') {{ $t->id }}</p>
                        </div>
                        <div class="flex justify-end">
                            <p class="text-green-600">{{ $t->status }}</p>
                        </div>
                    </div>
                    <div id="display-first-{{ $t->id }}">
                        <div class="flex gap-2 items-center mt-4">
                            <img class="w-16 h-16 rounded-full" src="{{ asset('asset/profile.webp') }}" alt="profile" />
                            <div>
                                <p class="font-medium">{{ $t->details->first()->product->seller->name }}</p>
                                <p>{{ $t->details->first()->product->seller->region }}</p>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center px-4">
                            <div class="flex gap-6 items-center">
                                <img class="w-20 h-20"
                                    src="data:image/jpeg;base64,{{ base64_encode($t->details->first()->product->image) }}"
                                    alt="product" />
                                <p>{{ $t->details->first()->product->name }}</p>
                            </div>
                            <div class="flex gap-16 font-medium">
                                <p>@lang('lang.quantity'): {{ $t->details->first()->quantity }}</p>
                                <p>IDR:
                                    {{ number_format($t->details->first()->product->price * $t->details->first()->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="view-all-content-{{ $t->id }}" class="hidden">
                        @php
                            $shownSellers = [];
                        @endphp
                        @foreach ($t->details as $key => $detail)
                            @if ($key === 0 || !in_array($detail->product->seller->id, $shownSellers))
                                @php
                                    $shownSellers[] = $detail->product->seller->id;
                                @endphp
                                <div class="flex gap-2 items-center mt-4">
                                    <img class="w-16 h-16 rounded-full" src="{{ asset('asset/profile.webp') }}"
                                        alt="profile" />
                                    <div>
                                        <p class="font-medium">{{ $detail->product->seller->name }}</p>
                                        <p>{{ $detail->product->seller->region }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="mt-4 flex justify-between items-center px-4">
                                <div class="flex gap-6 items-center">
                                    <img class="w-20 h-20"
                                        src="data:image/jpeg;base64,{{ base64_encode($detail->product->image) }}"
                                        alt="product" />
                                    <p>{{ $detail->product->name }}</p>
                                </div>
                                <div class="flex gap-16 font-medium">
                                    <p>@lang('lang.quantity'): {{ $detail->quantity }}</p>
                                    <p>IDR:
                                        {{ number_format($detail->product->price * $detail->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex justify-center">
                        <div id="view-all-{{ $t->id }}" class="cursor-pointer flex items-center self-center">
                            <h2>@lang('lang.view_all')</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                fill="#5c5c5c" id="view-all-icon-{{ $t->id }}">
                                <path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 justify-end mt-4">
                        <a href="{{ route('order_detail', $t->id) }}"
                            class="hover:opacity-80 bg-[#76b743] border border-[#76b743] py-[10px] px-[24px] text-white rounded-md min-w-[100px] font-bold align-middle transition-all ease-in-out duration-500">
                            @lang('lang.view_detail')
                        </a>
                        <p>Total {{ $t->details->sum('quantity') }} @lang('lang.product'): <span class="font-semibold">IDR
                                {{ number_format($t->total_price, 0, ',', '.') }}</span></p>
                    </div>
                </div>
            @endforeach

            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px">
                    <path
                        d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z" />
                </svg>
                <p>@lang('lang.order_history_1')</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const viewAllButtons = document.querySelectorAll("[id^='view-all-']");

            viewAllButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const orderId = this.id.split('-')[2];
                    const content = document.getElementById(`view-all-content-${orderId}`);
                    const display = document.getElementById(`display-first-${orderId}`);
                    const icon = document.getElementById(`view-all-icon-${orderId}`);

                    if (content.classList.contains("hidden")) {
                        content.classList.remove("hidden", "slide-up");
                        display.classList.add("hidden");
                        content.classList.add("slide-down");
                        icon.style.transform = "rotate(180deg)";
                    } else {
                        content.classList.remove("slide-down");
                        content.classList.add("slide-up");

                        setTimeout(() => {
                            content.classList.add("hidden");
                            display.classList.remove("hidden");
                        }, 300);
                        icon.style.transform = "rotate(0deg)";
                    }
                });
            });
        });
    </script>
@endsection
